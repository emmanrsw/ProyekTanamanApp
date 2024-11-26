<?php

namespace App\Http\Controllers;

use App\Models\cartModel;
use App\Models\transaksiModel;
use Illuminate\Http\Request;
use App\Models\transkasiModel;
use App\Models\detailTModel;
use App\Models\tanamanModel;
use Illuminate\Support\Facades\Auth;
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
    
        // Query data tanaman berdasarkan ID yang dipilih
        $tanamanDipilih = cartModel::whereIn('idTanaman', $selectedItems)->get();
    
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

    
    



    // public function showTran()
    // {
    //     return view('transaksi');
    // }

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
















    // Menampilkan data transaksi
    // public function showTrans()
    // {
    //     // Ambil semua data tanaman dari database
    //     $products = tanamanModel::all(); // Ambil semua data tanaman dari database

    //     // Hitung subtotal (total harga dari semua produk yang dibeli)
    //     $subtotal = $products->sum(function ($product) {
    //         return $product->hargaTanaman * $product->jmlTanaman;
    //     });

    //     // Kirim data produk dan subtotal ke view
    //     return view('transaksi', compact('products', 'subtotal'));
    // }















    // public function bayar(Request $request)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'idCust' => 'required',
    //         'idKywn' => 'required',
    //         'metodeByr' => 'required',
    //         'statusTJual' => 'nullable', // Default "Pending" jika tidak diisi
    //     ]);

    //     // Jika tglTJual dan waktuTJual tidak diisi, maka set dengan waktu saat ini
    //     $tglTJual = $request->tglTJual ?? now()->toDateString(); // Default ke tanggal saat ini jika kosong
    //     $waktuTJual = $request->waktuTJual ?? now()->toTimeString(); // Default ke waktu saat ini jika kosong

    //     // Buat transaksi utama ke model `transaksiJual`
    //     $transaksiJual = transaksiModel::create([
    //         'idCust' => $request->idCust,
    //         'idKywn' => $request->idKywn,
    //         'tglTJual' => $tglTJual,
    //         'waktuTJual' => $waktuTJual,
    //         'metodeByr' => $request->metodeByr,
    //         'statusTJual' => $request->statusTJual ?? 'Pending', // Default status jika tidak diisi
    //     ]);

    //     // Ambil ID transaksi yang baru dibuat
    //     $idTJual = $transaksiJual->idTJual;

    //     // Ambil produk yang dipilih dari form
    //     $selectedProducts = $request->input('products');

    //     // Proses detail transaksi untuk setiap produk yang dipilih
    //     $products = collect($selectedProducts)->map(function ($product) use ($idTJual) {
    //         list($name, $price, $quantity) = explode('|', $product);

    //         // Cari ID tanaman berdasarkan nama
    //         $tanaman = tanamanModel::where('namaTanaman', $name)->first();
    //         if (!$tanaman) {
    //             throw new \Exception("Tanaman dengan nama '{$name}' tidak ditemukan.");
    //         }

    //         // Simpan detail transaksi ke tabel detailTModel
    //         $detail = detailTModel::create([
    //             'idTJual' => $idTJual,
    //             'idTanaman' => $tanaman->idTanaman,
    //             'jmlTJual' => $quantity,
    //             'hargaTjual' => $price,
    //         ]);

    //         // Kembalikan data detail transaksi
    //         return [
    //             'namaTanaman' => $name,
    //             'hargaTjual' => $price,
    //             'jmlTJual' => $quantity,
    //         ];
    //     });

    //     // Hitung subtotal
    //     $subtotal = $products->sum(function ($product) {
    //         return $product['hargaTjual'] * $product['jmlTJual'];
    //     });

    //     // Kirim data ke view
    //     return view('transaksi', [
    //         'products' => $products,
    //         'subtotal' => $subtotal,
    //     ]);
    // }
// }
