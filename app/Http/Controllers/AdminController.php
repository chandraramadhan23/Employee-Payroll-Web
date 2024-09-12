<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function index() {
        return view('pages.admin');
    }

    public function show() {
        $admins = User::all();

        return DataTables::of($admins)->make(true);
    }

    public function add(Request $request) {
        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);
    }

    public function delete($id) {
        $admin = User::findOrFail($id);
        $admin->delete();
    }
}
