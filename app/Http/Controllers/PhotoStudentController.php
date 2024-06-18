<?php

namespace App\Http\Controllers;

use App\Models\PhotoStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PhotoStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort(404);
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
        if ($request->hasFile('foto')) {
            // Validasi tambahan untuk memastikan file adalah gambar
            $request->validate([
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $file = $request->file('foto');
            $path = $file->store('foto-student', 'public'); // Pastikan 'public' adalah disk yang benar
            
            // Ambil nilai no_induk dari request
            $no_induk = $request->input('no_induk');

            $photoStudent = new PhotoStudent();
            $photoStudent->no_induk = $no_induk; // Gunakan nilai no_induk yang diterima
            $photoStudent->judul_foto = basename($path);
            $photoStudent->foto = $path;
            $photoStudent->save(); // Simpan objek dengan benar

            return response()->json(['success' => 'Foto berhasil diupload.']); // Kode status sukses
        } else {
            return response()->json(['error' => 'Tidak ada file yang diupload.'], 500); // Kode status error
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PhotoStudent $photoStudent)
    {
        abort(404);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PhotoStudent $photoStudent)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $no_induk)
    {
        $photoStudent = PhotoStudent::where('no_induk', $no_induk)->firstOrFail();

        if ($request->hasFile('foto')) {
            $request->validate([
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Hapus foto lama jika ada
            if ($photoStudent->foto) {
                Storage::disk('public')->delete($photoStudent->foto);
            }

            $file = $request->file('foto');
            $path = $file->store('foto-student', 'public');

            $photoStudent->judul_foto = basename($path);
            $photoStudent->foto = $path;
            $photoStudent->save();

            return response()->json(['success' => 'Foto berhasil diperbarui.']);
        } else {
            return response()->json(['error' => 'Tidak ada file yang diupload.'], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($no_induk)
    {
        $photo = PhotoStudent::where('no_induk', $no_induk)->firstOrFail();
        $filePath = public_path('storage/foto-student/' . $photo->judul_foto);
        
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $photo->delete();

        return back()->with('message', 'Foto berhasil dihapus.');
    }
}
