<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tanamanModel;

class tanamanController extends Controller
{


    public function indexP(Request $request)
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


        return view('tanamanHPP', [
            'plants' => $plants,
            'searchQuery' => $searchQuery,
        ]);
    }


    public function showTanaman(Request $request)
    {
        // Mengambil semua data tanaman dari database
        $tanaman = tanamanModel::all();

        // Mendapatkan nilai pencarian dari query string
        $searchQuery = $request->input('search', '');

        // Jika ada pencarian, filter data
        if (!empty($searchQuery)) {
            $tanaman = $tanaman->filter(function ($plant) use ($searchQuery) {
                return stripos($plant->name, $searchQuery) !== false;
            });
        }

        return view('daftar_tanaman', [
            'tanaman' => $tanaman, // Pastikan ini adalah Collection
            'searchQuery' => $searchQuery,
        ]);
    }

    public function tambahTanaman()
    {
        return view('tambahT'); // Ganti dengan nama view form Anda
    }

    public function batalTambah()
    {
        return redirect()->route('homeKywn');  // Mengarahkan kembali ke halaman daftar tanaman karyawan
    }
    

    public function simpanTanaman(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'namaTanaman' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jmlTanaman' => 'required|integer',
            'hargaTanaman' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images'), $imageName);
        } else {
            $imageName = null;  // Jika tidak ada gambar
        }

        // Simpan data ke database
        tanamanModel::create([
            'namaTanaman' => $request->namaTanaman,
            'deskripsi' => $request->deskripsi,
            'jmlTanaman' => $request->jmlTanaman,
            'hargaTanaman' => $request->hargaTanaman,
            'gambar' => $imageName, // Simpan nama file gambar
        ]);
        // // Redirect atau tampilkan pesan sukses
        // return redirect()->route('homeKywn')->with('success', 'Tanaman berhasil ditambahkan!');

        // Redirect ke halaman lain atau tampilkan pesan sukses
        return redirect()->back()->with('success', 'Data tanaman berhasil disimpan!');
    }






    
    public function edit($id)
    {
        // Ambil data tanaman berdasarkan ID
        $tanaman = tanamanModel::findOrFail($id);

        // Kirim data tanaman ke view edit
        return view('tanaman.edit', compact('tanaman'));
    }


    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'namaTanaman' => 'required|string|max:255',
            'jmlTanaman' => 'required|integer',
            'hargaTanaman' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Ambil data tanaman yang akan diupdate
        $tanaman = tanamanModel::findOrFail($id);

        // Jika ada file gambar baru, maka upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($tanaman->gambar && file_exists(public_path('images/' . $tanaman->gambar))) {
                unlink(public_path('images/' . $tanaman->gambar));
            }

            // Simpan gambar baru
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images'), $imageName);
        } else {
            // Jika tidak ada gambar baru, gunakan gambar lama
            $imageName = $tanaman->gambar;
        }

        // Update data tanaman
        $tanaman->update([
            'namaTanaman' => $request->namaTanaman,
            'jmlTanaman' => $request->jmlTanaman,
            'hargaTanaman' => $request->hargaTanaman,
            'deskripsi' => $request->deskripsi,
            'gambar' => $imageName,
        ]);

        // Redirect ke halaman lain atau tampilkan pesan sukses
        return redirect()->back()->with('success', 'Data tanaman berhasil diperbarui!');
    }
}
