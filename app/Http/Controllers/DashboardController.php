<?php

namespace App\Http\Controllers;

use App\Models\Pembiayaan;
use App\Models\Penjualan;
use App\Models\Proyek;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $totalPenjualan = Penjualan::count();
    $totalPembiayaan = Pembiayaan::count();
    $totalProyek = Proyek::count();

    return view('dashboard.index', compact('totalPenjualan', 'totalPembiayaan', 'totalProyek'));
}
}
