<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tanamanModel;
use App\Models\pelangganModel;
use App\Models\cartModel;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Function untuk menampilkan halaman keranjang
    public function viewCart()
    {
        // Pastikan pengguna sudah login
        if (!auth('pelanggan')->check()) {
            return redirect()->route('login')->with('error', 'Harap login terlebih dahulu');
        }

        // Mengambil ID pengguna yang sedang login
        $userId = auth('pelanggan')->id(); // Gunakan guard 'pelanggans' untuk mendapatkan ID pengguna

        $cartItems = cartModel::where('idCust', $userId)
            ->with('tanaman') // Memuat relasi tanaman
            ->get();

        // Debugging: Menampilkan data untuk memastikan tanaman dimuat
        // dd($cartItems);

        // Menghitung total harga untuk setiap item di keranjang
        foreach ($cartItems as $item) {
            $item->harga_total = $item->jumlah * $item->harga_satuan;
        }
        // @dd(asset($item->tanaman->namaTanaman));


        // Kirimkan data ke view 'cart'
        return view('cart', ['cartItems' => $cartItems]);
    }

    // Menambahkan produk ke keranjang
    public function addToCart(Request $request, $productId)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);


        $product = tanamanModel::find($productId);

        if (!$product) {
            return response()->json(['message' => 'Produk tidak ditemukan!'], 404);
        }

        // Ambil data keranjang atau buat keranjang baru
        // Mengakses data pengguna dari guard 'pelanggans'
        $keranjang = cartModel::where('idCust', auth('pelanggan')->id())
            ->where('idTanaman', $productId)
            ->first();

        if ($keranjang) {
            // Jika produk sudah ada di keranjang, update jumlahnya
            $keranjang->jumlah += $request->jumlah;
            $keranjang->harga_total = $keranjang->jumlah * $product->hargaTanaman;
            $keranjang->save();
        } else {
            // Jika produk belum ada di keranjang, buat entri baru
            cartModel::create([
                'idCust' => auth('pelanggan')->id(),
                'idTanaman' => $productId,
                'jumlah' => $request->jumlah,
                'harga_satuan' => $product->hargaTanaman,
            ]);
        }
        return response()->json(['message' => 'Produk berhasil ditambahkan ke keranjang!']);
    }

    // Menghapus produk dari keranjang
    public function removeFromCart($id)
    {
        // Pastikan pengguna sudah login
        if (!auth('pelanggan')->check()) {
            return redirect()->route('login')->with('error', 'Harap login terlebih dahulu');
        }

        // Mengambil ID pengguna yang sedang login
        $userId = auth('pelanggan')->id();

        // Hapus item dari keranjang berdasarkan ID pengguna dan ID tanaman
        cartModel::where('idCust', $userId)->where('idTanaman', $id)->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('cart')->with('success', 'Produk berhasil dihapus dari keranjang!');
    }


    public function increase_cart_quantity($rowId)
    {
        // Pastikan pengguna sudah login
        if (!auth('pelanggan')->check()) {
            return redirect()->route('login')->with('error', 'Harap login terlebih dahulu');
        }

        // Temukan item di keranjang berdasarkan rowId
        $cartItem = cartModel::where('idKeranjang', $rowId)
            ->where('idCust', auth('pelanggan')->id())
            ->first();

        if (!$cartItem) {
            return response()->json(['error' => 'Item tidak ditemukan di keranjang.'], 404);
        }

        // Tingkatkan jumlah item
        $cartItem->jumlah += 1;
        $cartItem->save();

        // Update total harga
        $cartItem->harga_total = $cartItem->jumlah * $cartItem->harga_satuan;

        return redirect()->back()->with('success', 'Jumlah tanaman berhasil ditingkatkan.');
    }


    public function decrease_cart_quantity($rowId)
    {
        // Pastikan pengguna sudah login
        if (!auth('pelanggan')->check()) {
            return redirect()->route('login')->with('error', 'Harap login terlebih dahulu');
        }

        // Temukan item di keranjang berdasarkan rowId
        $cartItem = cartModel::where('idKeranjang', $rowId)
            ->where('idCust', auth('pelanggan')->id())
            ->first();


        if (!$cartItem) {
            return response()->json(['error' => 'Item tidak ditemukan di keranjang.'], 404);
        }

        // Kurangi jumlah item (pastikan tidak kurang dari 1)
        $cartItem->jumlah = max(1, $cartItem->jumlah - 1);
        $cartItem->save();

        // Update total harga
        $cartItem->harga_total = $cartItem->jumlah * $cartItem->harga_satuan;

        return redirect()->back()->with('success', 'Jumlah tanaman berhasil dikurangi.');;
    }
}
