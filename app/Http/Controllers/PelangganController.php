<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
//import Http Request
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PelangganController extends Controller
{
    public function edit()
    {
        // $user = Session::get('customer');
        // if (!$user) {
        //     return redirect()->route('login');
        // }
        // return view('editProfil', ['customer' => $user]);
        // Ambil ID customer dari session
        $customerId = Session::get('idCust');

        // Jika session kosong, arahkan ke halaman login
        if (!$customerId) {
            return redirect()->route('login');
        }

        // Ambil data customer dari database berdasarkan ID
        $customer = Pelanggan::find($customerId);

        // Jika customer tidak ditemukan, arahkan ke halaman login atau tampilkan error
        if (!$customer) {
            return redirect()->route('login')->with('error', 'Customer not found.');
        }

        // Kirim data customer ke view
        return view('editProfil', ['customer' => $customer]);
    }
    public function updateProfile(Request $request)
    {
        // // $user = Session::get('customer');
        // // Ambil ID pelanggan dari session
        // $user = Session::get('customer');

        // // Ambil data pelanggan dari database berdasarkan ID

        // // Lihat apakah `customer_id` memiliki nilai yang benar
        // $pelanggan = Pelanggan::where('idCust', $user->idCust)->first();
        // // dd($user->idCust);
        // $pelanggan->update($request->only(['namaCust', 'emailCust', 'notelp', 'alamatCust']));
        // // dd($pelanggan);     
        // return view('profilPage', ['customer' => $pelanggan]);
        // Ambil ID pelanggan dari session
        $customerId = Session::get('idCust');

        // Ambil data pelanggan dari database berdasarkan ID
        $pelanggan = Pelanggan::where('idCust', $customerId)->first();

        // Pastikan pelanggan ditemukan
        if (!$pelanggan) {
            return redirect()->route('profile')->with('error', 'Customer not found.');
        }

        // Update data pelanggan berdasarkan input form
        $pelanggan->update($request->only(['namaCust', 'emailCust', 'notelp', 'alamatCust']));

        // Kembali ke halaman profil setelah update berhasil
        return view('profilPage', ['customer' => $pelanggan]);
    }
}
