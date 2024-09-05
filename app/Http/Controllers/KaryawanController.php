<?php

namespace App\Http\Controllers;

use App\Bagian;
use App\Karyawan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KaryawanController extends Controller
{
    public function index() {
        $bagians = Bagian::all();

        return view('pages.karyawan', compact('bagians'));
    }

    public function show() {
        $karyawans = Karyawan::all();

        return DataTables::of($karyawans)->make(true);
    }

    public function add(Request $request) {
        Karyawan::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenisKelamin,
            'bagian' => $request->bagian,
            'tanggal_masuk' => $request->tanggalMasuk,
        ]);
    }

    public function getUpdate($id)
    {
        $karyawan = Karyawan::find($id);

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
        $karyawan = Karyawan::find($id);

        if (!$karyawan) {
            return response()->json(['error' => 'Karyawan not found'], 404);
        }

        $karyawan->nik = $request->nik;
        $karyawan->nama = $request->nama;
        $karyawan->jenis_kelamin = $request->jenisKelamin;
        $karyawan->bagian = $request->bagian;
        $karyawan->tanggal_masuk = $request->tanggalMasuk;
        $karyawan->save();

        return response()->json(['success' => 'Karyawan updated successfully']);
    }

    public function delete(Request $request) {
        $ids = $request->ids;

        if (is_array($ids) && count($ids) > 0) {
            Karyawan::whereIn('id', $ids)->delete();
            return response()->json(['success' => 'Karyawan deleted successfully']);
        }

        return response()->json(['error' => 'No Karyawan selected'], 400);
    }

}
