<?php

namespace App\Http\Controllers;

use App\Bagian;
use App\DataBagian;
use App\DataKaryawan;
use App\Karyawan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BagianController extends Controller
{
    public function index() {
        return view('pages.bagian');
    }

    public function show() {
        $bagian_list = DataBagian::all();

        return DataTables::of($bagian_list)->make(true);
    }

    public function add(Request $request) {
        $totalGaji = $request->gaji_pokok + $request->transport;

        DataBagian::create([
            'bagian' => $request->bagian,
            'gaji_pokok' => $request->gaji_pokok,
            'transport' => $request->transport,
            'total_gaji' => $totalGaji,
        ]);
    }

    public function update(Request $request) {
        // Cari bagian berdasarkan ID
        $bagian = DataBagian::find($request->id);

        // Simpan nama bagian lama agar nanti bisa diupdate ke tabel karyawan
        $namaBagianLama = $bagian->bagian;

        // Update data bagian
        $bagian->bagian = $request->bagian;
        $bagian->gaji_pokok = $request->gaji_pokok;
        $bagian->transport = $request->transport;
        $bagian->total_gaji = $bagian->gaji_pokok + $bagian->transport;
        $bagian->save();

        // Update bagian dan gaji di tabel karyawan
        DataKaryawan::where('bagian', $namaBagianLama)->update([
            'bagian' => $request->bagian,
            'gaji_pokok' => $request->gaji_pokok,
            'transport' => $request->transport,
            'total_gaji' => $request->gaji_pokok + $request->transport,
        ]);
    }

    public function delete($id) {
         // Temukan bagian berdasarkan ID
        $bagian = DataBagian::findOrFail($id);

        // Set kolom 'bagian', 'gaji_pokok', 'transport', dan 'total_gaji' di tabel Karyawan menjadi null jika bagian tersebut dihapus
        DataKaryawan::where('bagian', $bagian->bagian)->update([
            'bagian' => null,
            'gaji_pokok' => null,
            'transport' => null,
            'total_gaji' => null
        ]);

        // Hapus bagian dari tabel Bagian
        $bagian->delete();
    }
}
