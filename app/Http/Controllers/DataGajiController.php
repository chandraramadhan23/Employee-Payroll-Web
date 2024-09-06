<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataGajiController extends Controller
{
    public function index() {
        return view('pages.dataGaji');
    }
}
