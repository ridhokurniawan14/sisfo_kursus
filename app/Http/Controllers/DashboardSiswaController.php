<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardSiswaController extends Controller
{
    public function index()
    {
        return view('siswa.dashboard.index', [
            "halaman" => "Dashboard",
            "title" => "Dashboard",
            "tab_title" => "Dashboard",
        ]);
    }
}
