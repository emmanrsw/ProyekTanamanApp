<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\Models\OTP;

class OtpController extends Controller
{
    // Menampilkan halaman form untuk verifikasi OTP
    public function showOtpForm()
    {
        return view('verOtp'); // View untuk halaman verifikasi OTP
    }



    // Menampilkan form untuk kirim OTP
    public function showOtpSendForm()
    {
        $user = Auth::user();

        // // Cek apakah nomor telepon sudah diisi
        // if (!$user->notlpCust) {
        //     return redirect()->route('pelanggan.profile')->with('error', 'Silakan isi nomor telepon terlebih dahulu.');
        // }

        return view('otp'); // View untuk form kirim OTP
    }

    // Mengirim OTP ke nomor telepon yang terdaftar
    public function sendOtp(Request $request)
    {
        $idCust = Auth::id();
        $nomorInput = $request->input('nomor');

        // Ambil data pelanggan berdasarkan id
        $pelanggan = DB::table('pelanggan')->where('idCust', $idCust)->first();
        // if (!$pelanggan || !$pelanggan->notlpCust) {
        //     return back()->with('error', 'Nomor telepon tidak ditemukan.');
        // }
        $nomor = $pelanggan ? $pelanggan->notlpCust : null;
        // Jika nomor telepon tidak ada di profil, gunakan nomor dari input
        if (!$nomor) {
            if (!$nomorInput) {
                return back()->with('error', 'Harap masukkan nomor telepon untuk menerima OTP.');
            }
            $nomor = $nomorInput;
        }
        // Format nomor telepon agar sesuai dengan standar internasional (+62)
        // 
        $nomor = $this->formatNomorTelepon($nomor);

        Log::info('Nomor telepon yang akan digunakan: ' . $nomor);

        // Buat OTP secara acak
        $otp = rand(100000, 999999);
        $waktu = Carbon::now();

        // Simpan OTP ke dalam database, jika ada OTP sebelumnya, update
        DB::table('otp')->updateOrInsert(
            ['idCust' => $idCust],
            ['otp' => $otp, 'waktu' => $waktu]
        );

        // Kirim OTP ke WhatsApp
        $status = $this->sendOtpToWhatsapp($nomor, $otp);

        // Berikan respon sesuai dengan status pengiriman OTP
        if ($status) {
            return redirect()->route('otp.verification')->with('status', 'OTP berhasil dikirim.');
        } else {
            return back()->with('error', 'Gagal mengirim OTP. Coba lagi.');
        }
    }

    // Memformat nomor telepon agar sesuai dengan format internasional (+62)
    private function formatNomorTelepon($nomor)
    {
        $nomor = preg_replace('/\D/', '', $nomor); // Hapus karakter non-angka
        if (substr($nomor, 0, 1) === '0') {
            return '+62' . substr($nomor, 1); // Ganti 0 di awal dengan +62
        }
        if (substr($nomor, 0, 2) === '62') {
            return '+' . $nomor; // Tambahkan "+" jika dimulai dengan 62
        }
        if (substr($nomor, 0, 3) !== '+62') {
            return '+62' . $nomor; // Tambahkan +62 jika belum ada
        }
        return $nomor;
    }

    // Mengirim OTP ke WhatsApp menggunakan API eksternal
    protected function sendOtpToWhatsapp($nomor, $otp)
    {
        $data = [
            'target' => $nomor,
            'message' => "Your OTP: " . $otp
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "Authorization: WZnBcwQ94dJrZA9ZzcLu" // API key Anda
        ]);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL, "https://api.fonnte.com/send"); // URL API WhatsApp
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $result = curl_exec($curl);

        if (curl_errno($curl)) {
            Log::error('Curl error: ' . curl_error($curl));
            curl_close($curl);
            return false;
        }

        curl_close($curl);

        // Debug respons API
        $decodedResponse = json_decode($result, true);
        if (!$decodedResponse) {
            Log::error('Failed to decode API response: ' . $result);
            return false;
        }

        if (isset($decodedResponse['status']) && $decodedResponse['status'] == 'success') {
            Log::info('OTP sent successfully to ' . $nomor);
            return true;
        }

        Log::error('Failed to send OTP: ' . $result);
        return false;
    }

    // // Verifikasi OTP yang dimasukkan oleh pengguna
    // public function verifyOtp(Request $request)
    // {
    //     $idCust = Auth::id();
    //     $otpInput = $request->input('otp');

    //     // Ambil OTP yang sudah tersimpan di database
    //     $otpRecord = DB::table('otp')->where('idCust', $idCust)->first();

    //     // Cek apakah OTP ada di database
    //     if (!$otpRecord) {
    //         return back()->with('error', 'OTP tidak ditemukan.');
    //     }

    //     // Validasi apakah OTP yang dimasukkan sama dengan yang ada di database
    //     if ((string) $otpInput === (string) $otpRecord->otp) {
    //         // Cek apakah OTP masih valid (belum lebih dari 5 menit)
    //         if (Carbon::parse($otpRecord->waktu)->diffInMinutes(Carbon::now()) <= 5) {
    //             return back()->with('status', 'OTP valid, Anda berhasil login.');
    //         } else {
    //             return back()->with('error', 'OTP kedaluwarsa.');
    //         }
    //     } else {
    //         return back()->with('error', 'OTP salah.');
    //     }
    // }

    public function verifyOtp(Request $request)
    {
        $idCust = Auth::id();
        $otpInput = $request->input('otp');

        // Ambil OTP yang sudah tersimpan di database
        $otpRecord = DB::table('otp')->where('idCust', $idCust)->first();

        // Cek apakah OTP ada di database
        if (!$otpRecord) {
            return back()->with('error', 'OTP tidak ditemukan.');
        }

        // Validasi apakah OTP yang dimasukkan sama dengan yang ada di database
        if ((string) $otpInput === (string) $otpRecord->otp) {
            // Cek apakah OTP masih valid (belum lebih dari 5 menit)
            if (Carbon::parse($otpRecord->waktu)->diffInMinutes(Carbon::now()) <= 5) {
                // Buat token untuk reset password
                // $token = app('auth.password.broker')->createToken(Auth::user());

                // Arahkan ke halaman reset password dengan token
                return redirect()->route('password.reset')
                    ->with('status', 'OTP valid. Silakan reset password Anda.');
            } else {
                return back()->with('error', 'OTP kedaluwarsa.');
            }
        } else {
            return back()->with('error', 'OTP salah.');
        }
    }
    
}