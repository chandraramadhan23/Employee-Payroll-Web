<?php

namespace App\Http\Controllers;

use App\DataGaji;
use App\DataKaryawan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DataGajiController extends Controller
{
    public function index() {
        return view('pages.dataGaji');
    }

    public function show(Request $request) {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Ambil data karyawan dan data kehadiran sesuai dengan bulan dan tahun yang dipilih
        $karyawans = DataKaryawan::leftJoin('data_kehadirans', 'data_karyawans.id', '=', 'data_kehadirans.karyawan_id')
            ->select(
                'data_karyawans.nik',
                'data_karyawans.nama',
                'data_karyawans.jenis_kelamin',
                'data_karyawans.bagian',
                'data_karyawans.gaji_pokok',
                'data_karyawans.transport',
                'data_kehadirans.sakit',
                'data_kehadirans.alpha'
            )
            ->where('data_kehadirans.bulan', $bulan)
            ->where('data_kehadirans.tahun', $tahun)
            ->get()
            ->map(function($item) {
                // Hitung potongan
                $potongan = ($item->alpha * 50000) + ($item->sakit * 25000);
                // Hitung total gaji
                $total_gaji = ($item->gaji_pokok + $item->transport) - $potongan;

                return [
                    'nik' => $item->nik,
                    'nama' => $item->nama,
                    'jenis_kelamin' => $item->jenis_kelamin,
                    'bagian' => $item->bagian,
                    'gaji_pokok' => $item->gaji_pokok,
                    'transport' => $item->transport,
                    'total_potongan' => $potongan,
                    'total_gaji' => $total_gaji,
                ];
            });

        return DataTables::of($karyawans)->make(true);
    }
    

    public function cetak(Request $request) {
        $data = $request->input('data');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        return view('prints.cetakDataGaji', [
            'data' => json_decode($data),
            'bulan' => $bulan,
            'tahun' => $tahun
        ]);
    }
}
