<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SlipGajiController extends Controller
{
    public function index() {
        return view('pages.slipGaji');
    }
}
