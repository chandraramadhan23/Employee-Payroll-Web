<?php

namespace App\Http\Controllers;

use App\DataKaryawan;
use App\DataKehadiran;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KehadiranController extends Controller
{
    public function index() {
        return view('pages.kehadiran');
    }

    public function show(Request $request) {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Validasi jika bulan dan tahun tidak ada
        if (!$bulan || !$tahun) {
            return response()->json(['error' => 'Bulan dan tahun harus diisi'], 400);
        }

        // Query untuk mengambil data karyawan dan data kehadiran berdasarkan bulan dan tahun
        $karyawans = DataKaryawan::with(['data_kehadirans' => function($query) use ($bulan, $tahun) {
            $query->where('bulan', $bulan)
                ->where('tahun', $tahun);
        }])->get();

        // Siapkan data untuk DataTables
        return DataTables::of($karyawans)
            ->addColumn('sakit', function ($row) use ($bulan, $tahun) {
                // Ambil data sakit dari relasi data_kehadirans
                $kehadiran = $row->data_kehadirans->where('bulan', $bulan)->where('tahun', $tahun)->first();
                return $kehadiran ? $kehadiran->sakit : 0;  // Jika tidak ada, kembalikan 0
            })
            ->addColumn('alpha', function ($row) use ($bulan, $tahun) {
                // Ambil data alpha dari relasi data_kehadirans
                $kehadiran = $row->data_kehadirans->where('bulan', $bulan)->where('tahun', $tahun)->first();
                return $kehadiran ? $kehadiran->alpha : 0;  // Jika tidak ada, kembalikan 0
            })
            ->make(true);
    }


    public function add(Request $request) {
        $dataKehadiran = $request->input('dataKehadiran');

        // Loop untuk menyimpan setiap data kehadiran karyawan
        foreach ($dataKehadiran as $kehadiran) {
            DataKehadiran::updateOrCreate(
                [
                    'karyawan_id' => $kehadiran['karyawan_id'],
                    'bulan' => $kehadiran['bulan'],
                    'tahun' => $kehadiran['tahun']
                ],
                [
                    'sakit' => $kehadiran['sakit'],
                    'alpha' => $kehadiran['alpha']
                ]
            );
        }

        return response()->json(['success' => 'Data kehadiran berhasil disimpan']);
    }
}
