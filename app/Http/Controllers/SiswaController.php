<?php

namespace App\Http\Controllers;

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
        //
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
