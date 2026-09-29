<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\SkemaSertifikasi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPeserta = Peserta::count();
        $totalSkema = SkemaSertifikasi::count();

        return view('dashboard', compact(
            'totalPeserta',
            'totalSkema'
        ));
    }
}
