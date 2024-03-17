<?php

namespace App\Http\Controllers;

use App\Models\HakAkses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.data-master.personalia.index', [
            "halaman" => "Personalia",
            "title" => "Data Lembaga",
            "tab_title" => "Data Personalia",
            "datas" => DB::table('tb_pendidik')
                        ->orderBy('id') // Mengurutkan berdasarkan kolom 'id', yang mungkin merupakan kolom yang menunjukkan urutan data yang pertama dimasukkan
                        ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.data-master.personalia.create', [
            "halaman" => "Personalia",
            "title" => "Data Master",
            "tab_title" => "Tambah Personalia",
            "categories" => HakAkses::orderBy('id')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nm_lengkap'    => 'required',
            'gender'        => 'required|in:l,p',
            'tmp_lahir'     => 'required',
            'tgl_lahir'     => 'required|date',
            'agama'         => 'required',
            'status'        => 'required',
            'alamat'        => 'required',
            'pend_akhir'    => 'required',
            'jurusan'       => 'required',
            'email'         => ['required', 'email:dns', 'unique:tb_pendidik'],
            'no_hp'         => 'required|numeric',
            'posisi'        => 'required',
            'tgl_masuk'     => 'required|date',
            'username'      => 'required|unique:tb_pendidik',
            'password'      => ['required','min:6'],
            'nik'           => 'required|numeric|digits:16|unique:tb_pendidik',
            'nm_ibu'        => 'nullable',
            'foto'          => ['mimes:jpeg,jpg,png,webp', 'max:5120'], // max:5120 artinya maksimum 2MB (5120 KB)
        ]);        

        // Mengonversi semua data input menjadi huruf kecil
        $validateData['nm_lengkap'] = strtolower($validateData['nm_lengkap']);
        $validateData['gender'] = strtolower($validateData['gender']);
        $validateData['tmp_lahir'] = strtolower($validateData['tmp_lahir']);
        $validateData['agama'] = strtolower($validateData['agama']);
        $validateData['status'] = strtolower($validateData['status']);
        $validateData['alamat'] = strtolower($validateData['alamat']);
        $validateData['pend_akhir'] = strtolower($validateData['pend_akhir']);
        $validateData['jurusan'] = strtolower($validateData['jurusan']);
        $validateData['username'] = strtolower($validateData['username']);
        $validateData['nm_ibu'] = strtolower($validateData['nm_ibu']);

        $validateData['password'] = Hash::make($validateData['password']);
        
        if ($request->file('foto')) {
            // Menyimpan file dengan nama acak di dalam direktori admin-images di dalam direktori public
            $validateData['foto'] = $request->file('foto')->store('admin-images', 'public');
            // $validateData['foto'] = $request->file('foto')->storeAs('admin-images', 'public');
        }                      
        
        User::create($validateData);
        
        // Catat aktivitas dalam log
        // ActivityLogger::logActivity('create', 'Admin dengan nama '.ucwords($request->name), $request->file('foto'));

        // dd('Registrasi Berhasil'); //Cara cek berhasil atau tidaknya
        return redirect('/user')->with('message', 'Data Berhasil Disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $userData = User::select(
            'tb_pendidik.nm_lengkap', 'tb_pendidik.gender', 'tb_pendidik.tmp_lahir',
            'tb_pendidik.tgl_lahir', 'tb_pendidik.agama', 'tb_pendidik.status',
            'tb_pendidik.alamat', 'tb_pendidik.pend_akhir', 'tb_pendidik.jurusan',
            'tb_pendidik.email', 'tb_pendidik.no_hp', 'tb_pendidik.posisi',
            'tb_pendidik.tgl_masuk', 'tb_pendidik.username', 'tb_pendidik.password',
            'tb_pendidik.nik', 'tb_pendidik.nm_ibu', 'tb_pendidik.foto',
            'tb_hak_akses.hak_akses'
        )
        ->join('tb_hak_akses', 'tb_pendidik.posisi', '=', 'tb_hak_akses.id')
        ->where('tb_pendidik.email', $user->email)
        ->first();

        return view('dashboard.data-master.personalia.show', [
            "halaman" => "Profile Personalia",
            "title" => "Data Lembaga",
            "tab_title" => "Profile Personalia",
            "data" => $userData,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('dashboard.data-master.personalia.edit', [
            "halaman" => "Personalia",
            "title" => "Data Lembaga",
            "tab_title" => "Edit Personalia",
            "categories" => HakAkses::orderBy('id')->get(),
            "cari" => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Aturan validasi umum
        $rules = [
            'nm_lengkap'    => 'required',
            'gender'        => 'required|in:l,p',
            'tmp_lahir'     => 'required',
            'tgl_lahir'     => 'required|date',
            'agama'         => 'required',
            'status'        => 'required',
            'alamat'        => 'required',
            'pend_akhir'    => 'required',
            'jurusan'       => 'required',
            'no_hp'         => 'required|numeric',
            'posisi'        => 'required',
            'tgl_masuk'     => 'required|date',
            'password'      => ['required','min:6'],
            'nm_ibu'        => 'nullable',
        ];

        // Jika nomor induk yang baru berbeda dengan nomor induk yang lama, tambahkan aturan validasi unik
        if ($request->nik != $user->nik) {
            $rules['nik'] = ['required|numeric|digits:16|unique:tb_pendidik'];
        }

        // Periksa apakah ada perubahan alamat email
        if ($request->username != $user->username) {
            $rules['username'] = ['required|unique:tb_pendidik'];
        }

        // Periksa apakah ada perubahan alamat email
        if ($request->email != $user->email) {
            $rules['email'] = ['required', 'email:dns','unique:tb_pendidik'];
        }

        // Jika ada file yang diunggah, tambahkan aturan validasi untuk foto
        if ($request->file('foto')) {
            $rules['foto'] = ['mimes:jpeg,jpg,png,webp', 'max:5120'];
        }

        // Lakukan validasi
        $validatedData = $request->validate($rules);

        // Jika ada file yang diunggah, simpan foto dan hapus foto lama
        if ($request->file('foto')) {
            Storage::delete('public/' . $user->foto);
            $validatedData['foto'] = $request->file('foto')->store('admin-images', 'public');
        }

        // Konversi semua data input menjadi huruf kecil
        foreach ($validatedData as $key => $value) {
            $validatedData[$key] = strtolower($value);
        }

        // Hash password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Update data pengguna
        $user->update($validatedData);

        return redirect('/user')->with('message', 'Data Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Periksa apakah pengguna ada
        if($user) {
            // Hapus foto jika ada
            if ($user->foto) {
                // Menghapus foto dari storage
                Storage::delete('public/' . $user->foto);
            }
            
            // Hapus pengguna
            $user->delete();

            // Redirect dengan pesan berhasil
            return redirect('/user')->with('message', 'Data Berhasil Dihapus!');
        } else {
            // Redirect dengan pesan error jika pengguna tidak ditemukan
            return redirect('/user')->with('error', 'Data tidak ditemukan!');
        }
    }
    public function gantipassword()
    {
        return view('dashboard.data-master.personalia.gantipassword', [
            "halaman" => "Ganti Password",
            "title" => "Personalia",
            "tab_title" => "Ganti Password User"
        ]);
    }
    public function updatepassword(Request $request)
    {
        $request->validate([
            'oldpassword' => ['required', 'min:6'],
            'newpassword' => ['required', 'min:6', 'different:oldpassword'],
            'verpassword' => ['required', 'same:newpassword'],
        ]);

        // Periksa apakah password lama cocok dengan password pengguna
        if (!Hash::check($request->oldpassword, auth()->user()->password)) {
            return back()->withErrors(['oldpassword' => 'Password lama tidak cocok!!'])->withInput();
        }

        // Update password pengguna
        auth()->user()->update([
            'password' => Hash::make($request->newpassword)
        ]);

        return redirect('/ganti-password')->with('message', 'Password berhasil Diperbarui!');
    }
}
