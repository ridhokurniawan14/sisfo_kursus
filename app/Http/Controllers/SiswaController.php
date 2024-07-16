<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('siswa.gantipassword.index', [
            "halaman" => "Ganti Password",
            "title" => "Siswa",
            "tab_title" => "Ganti Password"
        ]);
    }
    public function profile()
    {
        $student = Pendaftar::select('p.no_induk', 'p.*', 'pv.*', 'f.*', 'j.*')
            ->from('tb_pendaftar as p')
            ->join('tb_pendaftar_verifikasi as pv', 'p.no_induk', '=', 'pv.no_induk')
            ->leftJoin('tb_foto as f', 'p.no_induk', '=', 'f.no_induk')
            ->leftJoin('tb_jam as j', 'pv.kd_jam', '=', 'j.id')
            ->where('p.no_induk', auth()->user()->no_induk)
            ->first();

        if (!$student) {
            abort(404); // Menampilkan halaman 404 jika data tidak ditemukan
        }

        return view('siswa.profile.index', [
            "halaman" => "Profile",
            "title" => "Profile",
            "tab_title" => "Detail Profile",
            "data" => $student,
        ]);
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
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'oldpassword' => ['required'],
            'newpassword' => ['required', 'min:6', 'different:oldpassword'],
            'verpassword' => ['required', 'same:newpassword'],
        ]);

        /** @var User $user */
        $user = auth()->user();

        // Periksa apakah password lama cocok dengan password pengguna
        if (!Hash::check($request->oldpassword, $user->password)) {
            return back()->withErrors(['oldpassword' => 'Password lama tidak cocok!!'])->withInput();
        }

        // Update password pengguna
        $user->update([
            'password' => Hash::make($request->newpassword)
        ]);

        return redirect()->route('ganti-password.index')->with('message', 'Password berhasil Diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort(404);
    }
}
