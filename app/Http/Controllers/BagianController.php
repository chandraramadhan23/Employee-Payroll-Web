<?php

namespace App\Http\Controllers;

use App\Bagian;
use App\Karyawan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BagianController extends Controller
{
    public function index() {
        return view('pages.bagian');
    }

    public function show() {
        $bagians = Bagian::all();

        return DataTables::of($bagians)->make(true);
    }

    public function add(Request $request) {
        $totalGaji = $request->gaji_pokok + $request->transport;

        Bagian::create([
            'bagian' => $request->bagian,
            'gaji_pokok' => $request->gaji_pokok,
            'transport' => $request->transport,
            'total_gaji' => $totalGaji,
        ]);
    }

    public function update(Request $request) {
        // Cari bagian berdasarkan ID
        $bagian = Bagian::find($request->id);

        // Simpan nama bagian lama agar nanti bisa diupdate ke tabel karyawan
        $namaBagianLama = $bagian->bagian;

        // Update data bagian
        $bagian->bagian = $request->bagian;
        $bagian->gaji_pokok = $request->gaji_pokok;
        $bagian->transport = $request->transport;
        $bagian->total_gaji = $bagian->gaji_pokok + $bagian->transport;
        $bagian->save();

        // Update bagian di tabel Karyawan
        Karyawan::where('bagian', $namaBagianLama)->update(['bagian' => $request->bagian]);
    }

    public function delete($id) {
        // Temukan bagian berdasarkan ID
        $bagian = Bagian::findOrFail($id);

        // Set kolom 'bagian' di tabel Karyawan menjadi null jika bagian tersebut dihapus
        Karyawan::where('bagian', $bagian->bagian)->update(['bagian' => null]);

        // Hapus bagian dari tabel Bagian
        $bagian->delete();
    }
}
