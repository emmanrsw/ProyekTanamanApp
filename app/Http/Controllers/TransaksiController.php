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
    // public function prosesTransaksi(Request $request)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'selectedItems' => 'required', // Pastikan ada data yang dikirim
    //     ]);

    //     // Ambil ID tanaman yang dipilih dari hidden input
    //     $selectedItems = $request->input('selectedItems');

    //     // Jika data berupa string dengan tanda kurung, ubah menjadi array
    //     if (is_string($selectedItems)) {
    //         // Menghapus tanda kurung dengan json_decode
    //         $selectedItems = json_decode($selectedItems, true); // Mengubah string menjadi array
    //     }

    //     // Debugging: Tampilkan selectedItems yang diterima
    //     // dd($selectedItems); // Akan menampilkan array ID tanaman yang benar

    //     $idCust = Auth::id(); // Ambil ID pengguna yang sedang login

    //     $tanamanDipilih = cartModel::where('idCust', $idCust)
    //         ->whereIn('idTanaman', $selectedItems)
    //         ->get();


    //     // dd($tanamanDipilih->toArray());

    //     // Periksa apakah ada tanaman yang dipilih
    //     if ($tanamanDipilih->isEmpty()) {
    //         return redirect()->back()->with('error', 'Tanaman yang dipilih tidak ditemukan.');
    //     }

    //     // Hitung subtotal dan total
    //     $subtotal = $tanamanDipilih->sum(function ($item) {
    //         return $item->harga_satuan * $item->jumlah;
    //     });

    //     // Hitung pajak 5%
    //     $tax = $subtotal * 0.05;
    //     $total = $subtotal + $tax;

    //     // Kirim data ke view transaksi
    //     return view('transaksi', [
    //         'tanamanDipilih' => $tanamanDipilih,
    //         'subtotal' => $subtotal,
    //         'tax' => $tax,
    //         'total' => $total,
    //     ]);
    // }


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
        $subtotal = $tanamanDipilih->sum(function ($item) {
            return $item->harga_satuan * $item->jumlah;
        });

        // Hitung pajak 5%
        $tax = $subtotal * 0.05;
        $total = $subtotal + $tax;


        // Kirim data ke view transaksi
        return view('transaksi', [
            'tanamanDipilih' => $tanamanDipilih,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
        ]);
    }


    public function simpanTransaksi(Request $request)
    {
        // dd($request->all);  // Menampilkan data tanaman yang dikirimkan

        // Validasi data transaksi
        $request->validate([
            'subtotal' => 'required|numeric',
            'pajak' => 'required|numeric',
            'total_harga' => 'required|numeric',
            'alamat_kirim' => 'required|string',
            'metode_bayar' => 'required|string',
        ]);

        // Simpan data transaksi ke tabel Transaksi
        $transaksi = new transaksiModel();
        $transaksi->idCust = Auth::id(); // ID pelanggan yang sedang login
        $transaksi->subtotal = $request->subtotal;
        $transaksi->pajak = $request->pajak;
        $transaksi->total_harga = $request->total_harga;
        $transaksi->alamat_kirim = $request->alamat_kirim;
        $transaksi->tglTJual = Carbon::now()->toDateString(); // Tanggal transaksi
        $transaksi->waktuTJual = Carbon::now()->toTimeString(); // Waktu transaksi
        $transaksi->metodeByr = $request->metode_bayar;
        $transaksi->statusTJual = 'sedang dikemas'; // Default status
        $transaksi->save();
        // dd($transaksi);

        foreach ($request->tanaman as $item) {

            $detail = new detailTModel();
            $detail->idTJual = $transaksi->idTJual; // ID transaksi yang baru dibuat
            $detail->idTanaman = $item['idTanaman'];
            $detail->jumlah = $item['jumlah'];
            $detail->harga_satuan = $item['harga_satuan'];
            $detail->total_harga = $item['subtotal'];
            $detail->nama_tanaman = $item['namaTanaman'];  // Periksa key ini
            $detail->save();
            // dd($detail);
        }

        // Mengurangi stok tanaman
        $tanaman = tanamanModel::find($item['idTanaman']); // Cari tanaman berdasarkan ID
        if ($tanaman) {
            $tanaman->jmlTanaman -= $item['jumlah']; // Kurangi stok tanaman
            $tanaman->save();
        } else {
            // Jika tanaman tidak ditemukan
            Log::error("Tanaman dengan ID {$item['idTanaman']} tidak ditemukan.");
        }

        // Hapus item dari keranjang
        $tanamancart = cartModel::where('idTanaman', $item['idTanaman'])->where('idCust', Auth::id())->first();
        if ($tanamancart) {
            $tanamancart->delete(); // Hapus item dari keranjang
        } else {
            // Jika item keranjang tidak ditemukan
            Log::error("Item keranjang dengan ID Tanaman {$item['idTanaman']} dan ID Cust " . Auth::id() . " tidak ditemukan.");
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
        // Ambil data pesanan dengan status 'sedang dikemas' untuk pelanggan yang sedang login
        $pesanan = transaksiModel::where('idCust', Auth::id())
            ->where('statusTjual', 'sedang dikemas')
            ->get();

        // Kirim data pesanan ke view
        return view('pesanan', compact('pesanan'));
    }

    // origin
    // public function show()
    // {
    //     // Ambil data pesanan yang relevan untuk pelanggan yang sedang login
    //     $pesanan = transaksiModel::where('idCust', Auth::id())->get();

    //     // Kirim data pesanan ke view
    //     return view('pesanan', compact('pesanan'));
    // }




    // == karyawan 
    public function show_order()
    {
        $orders = transaksiModel::with('details')->get();
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
}
