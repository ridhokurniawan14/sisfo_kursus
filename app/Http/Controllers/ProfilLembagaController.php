<?php

namespace App\Http\Controllers;

use App\Models\ProfilLembaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ProfilLembagaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showProfile()
    {
        // Ambil data profile dari database
        $profile = DB::table('tb_profile')->first();

        // Kirim data ke view
        return view('main', compact('profile'));
    }
    public function index()
    {
        $profileExists = DB::table('tb_profile')->exists();

        // Ganti URL endpoint API Provinsi
        $urlProvinsi = 'https://ridhokurniawan14.github.io/api-wilayah-indonesia/api/provinces.json';
        $response = Http::get($urlProvinsi);
        $provinces = $response->json();

        // Hanya memuat provinsi untuk awal, kabupaten/kota, kecamatan, dan kelurahan akan dimuat berdasarkan pilihan pengguna
        $kabupaten = [];
        $kecamatan = [];
        $kelurahan = [];

        if ($profileExists) {
            $firstProfile = ProfilLembaga::first();
            return redirect()->route('profil-lembaga.show', $firstProfile->id);
        } else {
            session()->flash('info', 'Mohon Lengkapi Profil Lembaga');
            return view('dashboard.data-master.profil-lembaga.index', [
                "halaman" => "Profil Lembaga",
                "title" => "Data Lembaga",
                "tab_title" => "Data Profil Lembaga",
                "provinces" => $provinces,
                "kabupaten" => $kabupaten,
                "kecamatan" => $kecamatan,
                "kelurahan" => $kelurahan,
            ]);
        }
    }
    public function getKabupaten($provinceId)
    {
        $urlKab = "https://ridhokurniawan14.github.io/api-wilayah-indonesia/api/regencies/$provinceId.json";
        $response = Http::get($urlKab);
        return $response->json();
    }

    public function getKecamatan($regencyId)
    {
        $urlKecamatan = "https://ridhokurniawan14.github.io/api-wilayah-indonesia/api/districts/$regencyId.json";
        $response = Http::get($urlKecamatan);
        return $response->json();
    }

    public function getKelurahan($districtId)
    {
        $urlKelurahan = "https://ridhokurniawan14.github.io/api-wilayah-indonesia/api/villages/$districtId.json";
        $response = Http::get($urlKelurahan);
        return $response->json();
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nm_lembaga' => 'required',
            'npsn' => 'required',
            'bentuk' => 'required',
            'sts_lembaga' => 'required',
            'sts' => 'required',
            'sk_izin' => 'nullable',
            'sk_pendirian' => 'nullable',
            'tgl_sk_pendirian' => 'nullable|date',
            'tgl_sk_izin' => 'nullable|date',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kel' => 'required',
            'kec' => 'required',
            'kd_pos' => 'nullable',
            'kab' => 'required',
            'provinsi' => 'required',
            'no_tel' => 'required',
            'no_fax' => 'nullable',
            'email' => 'required|email',
            'web' => 'required',
            'but_kus' => 'nullable',
            'nm_yayasan' => 'nullable',
            'nm_pajak' => 'required',
            'no_npwp' => 'required',
            'nm_bank' => 'nullable',
            'bank_cabang' => 'nullable',
            'nm_rekening' => 'nullable',
            'luas_tanah' => 'nullable',
            'kat_lembaga' => 'required',
            'ms_ijin' => 'nullable',
            'sumber_dana' => 'nullable',
            'no_sertifikat' => 'nullable',
            'tgl_sertifikat' => 'nullable|date',
            'no_sk_akreditasi' => 'nullable',
            'mulai_berlaku' => 'nullable|date',
            'ms_akreditasi' => 'nullable',
            'hasil' => 'nullable',
            'penilai' => 'nullable',
            'logo'  => ['mimes:jpeg,jpg,png,webp', 'max:5120'], // max:5120 artinya maksimum 2MB (5120 KB)
            // Tambahkan validasi lainnya sesuai kebutuhan Anda
        ]);

        $validateData = $request->all();

        if ($request->file('logo')) {
            // Menyimpan file dengan nama acak di dalam direktori profile-lembaga di dalam direktori public
            $validateData['logo'] = $request->file('logo')->store('profile-lembaga', 'public');
        }

        // Simpan data ke dalam database
        ProfilLembaga::create($validateData);

        // Redirect atau response sesuai kebutuhan aplikasi Anda
        return redirect('/admin/profil-lembaga')->with('message', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProfilLembaga $profilLembaga)
    {
        return view('dashboard.data-master.profil-lembaga.show', [
            "halaman" => "Profil Lembaga",
            "title" => "Data Lembaga",
            "tab_title" => "Data Profil Lembaga",
            "data" => DB::table('tb_profile')
                ->orderByDesc('id') // Mengurutkan berdasarkan kolom 'id', yang mungkin merupakan kolom yang menunjukkan urutan data yang pertama dimasukkan
                ->first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProfilLembaga $profilLembaga)
    {
        // Ganti URL endpoint API Provinsi
        $urlProvinsi = 'https://ridhokurniawan14.github.io/api-wilayah-indonesia/api/provinces.json';
        $response = Http::get($urlProvinsi);
        $provinces = $response->json();

        return view('dashboard.data-master.profil-lembaga.edit', [
            "halaman" => "Edit Profil Lembaga",
            "title" => "Data Lembaga",
            "tab_title" => "Edit Data Profil Lembaga",
            "cari" => $profilLembaga,
            "provinces" => $provinces,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProfilLembaga $profilLembaga)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nm_lembaga' => 'required',
            'npsn' => 'required',
            'bentuk' => 'required',
            'sts_lembaga' => 'required',
            'sts' => 'required',
            'sk_izin' => 'nullable',
            'sk_pendirian' => 'nullable',
            'tgl_sk_pendirian' => 'nullable|date',
            'tgl_sk_izin' => 'nullable|date',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kel' => 'required',
            'kec' => 'required',
            'kd_pos' => 'nullable',
            'kab' => 'required',
            'provinsi' => 'required',
            'no_tel' => 'required',
            'no_fax' => 'nullable',
            'email' => 'required|email',
            'web' => 'required',
            'but_kus' => 'nullable',
            'nm_yayasan' => 'nullable',
            'nm_pajak' => 'required',
            'no_npwp' => 'required',
            'nm_bank' => 'nullable',
            'bank_cabang' => 'nullable',
            'nm_rekening' => 'nullable',
            'luas_tanah' => 'nullable',
            'kat_lembaga' => 'required',
            'ms_ijin' => 'nullable',
            'sumber_dana' => 'nullable',
            'no_sertifikat' => 'nullable',
            'tgl_sertifikat' => 'nullable|date',
            'no_sk_akreditasi' => 'nullable',
            'mulai_berlaku' => 'nullable|date',
            'ms_akreditasi' => 'nullable',
            'hasil' => 'nullable',
            'penilai' => 'nullable',
            'logo'  => ['nullable', 'mimes:jpeg,jpg,png,webp', 'max:5120'], // menggunakan 'sometimes' dan 'nullable' untuk memperbolehkan field kosong saat update
            // Tambahkan validasi lainnya sesuai kebutuhan Anda
        ]);

        // Jika ada file yang diunggah, simpan foto dan hapus foto lama
        if ($request->hasFile('logo')) {
            if ($profilLembaga->logo) {
                Storage::delete('public/' . $profilLembaga->logo);
            }
            $validatedData['logo'] = $request->file('logo')->store('profile-lembaga', 'public');
        } else {
            // Jika tidak ada file yang diunggah, tetap gunakan logo yang sudah ada
            unset($validatedData['logo']); // pastikan field logo tidak disertakan dalam data yang akan di-update
        }

        // Update data ke dalam database
        try {
            $profilLembaga->update($validatedData);
            return redirect()->route('profil-lembaga.show', $profilLembaga->id)->with('message', 'Data berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->route('profil-lembaga.index')->with('error', 'Gagal memperbarui data profil lembaga.');
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProfilLembaga $profilLembaga)
    {
        abort(404);
    }
}
