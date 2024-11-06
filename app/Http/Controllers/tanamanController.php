<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tanamanModel;
use Illuminate\Support\Facades\Storage;

class tanamanController extends Controller
{
    public function listTanaman()
    {
        $tanaman = tanamanModel::all(); // Mengambil semua data tanaman dari database
        return view('listTanaman', compact('tanaman')); // Kirim variabel tanaman ke view
    }

    public function indexP(Request $request)
    {
        $searchQuery = $request->input('search');
        $tanaman = tanamanModel::when($searchQuery, function ($query, $searchQuery) {
            return $query->where('name', 'like', '%' . $searchQuery . '%');
        })->get();

        return view('tanamanHPP', compact('tanaman'));
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
        // Validasi input
        $request->validate([
            'namaTanaman' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jmlTanaman' => 'required|integer',
            'hargaTanaman' => 'required|numeric',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension(); // Menggunakan timestamp untuk nama file

            // ini yang diganti
            $file->move(public_path('images'), $filename); // Memindahkan gambar ke folder public/images
        }


        // Simpan data tanaman ke database
        tanamanModel::create([
            'namaTanaman' => $request->namaTanaman,
            'deskripsi' => $request->deskripsi,
            'jmlTanaman' => $request->jmlTanaman,
            'hargaTanaman' => $request->hargaTanaman,
            'gambar' => $filename, // Simpan nama file gambar
        ]);

        return redirect()->route('homeKywn')->with('success', 'Tanaman berhasil ditambahkan.');
    }


    public function editTanaman($id)
    {
        $tanaman = tanamanModel::findOrFail($id); // Temukan tanaman berdasarkan ID
        return view('editT', compact('tanaman')); // Kirim data tanaman ke view
    }

    public function updateTanaman(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'namaTanaman' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jmlTanaman' => 'required|integer',
            'hargaTanaman' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Gambar opsional
        ]);

        // Temukan tanaman berdasarkan ID
        $tanaman = tanamanModel::findOrFail($id);

        // Update field tanaman
        $tanaman->namaTanaman = $request->namaTanaman;
        $tanaman->deskripsi = $request->deskripsi;
        $tanaman->jmlTanaman = $request->jmlTanaman;
        $tanaman->hargaTanaman = $request->hargaTanaman;

        // Cek apakah ada gambar yang diunggah
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($tanaman->gambar) {
                $oldImagePath = public_path('images/' . $tanaman->gambar);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Hapus gambar lama
                }
            }

            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $tanaman->gambar = $filename; // Update nama file gambar
        }

        // Simpan perubahan ke database
        $tanaman->save();

        return redirect()->route('homeKywn')->with('success', 'Tanaman berhasil diperbarui.');
    }

    public function hapusTanaman(Request $request)
    {
        // Mendapatkan array ID tanaman dari permintaan
        $ids = $request->input('ids'); // Pastikan Anda mengirim array ID dengan nama 'ids'

        if ($ids) {
            foreach ($ids as $id) {
                // Temukan tanaman berdasarkan ID
                $tanaman = tanamanModel::find($id);

                if ($tanaman) {
                    // Hapus gambar dari penyimpanan jika ada
                    if ($tanaman->gambar) {
                        Storage::delete('images/' . $tanaman->gambar);
                    }

                    // Hapus tanaman dari database
                    $tanaman->delete();
                }
            }

            return redirect()->back()->with('success', 'Tanaman berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Tidak ada tanaman yang dipilih untuk dihapus.');
    }


    public function destroy(Request $request)
    {
        // Ambil ID tanaman dari permintaan
        $ids = explode(',', $request->input('ids'));

        // Hapus tanaman berdasarkan ID yang diberikan
        tanamanModel::whereIn('idTanaman', $ids)->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Tanaman berhasil dihapus.');
    }
}
