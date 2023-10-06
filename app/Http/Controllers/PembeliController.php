<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembeliController extends Controller
{
    public function keranjang(){
        return view("pembeli.keranjang");
    }
}
