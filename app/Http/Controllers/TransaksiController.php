<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\cartModel;
use App\Models\transaksiModel;
use App\Models\detailTModel;
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
            // Menghapus tanda kurung dengan json_decode
            $selectedItems = json_decode($selectedItems, true); // Mengubah string menjadi array
        }

        // Debugging: Tampilkan selectedItems yang diterima
        // dd($selectedItems); // Akan menampilkan array ID tanaman yang benar

        $idCust = Auth::id(); // Ambil ID pengguna yang sedang login

        $tanamanDipilih = cartModel::where('idCust', $idCust)
            ->whereIn('idTanaman', $selectedItems)
            ->get();


        // dd($tanamanDipilih->toArray());

        // Periksa apakah ada tanaman yang dipilih
        if ($tanamanDipilih->isEmpty()) {
            return redirect()->back()->with('error', 'Tanaman yang dipilih tidak ditemukan.');
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


    // public function simpanTransaksi(Request $request)
    // {
    //     // Validasi data
    //     $request->validate([
    //         'subtotal' => 'required|numeric',
    //         'pajak' => 'required|numeric',
    //         'total_harga' => 'required|numeric',
    //         'alamat_kirim' => 'required|string',
    //         'metode_bayar' => 'required|string',
    //     ]);

    //     // Simpan data transaksi ke tabel transaksi
    //     $transaksi = new Transaksi();
    //     $transaksi->idCust = Auth::id(); // ID pelanggan yang sedang login
    //     // $transaksi->idKywn = null; // Kosongkan jika tidak ada karyawan terkait
    //     $transaksi->subtotal = $request->subtotal;
    //     $transaksi->pajak = $request->pajak;
    //     $transaksi->total_harga = $request->total_harga;
    //     $transaksi->alamat_kirim = $request->alamat_kirim;
    //     $transaksi->tglTJual = Carbon::now()->toDateString(); // Tanggal transaksi
    //     $transaksi->waktuTJual = Carbon::now()->toTimeString(); // Waktu transaksi
    //     $transaksi->metodeByr = $request->metode_bayar;
    //     $transaksi->statusTJual = 'Pending'; // Default status
    //     $transaksi->save();

    //     // // Pastikan ID transaksi sudah terisi
    //     if (!$transaksi->id) {
    //         return redirect()->back()->with('error', 'Gagal menyimpan transaksi.');
    //     }

    //     // Simpan data detail transaksi
    //     foreach ($request->tanaman as $item) {
    //         $detail = new DetailT();
    //         $detail->idTJual = $transaksi->id; // Ambil ID transaksi yang baru dibuat
    //         $detail->idTanaman = $item['idTanaman'];
    //         $detail->jumlah = $item['jumlah'];
    //         $detail->harga_satuan = $item['harga_satuan'];
    //         $detail->total_harga = $item['subtotal'];
    //         $detail->save();
    //     }

    //     // Redirect ke halaman sukses
    //     return redirect()->route('pesanan')->with('success', 'Transaksi berhasil disimpan!');
    // }



    // public function show()
    // {
    //     // Ambil data pesanan atau transaksi yang relevan
    //     $pesanan = Transaksi::where('idCust', Auth::id())->get();  // Ambil pesanan berdasarkan idCust

    //     // Kirim data ke view pesanan
    //     return view('pesanan', compact('pesanan'));

    // }

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
        $transaksi->statusTJual = 'Pending'; // Default status
        $transaksi->save();
        
        foreach ($request->tanaman as $item) {
        
            $detail = new detailTModel();
            $detail->idTJual = $transaksi->idTJual; // ID transaksi yang baru dibuat
            $detail->idTanaman = $item['idTanaman'];
            $detail->jumlah = $item['jumlah'];
            $detail->harga_satuan = $item['harga_satuan'];
            $detail->total_harga = $item['subtotal'];
            $detail->nama_tanaman = $item['namaTanaman'];  // Periksa key ini
            $detail->save();
        }
        
        // Redirect ke halaman sukses setelah transaksi berhasil
        return redirect()->route('pesanan')->with('success', 'Transaksi berhasil disimpan!');
    }

    public function show()
    {
        // Ambil data pesanan yang relevan untuk pelanggan yang sedang login
        $pesanan = transaksiModel::where('idCust', Auth::id())->get();

        // Kirim data pesanan ke view
        return view('pesanan', compact('pesanan'));
    }













    // public function showTran(Request $request)
    // // public function showTran()
    // {
    //     //     return view('transaksi');
    //     // }
    //     // Pastikan user login
    //     $idCust = Auth::id(); // Dapatkan ID pengguna login

    //     // Ambil data keranjang berdasarkan pengguna
    //     $cartItems = cartModel::where('idCust', $idCust)->get();

    //     // Hitung subtotal, pajak, dan total
    //     $subtotal = $cartItems->sum('total_harga');
    //     $tax = $subtotal * 0.05;
    //     $total = $subtotal + $tax;

    //     // Simpan transaksi ke dalam tabel transaksi
    //     $transaksi = \DB::transaction(function () use ($idCust, $cartItems, $subtotal, $tax, $total) {
    //         // Simpan data transaksi
    //         $transaksi = new \App\Models\TransaksiModel();
    //         $transaksi->idCust = $idCust;
    //         $transaksi->subtotal = $subtotal;
    //         $transaksi->tax = $tax;
    //         $transaksi->total = $total;
    //         $transaksi->save();

    //         // Simpan detail transaksi
    //         foreach ($cartItems as $item) {
    //             $transaksi->details()->create([
    //                 'idTanaman' => $item->idTanaman,
    //                 'jumlah' => $item->jumlah,
    //                 'harga_satuan' => $item->harga_satuan,
    //                 'total_harga' => $item->total_harga,
    //             ]);
    //         }

    //         // Kosongkan keranjang setelah transaksi
    //         cartModel::where('idCust', $idCust)->delete();

    //         return $transaksi;
    //     });

    //     // Arahkan ke halaman konfirmasi
    //     return redirect()->route('konfirmasi.pembayaran', ['id' => $transaksi->id])
    //         ->with('success', 'Pembayaran berhasil diproses.');


    // return view('transaksi', compact('cartItems', 'subtotal', 'tax', 'total'));

}
