<?php

namespace App\Http\Controllers;

use App\DataBagian;
use App\DataKaryawan;
use App\DataKehadiran;
use Illuminate\Http\Request;

class SlipGajiController extends Controller
{
    public function index() {
        $karyawans = DataBagian::all();

        return view('pages.slipGaji', compact('karyawans'));
    }

    public function showOption(Request $request) {
        $karyawanByBagian = DataKaryawan::where('bagian', $request->bagian)->get();
        return response()->json($karyawanByBagian);
    }

    public function cetakSlipGaji(Request $request) {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $bagian = $request->bagian;
        $nama = $request->nama;
    
        // Ambil data slip gaji berdasarkan bagian dan nama
        $karyawan = DataKaryawan::where('bagian', $bagian)->where('nama', $nama)->first();

        // Ambil data kehadiran berdasarkan karyawan, bulan, dan tahun
        $kehadiran = DataKehadiran::where('karyawan_id', $karyawan->id)
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->first();

        // Jika data kehadiran ada, hitung potongan
        if ($kehadiran) {
            // Hitung potongan berdasarkan alpha dan sakit
            $potongan = ($kehadiran->alpha * 50000) + ($kehadiran->sakit * 25000);
        } else {
            // Jika tidak ada data kehadiran, set potongan ke 0
            $potongan = 0;
        }

        // Hitung total gaji
        $total_gaji = ($karyawan->gaji_pokok + $karyawan->transport) - $potongan;
    
        // Tampilkan halaman cetak dengan data yang diperlukan
        return view('prints.cetakSlipGaji', compact('karyawan', 'bulan', 'tahun', 'kehadiran', 'potongan', 'total_gaji'));
    }    
    
}
