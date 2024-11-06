<?php

namespace App\Http\Controllers;
use App\Models\tanamanModel;
use App\Models\karyawanModel;
use Illuminate\Http\Request;

class karyawanController extends Controller
{

    public function indexKywn(Request $request)
    {

        // Mengambil semua data tanaman dari database
        $plants = tanamanModel::all();

        // Mendapatkan nilai pencarian dari query string
        $searchQuery = $request->input('search', '');

        // Jika ada pencarian, filter data
        if (!empty($searchQuery)) {
            $plants = $plants->filter(function ($plant) use ($searchQuery) {
                return stripos($plant->namaTanaman, $searchQuery) !== false;
            });
        }

        return view('homeKywn', [
            'plants' => $plants, // Pastikan ini adalah Collection
            'searchQuery' => $searchQuery,
        ]);

    }


    public function hashPasswords()
    {
        karyawanModel::hashAllPasswords();
        return "Passwords have been hashed successfully.";
    }
}
