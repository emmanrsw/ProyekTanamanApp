<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AuthModel;
use App\Models\karyawanModel;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Session;
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

    public function loginProcess(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        // Coba cari di tabel pelanggan terlebih dahulu
        $user = AuthModel::where('usernameCust', $username)->first();

        // Jika tidak ditemukan di tabel pelanggan, cari di tabel karyawan
        if (!$user) {
            $user = karyawanModel::where('usernameKywn', $username)->first();
        }


        // Proses autentikasi
        if ($user) {
            // Cek password sesuai dengan tabel yang digunakan
            if (($user instanceof AuthModel && Hash::check($password, $user->passwordCust)) ||
                // ($user instanceof karyawanModel && Hash::check($password, $user->passwordKywn))
                ($user instanceof karyawanModel && $user->passwordKywn === $password)

            ) {

                Auth::login($user);

                // Simpan data ke dalam session berdasarkan tipe pengguna
                if ($user instanceof karyawanModel) {
                    session()->put([
                        'idKywn' => $user->idKywn,
                        'usernameKywn' => $user->usernameKywn,
                    ]);
                    return redirect()->route('homeKywn'); // Route untuk karyawan

                } else {
                    session()->put([
                        'idCust' => $user->idCust,
                        'usernameCust' => $user->usernameCust,
                    ]);
                    return redirect()->route('home'); // Route untuk pelanggan
                }
            } else {
                // Jika password salah
                session()->flash('msg', 'Password salah');
                return redirect()->route('login.login');
            }
        } else {
            // Jika user tidak ditemukan
            session()->flash('msg', 'Username tidak ditemukan');
            return redirect()->route('login.login');
        }
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

        session()->flash('msg', 'Registrasi berhasil. Silakan login.');
        return redirect()->route('login.login');
    }


    public function forgotPassword()
    {
        return view('lupa_password'); // Nama view menjadi 'lupa_password'
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        session()->flash('logout_message', 'Anda telah berhasil logout.');
        return redirect()->route('login');
    }
}
