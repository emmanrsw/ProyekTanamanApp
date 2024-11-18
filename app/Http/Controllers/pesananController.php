<?php

namespace App\Http\Controllers;

use App\Models\transaksiModel;
use Illuminate\Http\Request;
use App\Models\transkasiModel;
use Illuminate\Support\Facades\Storage;

class pesananController extends Controller
{

    public function show()
    {
        return view('pesanan');
    }
}
