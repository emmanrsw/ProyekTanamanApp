<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    public function homePage()
    {
        session()->flash('success', 'Selamat datang di Tanam.in!');
        return view('homePage');
    }
}
