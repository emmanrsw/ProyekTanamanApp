<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pelangganModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
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
        $request->validate([
            'usernameCust' => 'required|string|max:255',
            'namaCust' => 'required|string|max:255',
            'emailCust' => 'required|email|max:255',
            'notlpCust' => 'required|string|max:15',
            'alamatCust' => 'required|string',
            'profileImage' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $customer = Auth::guard('pelanggan')->user();

        if ($request->hasFile('profileImage')) {
            // Hapus gambar lama jika ada
            if ($customer->gambarCust) {
                $oldImagePath = storage_path('app/public/' . $customer->gambarCust);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Menghapus file lama
                }
            }

            // Simpan gambar baru
            $image = $request->file('profileImage');
            $imagePath = $image->store('profile_images', 'public'); // Simpan di storage/app/public

            $customer->gambarCust = $imagePath; // Update database dengan path gambar baru
        }

        // Jika tombol 'Hapus Gambar' ditekan
        if ($request->has('delete_image')) {
            if ($customer->gambarCust) {
                $oldImagePath = storage_path('app/public/' . $customer->gambarCust);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Menghapus file lama
                }
                $customer->gambarCust = null; // Hapus data gambar di database
            }
        }

        // Update data customer lainnya
        $customer->usernameCust = $request->input('usernameCust');
        $customer->namaCust = $request->input('namaCust');
        $customer->emailCust = $request->input('emailCust');
        $customer->notlpCust = $request->input('notlpCust');
        $customer->alamatCust = $request->input('alamatCust');
        // dd(get_class($customer), $customer);
        // Simpan perubahan ke database
        $customer->save();

        return redirect()->route('pelanggan.profile')->with('success', 'Profil berhasil diperbarui.');
    }


    // public function updateProfilePicture(Request $request)
    // {
    //     // Validasi file yang diupload
    //     $request->validate([
    //         'profileImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);

    //     // Mengambil file yang diupload
    //     $image = $request->file('profileImage');

    //     // Menyimpan gambar ke penyimpanan lokal/public (atau bisa menggunakan cloud storage)
    //     $imagePath = $image->storeAs('gambarCust', time() . '.' . $image->getClientOriginalExtension(), 'public');

    //     // Menggunakan guard 'pelanggans' untuk mendapatkan pelanggan yang sedang login
    //     $customerId = Auth::id(); // Mengambil ID pelanggan dari sesi autentikasi
    //     $customer = pelangganModel::find($customerId);

    //     // Jika pelanggan tidak ditemukan, kembalikan dengan error
    //     if (!$customer) {
    //         return back()->with('error', 'Pelanggan tidak ditemukan.');
    //     }

    //     // Simpan path gambar ke database (ubah 'profile_picture' menjadi 'gambarCust')
    //     $customer->gambarCust = $imagePath;  // Menggunakan kolom 'gambarCust' yang benar
    //     $customer->save();

    //     return back()->with('success', 'Gambar profil berhasil diperbarui');
    // }
    // Memperbarui gambar profil
    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profileImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $customer = Auth::guard('pelanggan')->user(); // Ambil data pengguna yang sedang login

        if ($request->hasFile('profileImage')) {
            // Hapus gambar lama jika ada
            if ($customer->gambarCust && file_exists(public_path('uploads/' . $customer->gambarCust))) {
                unlink(public_path('uploads/' . $customer->gambarCust));
            }

            // Simpan gambar baru
            $filename = time() . '.' . $request->file('profileImage')->getClientOriginalExtension();
            $request->file('profileImage')->move(public_path('uploads'), $filename);

            // Update database dengan nama file
            $customer->gambarCust = $filename;
            $customer->save();
        }

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui!');
    }

    // public function updateProfilePicture(Request $request)
    // {
    //     // Validasi file gambar yang diunggah
    //     $request->validate([
    //         'profileImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);

    //     // Cek apakah ada file yang di-upload
    //     if ($request->hasFile('profileImage')) {
    //         $image = $request->file('profileImage');

    //         // Simpan gambar ke storage dan buat nama file unik
    //         $imagePath = $image->storeAs(
    //             'gambarCust',
    //             time() . '.' . $image->getClientOriginalExtension(),
    //             'public'
    //         );

    //         // Ambil data pelanggan
    //         $customer = Auth::guard('pelanggan')->user();

    //         if (!$customer) {
    //             return back()->with('error', 'Pelanggan tidak ditemukan.');
    //         }

    //         // Jika pelanggan sudah memiliki gambar lama, hapus gambar tersebut
    //         if ($customer->gambarCust && Storage::disk('public')->exists($customer->gambarCust)) {
    //             Storage::disk('public')->delete($customer->gambarCust);
    //         }

    //         // Update path gambar di database
    //         $customer->gambarCust = $imagePath;

    //         // Pastikan data berhasil disimpan
    //         if ($customer->save()) {
    //             return back()->with('success', 'Gambar profil berhasil diperbarui.');
    //         } else {
    //             return back()->with('error', 'Terjadi kesalahan saat menyimpan gambar profil.');
    //         }
    //     }

    //     // Jika tidak ada gambar yang diupload
    //     return back()->with('error', 'Tidak ada gambar yang dipilih.');
    // }
    public function deleteProfilePicture(Request $request)
    {
        $customer = Auth::guard('pelanggan')->user();

        if ($request->has('deleteProfileImage') && $customer->gambarCust) {
            // Hapus gambar dari penyimpanan
            Storage::delete('public/' . $customer->gambarCust);

            // Reset gambar profil di database
            $customer->gambarCust = null;
            $customer->save();

            // Redirect kembali dengan pesan sukses
            return back()->with('success', 'Gambar profil berhasil dihapus.');
        }

        return back()->with('error', 'Tidak ada gambar profil yang dapat dihapus.');
    }

    public function hapusGambar(Request $request)
    {
        // Ambil data pelanggan
        $customer = Auth::user(); // Atau gunakan metode lain untuk mendapatkan data pelanggan

        // Cek apakah gambar ada
        if ($customer->gambarCust) {
            $gambarPath = public_path('uploads/' . $customer->gambarCust);

            // Hapus file dari direktori jika ada
            if (file_exists($gambarPath)) {
                unlink($gambarPath);
            }

            // Set kolom gambar menjadi null
            $customer->gambarCust = null;
            $customer->save();

            return redirect()->back()->with('success', 'Gambar berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Gambar tidak ditemukan.');
    }
}
