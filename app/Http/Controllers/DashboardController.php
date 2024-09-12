<?php

namespace App\Http\Controllers;

use App\Admin;
use App\DataBagian;
use App\DataKaryawan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $totalAdmin = Admin::distinct('username')->count('username');
        $totalKaryawan = DataKaryawan::distinct('nik')->count('nik');
        $totalBagian = DataBagian::distinct('bagian')->count('bagian');

        return view('pages/dashboard', compact('totalAdmin', 'totalKaryawan', 'totalBagian'));
    }
}
