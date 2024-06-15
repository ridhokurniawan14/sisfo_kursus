<?php

namespace App\Http\Controllers;

use App\Exports\DataPendaftarExport;
use App\Models\BiayaDaftar;
use App\Models\Jam;
use App\Models\Pendaftar;
use App\Models\ProgramPaket;
use App\Models\ProgramPilihan;
use App\Models\Verification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PendaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DB::table('tb_pendaftar')
                        ->join('tb_pendaftar_verifikasi', 'tb_pendaftar.no_induk', '=', 'tb_pendaftar_verifikasi.no_induk')
                        ->orderByDesc('tb_pendaftar.id')
                        ->select('tb_pendaftar.no_induk','nm_lengkap','gender','tb_pendaftar_verifikasi.pil_prog','tb_pendaftar_verifikasi.biaya_kursus','tb_pendaftar_verifikasi.biaya_daftar','tb_pendaftar_verifikasi.kekurangan','no_hp'); // Pilih kolom yang ingin Anda ambil

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('tb_pendaftar.no_induk', 'like', "%{$search}%")
                ->orWhere('tb_pendaftar.nm_lengkap', 'like', "%{$search}%");
            });
        }

        $datas = $query->paginate(10);

        return view('dashboard.pendaftaran.offline.index', [
            "halaman" => "Data Peserta Didik",
            "title" => "Data",
            "tab_title" => "Data Peserta Didik",
            "datas" => $datas
        ]);
    }
    public function export()
    {
        return Excel::download(new DataPendaftarExport, 'data_pendaftar.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil data pendaftar yang tidak ada di tabel verifikasi
        $query = DB::table('tb_pendaftar')
            ->leftJoin('tb_pendaftar_verifikasi', 'tb_pendaftar.no_induk', '=', 'tb_pendaftar_verifikasi.no_induk')
            ->whereNull('tb_pendaftar_verifikasi.no_induk')
            ->orderByDesc('tb_pendaftar.id')
            ->select('tb_pendaftar.no_induk', 'tb_pendaftar.nm_lengkap', 'tb_pendaftar.gender', 'tb_pendaftar.no_hp')
            ->get();

        // Jika ada data yang perlu diverifikasi
        if (!$query->isEmpty()) {
            // Ambil no_induk dari salah satu hasil kueri
            $noInduk = $query->first()->no_induk;

            // Redirect ke halaman verifikasi dengan parameter no_induk
            return redirect()->route('pendaftaran.verifikasi', ['no_induk' => $noInduk])->with('info', 'Silahkan memverifikasi pendaftar');
        } else {
            // Mendapatkan NIS terakhir dari tabel pendaftar
            $lastStudent = DB::table('tb_pendaftar')->orderBy('no_induk', 'desc')->first();
            $lastNIS = $lastStudent ? $lastStudent->no_induk : 0;
            $newNIS = $lastNIS + 1;

            // Kembali ke halaman pendaftaran
            return view('dashboard.pendaftaran.offline.create', [
                "halaman" => "Pendaftaran Peserta Didik",
                "title" => "Pendaftaran",
                "tab_title" => "Tambah Peserta Didik",
                "newNIS" => $newNIS,
            ]);
        }
    }

    public function verifikasi($no_induk)
    {
        $CostRegistration = BiayaDaftar::latest()->first();
        if (is_null($CostRegistration)) {
            return redirect('/biaya-pendaftaran')->with('info', 'Silahkan mengisi biaya pendaftaran');
        } else {
            $pendaftar = Pendaftar::where('no_induk', $no_induk)->firstOrFail();
            $data = [
                "halaman" => "Verifikasi Peserta Didik",
                "title" => "Pendaftaran",
                "tab_title" => "Verifikasi Peserta Didik",
                "pendaftar" => $pendaftar,
                "categories" => Jam::orderBy('id')->get(),
                "program_pilihan" => ProgramPilihan::orderBy('id')->get(),
                "program_paket" => ProgramPaket::orderBy('id')->get(),
                "biaya_daftar" => $CostRegistration,
                "no_induk" => $no_induk,
            ];
            return view('dashboard.pendaftaran.offline.verifikasi', $data);
        }
    }

    public function SaveVerifikasi(Request $request, $no_induk)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'kd_jam' => 'required',
            'pil_prog' => 'required',
            'kd_paket' => 'nullable',
            'kd_tambahan' => 'nullable',
            'kd_tambahan2' => 'nullable',
            'kd_tambahan3' => 'nullable',
            'kd_tambahan4' => 'nullable',
            'kd_pilihan1' => 'nullable',
            'kd_pilihan2' => 'nullable',
            'kd_pilihan3' => 'nullable',
            'kd_pilihan4' => 'nullable',
            'kd_pilihan5' => 'nullable',
            'kd_pilihan6' => 'nullable',
            'biaya_kursus' => 'required',
            'biaya_daftar' => 'required',
            'discount' => 'required',
            'tot_biaya' => 'required',
            'kekurangan' => 'nullable',
            'angsuran1' => 'required',
            'angsuran2' => 'nullable',
            'tgl_angsuran2' => 'nullable',
            'angsuran3' => 'nullable',
            'tgl_angsuran3' => 'nullable',
            'angsuran4' => 'nullable',
            'tgl_angsuran4' => 'nullable',
            'angsuran5' => 'nullable',
            'tgl_angsuran5' => 'nullable',
            'ket' => 'nullable',
        ]);

        // Menghapus simbol mata uang dan titik
        $fields = ['biaya_kursus', 'biaya_daftar', 'discount', 'tot_biaya', 'kekurangan', 'angsuran1', 'angsuran2', 'angsuran3', 'angsuran4', 'angsuran5'];
        foreach ($fields as $field) {
            if (array_key_exists($field, $validatedData)) {
                $validatedData[$field] = str_replace(['Rp.', '.', ' '], '', $validatedData[$field]);
            }
        }

        // Ubah nilai kosong atau string 'null' menjadi NULL
        foreach ($validatedData as $key => $value) {
            if ($value === '' || $value === 'null' || $value === '0') {
                $validatedData[$key] = 0;
            }
        }

        // Tambahkan no_induk ke data yang divalidasi
        $validatedData['no_induk'] = $no_induk;

        // Debugging untuk memastikan nilai yang benar
        // dd($validatedData);

        // Logika untuk menentukan nilai ket
        $validatedData['ket'] = $validatedData['kekurangan'] == 0 ? 'lunas' : 'belum lunas';

        // Simpan data ke database
        Verification::create($validatedData);

        // Redirect setelah simpan
        return redirect('/pendaftaran')->with('message', 'Data berhasil disimpan!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        // Validasi data input
        $validatedData = $request->validate([
            'no_induk' => 'required|unique:tb_pendaftar,no_induk',
            'nm_lengkap' => 'required|string|max:255',
            'tmp_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'gender' => 'required|string|max:1',
            'nisn' => 'nullable',
            'nik' => 'nullable',
            'agama' => 'required|string|max:255',
            'kewarganegaraan' => 'required|string|max:255',
            'pend_akhir' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'no_hp' => 'nullable',
            'status_pekerjaan' => 'required|string|max:255',
            'tgl_masuk' => 'required|date',
            'alamat' => 'required|string|max:255',
            'rt' => 'nullable',
            'rw' => 'nullable',
            'kel' => 'nullable|string|max:255',
            'kec' => 'nullable|string|max:255',
            'kd_pos' => 'nullable',
            'kab' => 'required|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'jns_tinggal' => 'nullable|string|max:255',
            'nm_ayah' => 'nullable|string|max:255',
            'nik_ayah' => 'nullable',
            'tgl_ayah' => 'nullable|date',
            'pend_ayah' => 'nullable|string|max:255',
            'pek_ayah' => 'nullable|string|max:255',
            'nm_ibu' => 'nullable|string|max:255',
            'nik_ibu' => 'nullable',
            'tgl_ibu' => 'nullable|date',
            'pend_ibu' => 'nullable|string|max:255',
            'pek_ibu' => 'nullable|string|max:255',
            'alamat_ortu' => 'nullable|string|max:255',
            'hp_ortu' => 'nullable',
            'telepon_ortu' => 'nullable',
            'anak_ke' => 'nullable',
            'nm_wali' => 'nullable|string|max:255',
            'nik_wali' => 'nullable',
            'tgl_wali' => 'nullable|date',
            'pend_wali' => 'nullable|string|max:255',
            'pek_wali' => 'nullable|string|max:255',
            'alamat_wali' => 'nullable|string|max:255',
            'hp_wali' => 'nullable',
        ]);

        // Tambahkan password yang sama dengan tanggal lahir, dalam format hashed
        $validatedData['password'] = bcrypt($request->tgl_lahir);

        // Set all empty values to null
        foreach ($validatedData as $key => $value) {
            if (empty($value) || $value === 'null') {
                $validatedData[$key] = null;
            }
        }
        
        // Simpan data ke database
        $pendaftar = Pendaftar::create($validatedData);

        // Redirect ke halaman verifikasi
        return redirect()->route('pendaftaran.verifikasi', ['no_induk' => $pendaftar->no_induk])
                        ->with('message', 'Data pendaftar berhasil disimpan. Silahkan Verifikasi');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pendaftar $pendaftar, $no_induk)
    {
        $student = Pendaftar::select('p.no_induk', 'p.*', 'pv.*', 'f.*', 'j.*')
                            ->from('tb_pendaftar as p')
                            ->join('tb_pendaftar_verifikasi as pv', 'p.no_induk', '=', 'pv.no_induk')
                            ->leftJoin('tb_foto as f', 'p.no_induk', '=', 'f.no_induk')
                            ->leftJoin('tb_jam as j', 'pv.kd_jam', '=', 'j.id')
                            ->where('p.no_induk', $no_induk)
                            ->first();
        if (!$student) {
            abort(404); // Menampilkan halaman 404 jika data tidak ditemukan
        } else {
            return view('dashboard.pendaftaran.offline.show', [
                "halaman" => "Profile Peserta Didik",
                "title" => "Peserta Didik",
                "tab_title" => "Profile",
                "data" => $student,
                "no_induk" => $no_induk,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pendaftar $pendaftar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pendaftar $pendaftar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendaftar $pendaftar)
    {
        //
    }
}
