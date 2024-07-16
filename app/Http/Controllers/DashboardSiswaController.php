<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class DashboardSiswaController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::with('user') // Melakukan eager load relasi 'user'
            ->orderBy('id', 'desc')
            ->where('untuk', '!=', 'pendidik')
            ->paginate(10);

        return view('siswa.dashboard.index', [
            "halaman" => "Dashboard",
            "title" => "Dashboard",
            "tab_title" => "Timeline",
            "datas" => $pengumumans,
        ]);
    }
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
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort(404);
    }
}
