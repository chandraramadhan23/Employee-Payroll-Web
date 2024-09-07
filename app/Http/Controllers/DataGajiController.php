<?php

namespace App\Http\Controllers;

use App\DataGaji;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DataGajiController extends Controller
{
    public function index() {
        return view('pages.dataGaji');
    }

    public function show(Request $request) {
        $query = DataGaji::query();
    
        // Filter berdasarkan bulan dan tahun
        if ($request->bulan && $request->tahun) {
            $bulan = $request->bulan;
            $tahun = $request->tahun;
    
            // Pastikan nama kolom 'bulan_tahun' sesuai dengan yang ada di database Anda
            // Gunakan whereMonth dan whereYear untuk memastikan format filter benar
            $query->whereMonth('bulan_tahun', $bulan)
                  ->whereYear('bulan_tahun', $tahun);
        } else {
            // Kembalikan data kosong jika bulan atau tahun tidak diisi
            return DataTables::of(collect([]))->make(true);
        }
    
        // Kembalikan hasil query
        return DataTables::of($query)->make(true);
    }
    
}
