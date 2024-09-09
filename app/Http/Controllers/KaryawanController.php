<?php

namespace App\Http\Controllers;

use App\Bagian;
use App\DataBagian;
use App\DataKaryawan;
use App\Karyawan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KaryawanController extends Controller
{
    public function index() {
        $bagians = DataBagian::all();

        return view('pages.karyawan', compact('bagians'));
    }

    public function show() {
        $karyawans = DataKaryawan::all();

        return DataTables::of($karyawans)->make(true);
    }

    public function add(Request $request) {
        // Cari data bagian yang dipilih
        $bagian = DataBagian::where('bagian', $request->bagian)->first();

        if ($bagian) {
            // Simpan data karyawan beserta gaji dari tabel data_bagians
            DataKaryawan::create([
                'nik' => $request->nik,
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenisKelamin,
                'bagian' => $request->bagian,
                'gaji_pokok' => $bagian->gaji_pokok,
                'transport' => $bagian->transport,
                'total_gaji' => $bagian->total_gaji,
                'tanggal_masuk' => $request->tanggalMasuk,
            ]);
        } else {
            return response()->json(['error' => 'Bagian tidak ditemukan'], 404);
        }
    }

    public function getUpdate($id)
    {
        $karyawan = DataKaryawan::find($id);

        if (!$karyawan) {
            return response()->json(['error' => 'Karyawan not found'], 404);
        }

        return response()->json([
            'nik' => $karyawan->nik,
            'nama' => $karyawan->nama,
            'jenis_kelamin' => $karyawan->jenis_kelamin,
            'bagian' => $karyawan->bagian,
            'tanggal_masuk' => $karyawan->tanggal_masuk,
        ]);
    }

    public function update(Request $request, $id) {
        $karyawan = DataKaryawan::find($id);

        if (!$karyawan) {
            return response()->json(['error' => 'Karyawan not found'], 404);
        }

        // Cari bagian terkait
        $bagian = DataBagian::where('bagian', $request->bagian)->first();

        if (!$bagian) {
            return response()->json(['error' => 'Bagian not found'], 404);
        }

        // Update data karyawan
        $karyawan->nik = $request->nik;
        $karyawan->nama = $request->nama;
        $karyawan->jenis_kelamin = $request->jenisKelamin;
        $karyawan->bagian = $request->bagian;
        $karyawan->gaji_pokok = $bagian->gaji_pokok;
        $karyawan->transport = $bagian->transport;
        $karyawan->total_gaji = $bagian->gaji_pokok + $bagian->transport;
        $karyawan->tanggal_masuk = $request->tanggalMasuk;
        $karyawan->save();

        return response()->json(['success' => 'Karyawan updated successfully']);
    }

    public function delete(Request $request) {
        $ids = $request->ids;

        if (is_array($ids) && count($ids) > 0) {
            DataKaryawan::whereIn('id', $ids)->delete();
            return response()->json(['success' => 'Karyawan deleted successfully']);
        }

        return response()->json(['error' => 'No Karyawan selected'], 400);
    }

}
