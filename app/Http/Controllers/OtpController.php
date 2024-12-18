<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
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

        // Cek apakah nomor telepon sudah diisi
        if (!$user->notlpCust) {
            return redirect()->route('pelanggan.profile')->with('error', 'Silakan isi nomor telepon terlebih dahulu.');
        }

        return view('otp'); // View untuk form kirim OTP
    }

    // Mengirim OTP ke nomor telepon yang terdaftar
    public function sendOtp(Request $request)
    {
        $idCust = Auth::id();

        // Ambil data pelanggan berdasarkan id
        $pelanggan = DB::table('pelanggan')->where('idCust', $idCust)->first();
        if (!$pelanggan || !$pelanggan->notlpCust) {
            return back()->with('error', 'Nomor telepon tidak ditemukan.');
        }

        // Format nomor telepon agar sesuai dengan standar internasional (+62)
        $nomor = $this->formatNomorTelepon($pelanggan->notlpCust);

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
        $nomor = preg_replace('/\D/', '', $nomor); // Hapus karakter selain angka
        if (substr($nomor, 0, 1) === '0') {
            return '+62' . substr($nomor, 1); // Jika dimulai dengan 0, ganti menjadi +62
        }
        if (substr($nomor, 0, 3) !== '+62') {
            return '+62' . $nomor; // Jika tidak ada +62, tambahkan +62
        }
        return $nomor; // Kembalikan nomor jika sudah sesuai format
    }

    protected function sendOtpToWhatsapp($nomor, $otp)
    {
        // Menyiapkan data untuk dikirim ke API WhatsApp
        $data = [
            'target' => $nomor,
            'message' => "Your OTP: " . $otp
        ];

        // Inisialisasi cURL untuk mengirim permintaan ke API
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "Authorization: WZnBcwQ94dJrZA9ZzcLu" // API key untuk Fonnte atau API yang digunakan
        ]);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL, "https://api.fonnte.com/send"); // URL API WhatsApp
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);

        // Debug jika terjadi kesalahan
        if (curl_errno($curl)) {
            Log::error('Curl error: ' . curl_error($curl)); // Log error jika terjadi masalah
            return false; // Jika ada error cURL, return false
        } else {
            Log::info('Response from WhatsApp API: ' . $result);
            $decodedResponse = json_decode($result, true);
            Log::info('Decoded Response: ' . print_r($decodedResponse, true)); // Log respons yang sudah di-decode
        }

        curl_close($curl);
        return true; // Jika berhasil, return true
    }


    // Verifikasi OTP yang dimasukkan oleh pengguna
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
                return back()->with('status', 'OTP valid, Anda berhasil login.');
            } else {
                return back()->with('error', 'OTP kedaluwarsa.');
            }
        } else {
            return back()->with('error', 'OTP salah.');
        }
    }
}
