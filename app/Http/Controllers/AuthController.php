<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AuthModel;
use App\Models\karyawanModel;
use App\Models\pelangganModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


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
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:6',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        // Login Pelanggan
        $pelanggan = pelangganModel::where('usernameCust', $username)->first();
        if ($pelanggan && Hash::check($password, $pelanggan->passwordCust)) {
            Auth::guard('pelanggan')->login($pelanggan);
            session()->flash('login_message', 'Selamat datang di Tanam.in!');
            return redirect()->route('home');
        }

        // Login Karyawan
        $karyawan = karyawanModel::where('usernameKywn', $username)->first();
        if ($karyawan && $karyawan->passwordKywn === $password) {
            Auth::guard('karyawan')->login($karyawan);
            session()->flash('login_message', 'Selamat datang di Tanam.in!');
            return redirect()->route('homeKywn');
        }

        // Jika tidak ditemukan
        session()->flash('error_message', 'Username atau password salah.');
        return redirect()->route('login.login');
    }

    public function register()
    {
        return view('login.register');
    }

    public function registerProcess(Request $request)
    {
        // Validasi input
        $cradential = $request->validate([
            'namaCust' => 'required',
            'usernameCust' => 'required|unique:pelanggan,usernameCust',
            'emailCust' => 'required|email|unique:pelanggan,emailCust',
            'alamatCust' => 'required',
            'passwordCust' => 'required|min:6|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[!@#$%^&*._]/',
            'passwordCust_confirmation' => 'required|min:6|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[!@#$%^&*._]/',
        ], [
            'passwordCust.required' => 'Password wajib diisi.',
            'passwordCust.min' => 'Password harus memiliki minimal 6 karakter.',
            'passwordCust.regex' => 'Password harus mengandung setidaknya 1 huruf besar, 1 huruf kecil, 1 angka, dan 1 simbol khusus.',
        ]);

        if (pelangganModel::where('emailCust', $request->emailCust)->exists() || pelangganModel::where('usernameCust', $request->usernameCust)->exists()) {
            return redirect()->route('register')->with('error', 'Email atau Usernam sudah terpakai!');
        } else if ($request->passwordCust == $request->passwordCust_confirmation) {
            // Proses pendaftaran
            $pelanggan = new pelangganModel();
            $pelanggan->namaCust = $request->input('namaCust');
            $pelanggan->usernameCust = $request->input('usernameCust');
            $pelanggan->emailCust = $request->input('emailCust');
            $pelanggan->passwordCust = Hash::make($request->input('passwordCust'));
            $pelanggan->alamatCust = $request->input('alamatCust');

            $pelanggan->save();

            Auth::guard('pelanggan')->login($pelanggan);

            return redirect()->route('login.login')->with('msg', 'Registrasi berhasil! Anda dapat login.');
        } else {
            return redirect()->back()->withErrors($cradential)->withInput();
        }
    }

    public function logout()
    {
        if (Auth::guard('pelanggan')->check()) {
            Auth::guard('pelanggan')->logout();
        } elseif (Auth::guard('karyawan')->check()) {
            Auth::guard('karyawan')->logout();
        }

        session()->flush();
        session()->flash('logout_message', 'Anda telah berhasil logout!');
        return redirect()->route('login.login');
    }

    public function showResetForm()
    {
        return view('lupaPassword');
    }

    public function resetPassword(Request $request)
    {
        // Validasi input dari form
        $validator = Validator::make($request->all(), [
            'username' => 'required|exists:pelanggan,usernameCust', // Validasi username untuk pelanggan
            'password' => 'required|confirmed|min:8', // Validasi password minimal 8 karakter
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Cari pengguna berdasarkan username pelanggan
        $pelanggan = pelangganModel::where('usernameCust', $request->username)->first();
    
        // Pastikan pelanggan ditemukan
        if (!$pelanggan) {
            return redirect()->back()->withErrors(['usernameCust' => 'Username tidak ditemukan.']);
        }
    
        // Reset password
        $pelanggan->passwordCust = Hash::make($request->password); // Hashing password baru
        $pelanggan->save(); // Simpan perubahan
    
        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login.login')->with('success', 'Password berhasil direset. Silakan login dengan password baru.');
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

    // // GAK KEPAKE
    // public function showProfile()
    // {
    //     // dd(session()->all());

    //     // Ambil ID customer dari session
    //     $customerId = Session::get('idCust');

    //     // Jika session kosong, arahkan ke halaman login
    //     if (!$customerId) {
    //         return redirect()->route('login');
    //     }

    //     // Ambil data customer dari database berdasarkan ID
    //     $customer = pelangganModel::find($customerId);

    //     // Jika customer tidak ditemukan, arahkan ke halaman login atau tampilkan error
    //     if (!$customer) {
    //         return redirect()->route('login.login')->with('error', 'Pelanggan tidak ditemukan.');
    //     }

    //     // Kirim data customer ke view
    //     return view('profilPage', ['customer' => $customer]);
    // }


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



    // public function loginProcess(Request $request)
    // {
    //     $request->validate([
    //         'username' => 'required',
    //         'password' => 'required|min:6',
    //     ]);

    //     $username = $request->input('username');
    //     $password = $request->input('password');

    //     // Login Pelanggan
    //     $pelanggan = pelangganModel::where('usernameCust', $username)->first();
    //     if ($pelanggan && Hash::check($password, $pelanggan->passwordCust)) {
    //         Auth::guard('pelanggan')->login($pelanggan);
    //         // session()->flash('login_message', 'Selamat datang di Tanam.in!');
    //         return redirect()->route('home');
    //     }

    //     // Login Karyawan
    //     $karyawan = karyawanModel::where('usernameKywn', $username)->first();
    //     if ($karyawan && $karyawan->passwordKywn === $password) {
    //         Auth::guard('karyawan')->login($karyawan);
    //         // session()->flash('login_message', 'Selamat datang di Tanam.in!');
    //         return redirect()->route('homeKywn');
    //     }

    //     // Jika tidak ditemukan
    //     return redirect()->route('login.login')->with('error_message', 'Username atau password salah.');
    // }

    // public function register()
    // {
    //     return view('login.register');
    // }

    // public function registerProcess(Request $request)
    // {
    //     // Validasi input
    //     $cradential = $request->validate([
    //         'namaCust' => 'required',
    //         'usernameCust' => 'required|unique:pelanggan,usernameCust',
    //         'emailCust' => 'required|email|unique:pelanggan,emailCust',
    //         'alamatCust' => 'required',
    //         'passwordCust' => 'required|min:6|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[!@#$%^&*._]/',
    //         'passwordCust_confirmation' => 'required|min:6|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[!@#$%^&*._]/',
    //     ], [
    //         'passwordCust.required' => 'Password wajib diisi.',
    //         'passwordCust.min' => 'Password harus memiliki minimal 6 karakter.',
    //         'passwordCust.regex' => 'Password harus mengandung setidaknya 1 huruf besar, 1 huruf kecil, 1 angka, dan 1 simbol khusus.',
    //     ]);

    //     if (pelangganModel::where('emailCust', $request->emailCust)->exists() || pelangganModel::where('usernameCust', $request->usernameCust)->exists()) {
    //         // return response()->json(["error" => "Email or telepon already exists"], 400);
    //         return redirect()->route('register')->with('error', 'Email atau Usernam sudah terpakai!');
    //     } else if ($request->passwordCust == $request->passwordCust_confirmation) {
    //         // Proses pendaftaran
    //         $pelanggan = new pelangganModel();
    //         $pelanggan->namaCust = $request->input('namaCust');
    //         $pelanggan->usernameCust = $request->input('usernameCust');
    //         $pelanggan->emailCust = $request->input('emailCust');
    //         $pelanggan->passwordCust = Hash::make($request->input('passwordCust'));
    //         $pelanggan->alamatCust = $request->input('alamatCust');

    //         $pelanggan->save();

    //         Auth::guard('pelanggan')->login($pelanggan);
    //         // session()->flash('msg', 'Registrasi berhasil. Silakan login.');
    //         // return redirect()->route('login.login');
    //         return redirect()->route('login.login')->with('msg', 'Registrasi berhasil! Anda dapat login.');
    //     } else {
    //         return redirect()->back()->withErrors($cradential)->withInput();
    //     }
    // }

    // public function registerProcess(Request $request)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'namaCust' => 'required',
    //         'usernameCust' => 'required|unique:pelanggan,usernameCust',
    //         'emailCust' => 'required|email|unique:pelanggan,emailCust',
    //         'passwordCust' => 'required|min:6',
    //         'alamatCust' => 'required',
    //     ]);

    //     // Proses pendaftaran
    //     $pelanggan = new AuthModel();
    //     $pelanggan->namaCust = $request->input('namaCust');
    //     $pelanggan->usernameCust = $request->input('usernameCust');
    //     $pelanggan->emailCust = $request->input('emailCust');
    //     $pelanggan->passwordCust = Hash::make($request->input('passwordCust'));
    //     $pelanggan->alamatCust = $request->input('alamatCust');

    //     $pelanggan->save();

    //     Auth::guard('pelanggan')->login($pelanggan);
    //     // session()->flash('msg', 'Registrasi berhasil. Silakan login.');
    //     // return redirect()->route('login.login');
    //     return redirect()->route('home')->with('msg', 'Registrasi berhasil! Anda telah login.');

    // }


    // ini session
    // public function logout()
    // {
    //     Auth::logout();
    //     session()->flush();
    //     session()->flash('logout_message', 'Anda telah berhasil logout.');
    //     return redirect()->route('login');
    // }


    // public function logout()
    // {
    //     if (Auth::guard('pelanggan')->check()) {
    //         Auth::guard('pelanggan')->logout();
    //     } elseif (Auth::guard('karyawan')->check()) {
    //         Auth::guard('karyawan')->logout();
    //     }

    //     session()->flush();
    //     session()->flash('logout_message', 'Anda telah berhasil logout!');
    //     return redirect()->route('login.login');
    // }
    // // Menampilkan halaman form lupa username atau password
    // public function showResetForm()
    // {
    //     return view('lupaPassword');
    // }

    // // Memproses form reset username dan/atau password
    // public function reset(Request $request)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'username' => 'nullable|string|min:5|max:255',
    //         'password' => 'nullable|string|min:8|confirmed',
    //     ]);

    //     // Cek jika pengguna sudah login
    //     $user = Auth::guard('pelanggan')->user();

    //     // Jika sudah login, pastikan hanya bisa merubah username/password milik mereka sendiri
    //     if ($user) {
    //         // Jika ada perubahan username
    //         if ($request->filled('username')) {
    //             // Cek apakah username sudah ada di database (kecuali untuk user yang sama)
    //             $existingUser = AuthModel::where('usernameCust', $request->username)
    //                 ->where('idCust', '<>', $user->idCust)
    //                 ->first();

    //             if ($existingUser) {
    //                 return redirect()->back()->withErrors(['username' => 'Username sudah digunakan']);
    //             }

    //             // Update username
    //             $user->usernameCust = $request->username;
    //         }

    //         // Jika ada perubahan password
    //         if ($request->filled('password')) {
    //             // Update password (pastikan password di-hash)
    //             $user->passwordCust = Hash::make($request->password);
    //         }

    //         // Simpan perubahan
    //         $user->save();

    //         return redirect()->route('login.login')->with('success', 'Username atau Password berhasil diubah');
    //     }

    //     // Jika pengguna tidak login, biarkan mereka mengakses halaman reset password
    //     // tanpa harus login
    //     return view('login.login'); // Mengarahkan ke view reset jika pengguna belum login
    // }
}
