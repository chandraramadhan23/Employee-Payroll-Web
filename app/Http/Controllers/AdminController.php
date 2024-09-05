<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function index() {
        return view('pages.admin');
    }

    public function show() {
        $admins = Admin::all();

        return DataTables::of($admins)->make(true);
    }

    public function add(Request $request) {
        Admin::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => $request->password,
        ]);
    }

    public function delete($id) {
        $admin = Admin::findOrFail($id);
        $admin->delete();
    }
}
