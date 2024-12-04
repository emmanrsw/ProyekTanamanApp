<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pelangganModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
//import Http Request
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PelangganController extends Controller
{
    public function showProfile()
    {
        $customer = Auth::guard('pelanggan')->user();
        if (!$customer) {
            return redirect()->route('login.login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        return view('profilPage', ['customer' => $customer]);
    }
    public function edit()
    {
        // Dapatkan pelanggan yang sedang login
        $customer = Auth::guard('pelanggan')->user();

        // Jika pelanggan tidak ditemukan, arahkan ke halaman login
        if (!$customer) {
            return redirect()->route('login.login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Kirim data pelanggan ke view
        return view('editProfil', ['customer' => $customer]);
    }
    public function updateProfile(Request $request)
    {
        // Validasi input
        $request->validate([
            'namaCust' => 'required|string|max:255',
            'emailCust' => 'required|email|max:255',
            'notelpCust' => 'required|string|max:15',
            'alamatCust' => 'required|string|max:255',
        ]);

        $customerId = Auth::id(); // Mengambil ID pelanggan dari sesi autentikasi
        $customer = pelangganModel::find($customerId);

        if (!$customer) {
            return redirect()->route('profile')->with('error', 'Pelanggan tidak ditemukan.');
        }

        // Update data pelanggan
        $customer->update($request->only(['namaCust', 'emailCust', 'notelpCust', 'alamatCust']));

        // Redirect ke halaman profil dengan pesan sukses
        return redirect()->route('pelanggan.profile')->with('success', 'Profil berhasil diperbarui.');
    }
    public function updateProfilePicture(Request $request)
    {
        // Validasi file yang diupload
        $request->validate([
            'profileImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Mengambil file yang diupload
        $image = $request->file('profileImage');

        // Menyimpan gambar ke penyimpanan lokal/public (atau bisa menggunakan cloud storage)
        $imagePath = $image->storeAs('gambarCust', time() . '.' . $image->getClientOriginalExtension(), 'public');

        // Menggunakan guard 'pelanggans' untuk mendapatkan pelanggan yang sedang login
        $customerId = Auth::id(); // Mengambil ID pelanggan dari sesi autentikasi
        $customer = pelangganModel::find($customerId);

        // Jika pelanggan tidak ditemukan, kembalikan dengan error
        if (!$customer) {
            return back()->with('error', 'Pelanggan tidak ditemukan.');
        }

        // Simpan path gambar ke database (ubah 'profile_picture' menjadi 'gambarCust')
        $customer->gambarCust = $imagePath;  // Menggunakan kolom 'gambarCust' yang benar
        $customer->save();

        return back()->with('success', 'Gambar profil berhasil diperbarui');
    }
}
