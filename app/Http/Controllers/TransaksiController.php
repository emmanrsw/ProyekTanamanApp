<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\cartModel;
use App\Models\transaksiModel;
use App\Models\detailTModel;
use App\Models\tanamanModel;
use Illuminate\Support\Facades\Log; // Tambahkan ini

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TransaksiController extends Controller
{

    public function prosesTransaksi(Request $request)
    {
        // Validasi input
        $request->validate([
            'selectedItems' => 'required', // Pastikan ada data yang dikirim
        ]);

        // Ambil ID tanaman yang dipilih dari hidden input
        $selectedItems = $request->input('selectedItems');

        // Jika data berupa string dengan tanda kurung, ubah menjadi array
        if (is_string($selectedItems)) {
            $selectedItems = json_decode($selectedItems, true); // Mengubah string menjadi array
        }

        // Ambil ID pelanggan yang sedang login
        $idCust = Auth::id();
        $user = Auth::user(); // Ambil data pengguna yang sedang login

        // Ambil alamat pengguna dari profil
        $alamatPelanggan = $user->alamatCust;

        // Ambil data tanaman yang dipilih dari keranjang
        $tanamanDipilih = cartModel::where('idCust', $idCust)
            ->whereIn('idTanaman', $selectedItems)
            ->get();

        // Periksa apakah ada tanaman yang dipilih
        if ($tanamanDipilih->isEmpty()) {
            return redirect()->back()->with('error', 'Tanaman yang dipilih tidak ditemukan.');
        }

        // Cek stok untuk setiap tanaman
        foreach ($tanamanDipilih as $item) {
            $tanaman = tanamanModel::find($item->idTanaman); // Ambil data tanaman dari tabel Tanaman
            if (!$tanaman || $tanaman->jmlTanaman < $item->jumlah) {
                return redirect()->back()->with('error', 'Mohon maaf, stok untuk ' . $tanaman->namaTanaman . ' saat ini terbatas. Stok : ' . $tanaman->jmlTanaman);
            }
        }

        // Hitung subtotal dan total
        $sub_total = $tanamanDipilih->sum(function ($item) {
            return $item->harga_satuan * $item->jumlah;
        });

        // Hitung pajak 5%
        $tax = $sub_total * 0.05;
        $total = $sub_total + $tax;


        // Kirim data ke view transaksi
        return view('transaksi', [
            'tanamanDipilih' => $tanamanDipilih,
            'subtotal' => $sub_total,
            'tax' => $tax,
            'total' => $total,
            'alamatPelanggan' => $alamatPelanggan,
        ]);
    }


    public function simpanTransaksi(Request $request)
    {
        Log::info('Metode: ' . $request->method());

        $request->validate([
            'harga_total' => 'required|numeric',
            'pajak' => 'required|numeric',
            'alamat_kirim' => 'required|string',
            'metode_bayar' => 'required|string',
            'tanaman' => 'required|array',
            'tanaman.*.idTanaman' => 'required|integer',
            'tanaman.*.harga_satuan' => 'required|numeric',
            'tanaman.*.jumlah' => 'required|integer|min:1',
        ]);


        // Simpan data transaksi ke tabel Transaksi
        $transaksi = new transaksiModel();
        $transaksi->idCust = Auth::id(); // ID pelanggan yang sedang login
        $transaksi->harga_total = $request->harga_total;
        $transaksi->pajak = $request->pajak;
        $transaksi->alamat_kirim = $request->alamat_kirim;
        // Menggunakan timezone Asia/Jakarta
        $transaksi->tglTJual = Carbon::now('Asia/Jakarta')->toDateString(); // Tanggal transaksi
        $transaksi->waktuTJual = Carbon::now('Asia/Jakarta')->toTimeString(); // Waktu transaksi
        $transaksi->metodeByr = $request->metode_bayar;
        $transaksi->statusTJual = 'sedang dikemas'; // Default status
        $transaksi->save();

        // Proses setiap tanaman yang dibeli
        foreach ($request->tanaman as $item) {
            // Simpan detail transaksi
            $detail = new detailTModel();
            $detail->idTJual = $transaksi->idTJual; // ID transaksi yang baru dibuat
            $detail->idTanaman = $item['idTanaman'];
            $detail->harga_satuan = $item['harga_satuan'];
            $detail->jumlah = $item['jumlah'];
            $detail->save();

            // Mengurangi stok tanaman
            $tanaman = tanamanModel::find($item['idTanaman']); // Cari tanaman berdasarkan ID
            if ($tanaman) {
                // Cek apakah stok cukup
                if ($tanaman->jmlTanaman >= $item['jumlah']) {
                    // Kurangi stok tanaman
                    $tanaman->jmlTanaman -= $item['jumlah'];
                    $tanaman->save();

                    // Tambahkan log perubahan stok
                    DB::table('stok_log')->insert([
                        'idTanaman' => $tanaman->idTanaman,
                        'tanggal' => Carbon::now(),
                        'jumlah_sebelumnya' => $tanaman->jmlTanaman + $item['jumlah'], // Sebelum stok berkurang
                        'jumlah_terjual' => $item['jumlah'], // Jumlah yang terjual
                        'jumlah_baru' => $tanaman->jmlTanaman, // Jumlah stok setelah berkurang
                    ]);
                } else {
                    // Jika stok tidak cukup
                    Log::error("Stok tanaman dengan ID {$item['idTanaman']} tidak cukup.");
                    return redirect()->back()->with('error', 'Stok tidak cukup.');
                }
            } else {
                // Jika tanaman tidak ditemukan
                Log::error("Tanaman dengan ID {$item['idTanaman']} tidak ditemukan.");
                return redirect()->back()->with('error', 'Tanaman tidak ditemukan.');
            }

            // Hapus item dari keranjang
            $tanamancart = cartModel::where('idTanaman', $item['idTanaman'])->where('idCust', Auth::id())->first();
            if ($tanamancart) {
                $tanamancart->delete(); // Hapus item dari keranjang
            } else {
                // Jika item keranjang tidak ditemukan
                Log::error("Item keranjang dengan ID Tanaman {$item['idTanaman']} dan ID Cust " . Auth::id() . " tidak ditemukan.");
            }
        }

        // Hapus tanaman yang sudah dipilih dari keranjang setelah transaksi selesai
        cartModel::where('idCust', Auth::id())
            ->whereIn('idTanaman', collect($request->tanaman)->pluck('idTanaman'))
            ->delete();

        // Redirect ke halaman sukses setelah transaksi berhasil
        return redirect()->route('pesanan')->with('success', 'Transaksi berhasil disimpan!');
    }




    public function show()
    {

        // Ambil data pesanan berdasarkan pengguna yang sedang login
        $pesanan = Auth::user()->idTJual; // Asumsi hubungan antara user dan pesanan sudah ada

        // Kirim data pesanan dan pengguna ke view
        return view('pesanan', compact('pesanan'));
    }
    
    public function show_order()
    {
        $orders = transaksiModel::with(['details', 'pelanggan'])->get();
        return view('orderlist', compact('orders'));
    }


    public function updateStatus(Request $request, $idTJual)
    {
        // Validasi input
        $request->validate([
            'statusTJual' => 'required|in:Sedang Dikemas,Dikirim,Selesai',
        ]);

        // Cari transaksi berdasarkan ID
        $transaksi = transaksiModel::findOrFail($idTJual);

        // Update status
        $transaksi->statusTJual = $request->statusTJual;
        $transaksi->save();

        // Redirect kembali ke halaman daftar transaksi dengan pesan sukses
        return redirect()->back()->with('success', 'Status transaksi berhasil diperbarui.');
    }



    // --------------------------------------------------------
    public function showPesanan()
    {
        $userId = Auth::guard('pelanggan')->id(); // Dapatkan ID pengguna yang sedang login

        // Cek transaksi berdasarkan status
        $sedangDikemas = transaksiModel::where('idCust', $userId)->where('statusTJual', 'sedang dikemas')
            ->with('details')  // Memuat relasi detail transaksi
            ->get();
        $dikirim = transaksiModel::where('idCust', $userId)->whereRaw('LOWER(statusTJual) = ?', ['dikirim'])
            ->with('details')  // Memuat relasi detail transaksi
            ->get();
        $selesai = transaksiModel::where('idCust', $userId)->where('statusTJual', 'selesai')
            ->with('details')  // Memuat relasi detail transaksi
            ->get();
        //  dd($sedangDikemas);

        // Cek apakah ada transaksi sama sekali
        $noTransaksi = $sedangDikemas->isEmpty() && $dikirim->isEmpty() && $selesai->isEmpty();

        // Kirim data ke view
        return view('pesanan', compact('sedangDikemas', 'dikirim', 'selesai', 'noTransaksi'));
    }
}
