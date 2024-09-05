<?php

namespace App\Http\Controllers;

use App\Bagian;
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
        $totalGaji = $request->gaji_pokok + $request->transport;

        Bagian::where('id', $request->id)->update([

            'bagian' => $request->bagian,
            'gaji_pokok' => $request->gaji_pokok,
            'transport' => $request->transport,
            'total_gaji' => $totalGaji,

        ]);
    }

    public function delete($id) {
        Bagian::find($id)->delete();
    }
}
