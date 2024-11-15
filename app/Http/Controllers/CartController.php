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

        // Ambil data keranjang dari tabel `keranjangs` berdasarkan ID pengguna yang sedang login
        $cartItems = cartModel::where('idCust', $userId)->with('tanaman')->get();

        // Kirimkan data ke view 'cart'
        return view('cart', ['cartItems' => $cartItems]);
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
            $keranjang->total_harga = $keranjang->jumlah * $product->hargaTanaman;
            $keranjang->save();
        } else {
            // Jika produk belum ada di keranjang, buat entri baru
            cartModel::create([
                'idCust' => auth('pelanggan')->id(),
                'idTanaman' => $productId,
                'namaTanaman' => $product->namaTanaman,
                'jumlah' => $request->jumlah,
                'harga_satuan' => $product->hargaTanaman,
                'total_harga' => $request->jumlah * $product->hargaTanaman,
            ]);
        }

        return response()->json(['message' => 'Produk berhasil ditambahkan ke keranjang!']);
    }
    // Menambahkan produk ke keranjang
    // public function addToCart($id, Request $request)
    // {
    //     // Pastikan pengguna sudah login
    //     if (!auth('pelanggans')->check()) {
    //         return response()->json(['success' => false, 'message' => 'Harap login terlebih dahulu']);
    //     }

    //     // Mengambil ID pengguna yang sedang login
    //     $userId = auth('pelanggans')->id(); // Gunakan guard 'pelanggans' untuk mendapatkan ID pengguna

    //     // Ambil produk dari database menggunakan ID
    //     $product = Tanaman::find($id);

    //     if (!$product) {
    //         return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan.']);
    //     }

    //     // Cek apakah produk sudah ada di keranjang
    //     $existingCartItem = Cart::where('idCust', $userId)->where('idTanaman', $id)->first();

    //     if ($existingCartItem) {
    //         // Jika produk sudah ada, tambahkan quantity
    //         $existingCartItem->jumlah += 1;
    //         $existingCartItem->total_harga = $existingCartItem->jumlah * $existingCartItem->harga_satuan;
    //         $existingCartItem->save();
    //     } else {
    //         // Jika produk belum ada, tambahkan produk baru ke keranjang
    //         Cart::create([
    //             'idCust' => $userId,
    //             'idTanaman' => $id,
    //             'namaTanaman' => $product->namaTanaman,
    //             'jumlah' => 1,
    //             'harga_satuan' => $product->hargaTanaman,
    //             'total_harga' => $product->hargaTanaman,
    //         ]);
    //     }

    //     return response()->json(['success' => true, 'message' => 'Produk berhasil ditambahkan ke keranjang!']);
    // }


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
    public function update(Request $request)
    {
        $request->validate([
            'idTanaman' => 'required|exists:keranjangs,idTanaman',
            'quantity' => 'required|integer|min:1',
        ]);

        // Temukan item keranjang berdasarkan idTanaman dan idCust
        $cartItem = cartModel::where('idTanaman', $request->idTanaman)
            ->where('idCust', auth('pelanggan')->id()) // Asumsi Anda menyimpan idCust di session
            ->first();

        // Update jumlah dan total harga
        if ($cartItem) {
            $cartItem->jumlah = $request->quantity;
            $cartItem->total_harga = $cartItem->harga_satuan * $request->quantity;
            $cartItem->save();
        }

        return response()->json(['success' => true]);
    }
}
