<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AuthModel;
use App\Models\karyawanModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Facades\Mail;
// use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function index()
    {
        $data = [
            'username' => session('username'),
            'email' => session('email'),
        ];
        return view('home', $data);
    }

    public function login()
    {
        return view('login.login');
    }

    // ini sessionnnn
    // public function showProfile()
    // {
    //     // Ambil ID customer dari session
    //     $customerId = Session::get('customer');

    //     // Debug: Periksa apakah session mengandung ID
    //     if (!$customerId) {
    //         // Output sementara
    //         dd('Session customer tidak ditemukan');
    //     }

    //     // Jika session kosong, arahkan ke halaman login
    //     if (!$customerId) {
    //         return redirect()->route('login.login');
    //     }

    //     // Ambil data customer dari database berdasarkan ID
    //     $customer = AuthModel::find($customerId);

    //     // Debug: Periksa apakah customer ditemukan
    //     if (!$customer) {
    //         dd('Customer tidak ditemukan di database');
    //     }

    //     // Kirim data customer ke view
    //     return view('profilPage', ['customer' => $customer]);
    // }


    public function showProfile()
    {
        if (Auth::guard('pelanggan')->check()) {
            $customer = Auth::guard('pelanggan')->user();
            return view('profilePage', ['costumer' => $customer]);
        }
        // elseif(Auth::guard('karyawan')->check()){
        //     $karyawan = Auth::guard('karyawan')->check();
        //     return view('profilePage', ['customer'=>$karyawan]);
        // }
        return redirect()->route('login.login');
    }


    // sessionnnnnn 
    //     public function loginProcess(Request $request)
    //     {
    //         $username = $request->input('username');
    //         $password = $request->input('password');

    //         // Coba cari di tabel pelanggan terlebih dahulu
    //         $user = AuthModel::where('usernameCust', $username)->first();

    // // ubah ke guard jadi dimatiin dulu
    //         // // Jika tidak ditemukan di tabel pelanggan, cari di tabel karyawan
    //         // if (!$user) {
    //         //     $user = karyawanModel::where('usernameKywn', $username)->first();
    //         // }
    // // 

    //         // Proses autentikasi
    //         if ($user) {
    //             // Cek password sesuai dengan tabel yang digunakan
    //             if (($user instanceof AuthModel && Hash::check($password, $user->passwordCust)) ||
    //                 // ($user instanceof karyawanModel && Hash::check($password, $user->passwordKywn))
    //                 ($user instanceof karyawanModel && $user->passwordKywn === $password)

    //             ) {

    //                 Auth::login($user);

    //                 // Simpan data ke dalam session berdasarkan tipe pengguna
    //                 if ($user instanceof karyawanModel) {
    //                     session()->put([
    //                         'idKywn' => $user->idKywn,
    //                         'usernameKywn' => $user->usernameKywn,
    //                     ]);
    //                     return redirect()->route('homeKywn'); // Route untuk karyawan

    //                 } else {
    //                     session()->put([
    //                         'idCust' => $user->idCust,
    //                         'usernameCust' => $user->usernameCust,
    //                     ]);
    //                     return redirect()->route('home'); // Route untuk pelanggan
    //                 }
    //             } else {
    //                 // Jika password salah
    //                 session()->flash('msg', 'Password tidak sesuai');
    //                 return redirect()->route('login.login');
    //             }
    //         } else {
    //             // Jika user tidak ditemukan
    //             session()->flash('msg', 'Username tidak ditemukan');
    //             return redirect()->route('login.login');
    //         }
    //     }



    public function loginProcess(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        // Coba cari di tabel pelanggan terlebih dahulu
        $user = AuthModel::where('usernameCust', $username)->first();

        if ($user && Hash::check($password, $user->passwordCust)) {
            // Jika berhasil, login sebagai pelanggan
            Auth::guard('pelanggan')->login($user);
            session()->flash('logout_message', 'Berhasil login sebagai pelanggan.');
            return redirect()->route('home');
        } else {
            $user = karyawanModel::where('usernameKywn', $username)->first();

            if ($user && $user->passwordKywn === $password) {
                Auth::guard('karyawan')->login($user);
                session()->put([
                    'idKywn' => $user->idKywn,
                    'usernameKywn' => $user->usernameKywn,
                ]);
                session()->flash('logout_message', 'Berhasil login sebagai karyawan.');
                return redirect()->route('homeKywn');
            }
        }

        session()->flash('msg', 'Username atau password tidak sesuai');
        return redirect()->route('login.login');
    }


    public function register()
    {
        return view('login.register');
    }

    public function registerProcess(Request $request)
    {
        // Validasi input
        $request->validate([
            'namaCust' => 'required',
            'usernameCust' => 'required|unique:pelanggan,usernameCust',
            'emailCust' => 'required|email|unique:pelanggan,emailCust',
            'passwordCust' => 'required|min:6',
            'alamatCust' => 'required',
        ]);

        // Proses pendaftaran
        $pelanggan = new AuthModel();
        $pelanggan->namaCust = $request->input('namaCust');
        $pelanggan->usernameCust = $request->input('usernameCust');
        $pelanggan->emailCust = $request->input('emailCust');
        $pelanggan->passwordCust = Hash::make($request->input('passwordCust'));
        $pelanggan->alamatCust = $request->input('alamatCust');

        $pelanggan->save();

        Auth::guard('pelanggan')->login($pelanggan);
        // session()->flash('msg', 'Registrasi berhasil. Silakan login.');
        // return redirect()->route('login.login');
        return redirect()->route('home')->with('msg', 'Registrasi berhasil! Anda telah login.');

    }


    public function forgotPassword()
    {
        return view('lupa_password'); // Nama view menjadi 'lupa_password'
    }


    // ini session
    // public function logout()
    // {
    //     Auth::logout();
    //     session()->flush();
    //     session()->flash('logout_message', 'Anda telah berhasil logout.');
    //     return redirect()->route('login');
    // }


    public function logout()
    {
        if (Auth::guard('pelanggan')->check()) {
            Auth::guard('pelanggan')->logout();
        } elseif (Auth::guard('karyawan')->check()) {
            Auth::guard('karyawan')->logout();
        }

        session()->flush();
        session()->flash('logout_message', 'Anda telah berhasil logout.');
        return redirect()->route('login.login');
    }
}
