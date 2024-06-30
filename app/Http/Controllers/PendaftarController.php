<?php

namespace App\Http\Controllers;

use App\Exports\DataPendaftarExport;
use App\Models\BiayaDaftar;
use App\Models\DataRekening;
use App\Models\Jam;
use App\Models\Nilai;
use App\Models\Pendaftar;
use App\Models\ProgramPaket;
use App\Models\ProgramPilihan;
use App\Models\Verification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
            ->select('tb_pendaftar.no_induk', 'nm_lengkap', 'gender', 'tb_pendaftar_verifikasi.pil_prog', 'tb_pendaftar_verifikasi.biaya_kursus', 'tb_pendaftar_verifikasi.biaya_daftar', 'tb_pendaftar_verifikasi.kekurangan', 'no_hp'); // Pilih kolom yang ingin Anda ambil

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
    public function export(Request $request)
    {
        $year = $request->input('year');
        $date = date('d M Y');

        if ($year) {
            $fileName = 'Data Pendaftar ' . $year . ' (' . $date . ').xlsx';
        } else {
            $fileName = 'Semua Data Pendaftar (' . $date . ').xlsx';
        }

        return Excel::download(new DataPendaftarExport($year), $fileName);
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
            return redirect('/admin/biaya-pendaftaran')->with('info', 'Silahkan mengisi biaya pendaftaran');
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
        return redirect('/admin/pendaftaran')->with('message', 'Data berhasil disimpan!');
    }
    public function UpdateVerifikasi(Request $request, $no_induk)
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

        // Ubah nilai kosong atau string 'null' menjadi NULL atau 0
        foreach ($validatedData as $key => $value) {
            if ($value === '' || $value === 'null' || $value === '0') {
                $validatedData[$key] = null; // Ubah menjadi NULL atau sesuai kebutuhan
            }
        }

        // Temukan record berdasarkan no_induk
        $verification = Verification::where('no_induk', $no_induk)->firstOrFail();

        // Update data
        $verification->update($validatedData);

        // Logika untuk menentukan nilai ket
        $verification->ket = ($verification->kekurangan == 0 || $verification->kekurangan === null) ? 'lunas' : 'belum lunas';
        $verification->save();

        // Redirect setelah simpan
        return redirect('/admin/pendaftaran/' . $no_induk)->with('message', 'Data Pembayaran berhasil diperbarui!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
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

    private function getPredikat($nilai)
    {
        if ($nilai >= 90 && $nilai <= 100) {
            return ['predikat' => 'A', 'bg' => 'bg-success'];
        } elseif ($nilai >= 85 && $nilai <= 89) {
            return ['predikat' => 'B+', 'bg' => 'bg-primary'];
        } elseif ($nilai >= 80 && $nilai <= 84) {
            return ['predikat' => 'B', 'bg' => 'bg-primary'];
        } elseif ($nilai >= 75 && $nilai <= 79) {
            return ['predikat' => 'B-', 'bg' => 'bg-primary'];
        } elseif ($nilai >= 70 && $nilai <= 74) {
            return ['predikat' => 'C+', 'bg' => 'bg-warning'];
        } elseif ($nilai >= 65 && $nilai <= 69) {
            return ['predikat' => 'C', 'bg' => 'bg-warning'];
        } elseif ($nilai >= 60 && $nilai <= 64) {
            return ['predikat' => 'C-', 'bg' => 'bg-warning'];
        } else {
            return ['predikat' => 'BELUM DINILAI', 'bg' => 'bg-secondary'];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pendaftar $pendaftar, $no_induk)
    {
        $certificate = DB::table('tb_sertifikat')->orderBy('id', 'desc')->first();
        $lastCertificate = $certificate ? $certificate->no_sertifikat : 0;
        $newCertificate = $lastCertificate + 1;

        $student = Pendaftar::select('p.no_induk', 'p.*', 'pv.*', 'f.*', 'j.*')
            ->from('tb_pendaftar as p')
            ->join('tb_pendaftar_verifikasi as pv', 'p.no_induk', '=', 'pv.no_induk')
            ->leftJoin('tb_foto as f', 'p.no_induk', '=', 'f.no_induk')
            ->leftJoin('tb_jam as j', 'pv.kd_jam', '=', 'j.id')
            ->where('p.no_induk', $no_induk)
            ->first();

        if (!$student) {
            abort(404); // Menampilkan halaman 404 jika data tidak ditemukan
        }

        $programs = [];
        $kd_programs = [];

        if ($student->pil_prog === 'paket') {
            if ($student->kd_paket) {
                $programPaket = DB::table('tb_paket_kursus as pk')
                    ->join('tb_paket_kursus_pilihan as pkp', 'pk.id', '=', 'pkp.paket_kursus_id')
                    ->join('tb_pilihan as p', 'pkp.pilihan_id', '=', 'p.id')
                    ->where('pk.kode', $student->kd_paket)
                    ->select('p.program', 'p.id')
                    ->get();

                foreach ($programPaket as $item) {
                    $programs[] = $item->program;
                    $kd_programs[] = $item->id;
                }
            }

            $kd_tambahan_fields = ['kd_tambahan', 'kd_tambahan2', 'kd_tambahan3', 'kd_tambahan4'];
            foreach ($kd_tambahan_fields as $field) {
                if ($student->$field) {
                    $programTambahan = DB::table('tb_pilihan')
                        ->where('id', $student->$field)
                        ->select('program', 'id')
                        ->first();

                    if ($programTambahan) {
                        $programs[] = $programTambahan->program;
                        $kd_programs[] = $programTambahan->id;
                    }
                }
            }
        } elseif ($student->pil_prog === 'pilihan') {
            for ($i = 1; $i <= 6; $i++) {
                $kd_pilihan_field = 'kd_pilihan' . $i;
                $kd_pilihan_value = $student->$kd_pilihan_field;

                if ($kd_pilihan_value) {
                    $program = DB::table('tb_pilihan')
                        ->where('id', $kd_pilihan_value)
                        ->select('program', 'id')
                        ->first();

                    if ($program) {
                        $programs[] = $program->program;
                        $kd_programs[] = $program->id;
                    }
                }
            }
        }

        // Fetch existing scores
        $existing_scores = Nilai::where('no_induk', $no_induk)->get()->keyBy('kd_program');

        // Process the predikat for each existing score
        foreach ($existing_scores as $score) {
            $score->predikat = $this->getPredikat($score->nilai);
        }

        // Ambil data angsuran dan tanggal angsuran
        $installments = [];

        // Angsuran pertama menggunakan tgl_masuk
        if ($student->angsuran1) {
            $installments[] = [
                'angsuran' => $student->angsuran1,
                'tanggal' => $student->tgl_masuk,
                'keterangan' => $student->angsuran1 == $student->tot_biaya ? 'Pelunasan' : 'Angsuran 1',
            ];
        }

        // Angsuran berikutnya menggunakan tgl_angsuran2, tgl_angsuran3, tgl_angsuran4, tgl_angsuran5
        for ($i = 2; $i <= 5; $i++) {
            $installment_field = 'angsuran' . $i;
            $date_field = 'tgl_angsuran' . $i;
            if ($student->$installment_field && $student->$date_field) {
                $installments[] = [
                    'angsuran' => $student->$installment_field,
                    'tanggal' => $student->$date_field,
                    'keterangan' => 'Angsuran ' . $i,
                ];
            }
        }

        // Get sertifikat data
        $sertifikatData = DB::table('tb_sertifikat')->where('no_induk', $no_induk)->first();
        $isReadOnly = $sertifikatData ? true : false;

        return view('dashboard.pendaftaran.offline.show', [
            "halaman" => "Profile Peserta Didik",
            "title" => "Peserta Didik",
            "tab_title" => "Profile",
            "data" => $student,
            "no_induk" => $no_induk,
            "programs" => $programs,
            "kd_programs" => $kd_programs,
            "existing_scores" => $existing_scores,
            "installments" => $installments,
            "rekenings" => DataRekening::orderBy('id')->get(),
            "newCertificate" => $newCertificate,
            "isReadOnly" => $isReadOnly,
            "sertifikatData" => $sertifikatData
        ]);
    }

    public function saveNilai(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'no_induk' => 'required|string',
            'nilai' => 'array',
            'programs' => 'required|array',
            'kd_programs' => 'required|array',
        ]);

        // Mulai transaksi database
        DB::beginTransaction();
        try {
            foreach ($validated['kd_programs'] as $index => $kd_program) {
                $nilai = $validated['nilai'][$index] ?? null;

                // Jika nilai tidak diisi, set nilai menjadi null atau 0
                if (is_null($nilai) || $nilai === '') {
                    $nilai = 0; // Atau null jika ingin nilai default menjadi null
                }

                Nilai::updateOrCreate(
                    [
                        'no_induk' => $validated['no_induk'],
                        'kd_program' => $kd_program,
                    ],
                    [
                        'nilai' => $nilai,
                        'program_kursus' => $validated['programs'][$index],
                    ]
                );
            }

            DB::commit();
            return redirect()->back()->with('message', 'Nilai berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Terjadi kesalahan saat menyimpan nilai: ' . $e->getMessage());
        }
    }

    // Add this method to your controller
    public function updateAllNilai(Request $request)
    {
        $request->validate([
            'no_induk' => 'required',
            'nilai' => 'required|array',
            'nilai.*' => 'integer|min:0|max:100',
            'kd_programs' => 'required|array',
            'kd_programs.*' => 'required|integer',
        ]);

        $no_induk = $request->no_induk;
        $nilai = $request->nilai;
        $kd_programs = $request->kd_programs;

        foreach ($kd_programs as $index => $kd_program) {
            $existing_score = Nilai::where('no_induk', $no_induk)
                ->where('kd_program', $kd_program)
                ->first();

            if ($existing_score) {
                $existing_score->nilai = $nilai[$index];
                $existing_score->save();
            }
        }

        return redirect()->back()->with('message', 'Nilai berhasil diperbarui!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pendaftar $pendaftar, $no_induk)
    {
        // Kembali ke halaman pendaftaran
        return view('dashboard.pendaftaran.offline.edit', [
            "halaman" => "Edit Peserta Didik",
            "title" => "Profile Peserta Didik",
            "tab_title" => "Edit",
            "no_induk" => $no_induk,
            "cari" => Pendaftar::where('no_induk', $no_induk)->orderBy('id')->first(),
        ]);
    }

    public function editVerifikasi(Pendaftar $pendaftar, $no_induk)
    {
        $CostRegistration = BiayaDaftar::latest()->first();
        if (is_null($CostRegistration)) {
            return redirect('/admin/biaya-pendaftaran')->with('info', 'Silahkan mengisi biaya pendaftaran');
        } else {
            // Kembali ke halaman pendaftaran
            return view('dashboard.pendaftaran.offline.editverifikasi', [
                "halaman" => "Pembayaran",
                "title" => "Profile Peserta Didik",
                "tab_title" => "Pembayaran",
                "no_induk" => $no_induk,
                "pendaftar" => Pendaftar::select('p.no_induk', 'p.*', 'pv.*', 'j.*')
                    ->from('tb_pendaftar as p')
                    ->join('tb_pendaftar_verifikasi as pv', 'p.no_induk', '=', 'pv.no_induk')
                    ->leftJoin('tb_jam as j', 'pv.kd_jam', '=', 'j.id')
                    ->where('p.no_induk', $no_induk)
                    ->first(),
                "categories" => Jam::orderBy('id')->get(),
                "program_pilihan" => ProgramPilihan::orderBy('id')->get(),
                "program_paket" => ProgramPaket::orderBy('id')->get(),
                "biaya_daftar" => $CostRegistration,
            ]);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $no_induk)
    {
        // Validasi data input
        $validatedData = $request->validate([
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

        // Set all empty values to null
        foreach ($validatedData as $key => $value) {
            if (empty($value) || $value === 'null') {
                $validatedData[$key] = null;
            }
        }

        // Ambil objek Pendaftar berdasarkan no_induk
        $pendaftar = Pendaftar::where('no_induk', $no_induk)->first();

        // Cek apakah pendaftar ditemukan
        if (!$pendaftar) {
            return redirect()->back()->withErrors(['error' => 'Pendaftar tidak ditemukan.']);
        }

        try {
            // Simpan data ke database
            $updateSuccess = $pendaftar->update($validatedData);

            // Debug: Log status update
            Log::info('Status update:', ['success' => $updateSuccess]);

            // Redirect ke halaman verifikasi
            return redirect('/admin/pendaftaran')->with('message', 'Biodata berhasil diperbarui!');
        } catch (\Exception $e) {
            // Tangani kesalahan dan log error
            Log::error('Error saat update data:', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($no_induk)
    {
        // Gunakan transaction untuk memastikan semua query berhasil atau tidak ada yang dieksekusi
        DB::beginTransaction();

        try {
            // Hapus data dari tabel `tb_pendaftar_verifikasi`, `tb_foto`, `tb_sertifikat`, `tb_nilai`
            DB::table('tb_pendaftar_verifikasi')->where('no_induk', $no_induk)->delete();
            DB::table('tb_foto')->where('no_induk', $no_induk)->delete();
            DB::table('tb_sertifikat')->where('no_induk', $no_induk)->delete();
            Nilai::where('no_induk', $no_induk)->delete();

            // Hapus data dari tabel `tb_ppdb`
            DB::table('tb_ppdb')->where('no_induk', $no_induk)->delete();

            // Hapus data dari tabel `tb_penilaian`
            DB::table('tb_penilaian')->where('no_induk', $no_induk)->delete();

            // Hapus data dari tabel `tb_angket`
            DB::table('tb_angket')->where('no_induk', $no_induk)->delete();

            // Hapus data dari tabel `tb_pendaftar`
            Pendaftar::where('no_induk', $no_induk)->delete();

            // Commit transaction
            DB::commit();

            return redirect()->route('pendaftaran.index')->with('message', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            // Rollback transaction jika terjadi error
            DB::rollback();

            return redirect()->route('pendaftaran.index')->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }
}
