<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tanamanModel;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Function untuk menampilkan halaman keranjang
    public function viewCart()
    {
        // Mengambil data keranjang dari session
        $cart = session()->get('cart', []);

        // Kirimkan data ke view 'cart'
        return view('cart', ['cart' => $cart]);
    }

    // Function untuk menambahkan produk ke keranjang
    // public function addToCart(Request $request, $productId)
    // {
    //     $tanaman = Tanaman::find($productId);

    //     if ($tanaman) {
    //         $cart = Session::get('cart', []);
    //         $cart[$productId] = [
    //             "namaTanaman" => $tanaman->namaTanaman,
    //             "hargaTanaman" => $tanaman->hargaTanaman,
    //             "quantity" => ($cart[$productId]['quantity'] ?? 0) + 1
    //         ];
    //         Session::put('cart', $cart);
    //         return response()->json(['message' => 'Produk berhasil ditambahkan ke keranjang!'], 200);
    //     }

    //     return response()->json(['message' => 'Produk tidak ditemukan.'], 404);
    // }
    public function addToCart($id, Request $request)
    {
        // Ambil produk dari database menggunakan ID
        $product = tanamanModel::find($id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan.']);
        }

        // Ambil keranjang dari session
        $cart = Session::get('cart', []);
        // dd($cart);
        // Tambahkan produk ke keranjang
        $cart[$id] = [
            "namaTanaman" => $product->namaTanaman,
            "hargaTanaman" => $product->hargaTanaman,
            "gambar" => $product->gambar,
            "quantity" => ($cart[$id]['quantity'] ?? 0) + 1
        ];

        // Simpan kembali keranjang ke session
        Session::put('cart', $cart);

        return response()->json(['success' => true, 'message' => 'Produk berhasil ditambahkan ke keranjang!']);
    }


    public function removeFromCart($id)
    {
        // Ambil keranjang dari session
        $cart = session()->get('cart', []);

        // Hapus item dari keranjang
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        // Redirect kembali dengan pesan sukses
        return redirect()->route('cart')->with('success', 'Produk berhasil dihapus dari keranjang!');
    }
}
