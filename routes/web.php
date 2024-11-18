<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('tanamanHPP');
});
Route::get('/tentangKami', function () {
    return view('tentangKami');
});

use App\Http\Controllers\AuthController;
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerProcess']);
Route::get('/login', [AuthController::class, 'login'])->name('login.login');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('loginProcess');
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot-password');
Route::post('/forgot-password', [AuthController::class, 'submitForgotPasswordForm'])->name('forgot-password.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
// -----------------------------------------------------------------------------------------------------------
use App\Http\Controllers\karyawanController;
// -----------------------------------------------------------------------------------------------------------
use App\Http\Controllers\tanamanController;
Route::get('/home', [tanamanController::class, 'indexP'])->name('home');
Route::get('/homeKywn', [karyawanController::class, 'indexKywn'])->name('homeKywn');
Route::get('/tambahTanaman', [tanamanController::class, 'tambahTanaman'])->name('tambahTanaman');
Route::get('/batalTambah', [tanamanController::class, 'batalTambah'])->name('batalTambah');
Route::post('/simpanTanaman', [tanamanController::class, 'simpanTanaman'])->name('simpanTanaman');
Route::get('/editTanaman/{id}', [tanamanController::class, 'editTanaman'])->name('editTanaman');
Route::post('/tanaman/update/{id}', [tanamanController::class, 'updateTanaman'])->name('tanaman.update');
Route::post('/deleteTanaman', [tanamanController::class, 'destroy'])->name('deleteTanaman');
Route::get('/tanaman', [tanamanController::class, 'listTanaman'])->name('listTanaman');
Route::get('/tanaman/show', [TanamanController::class, 'showTanaman'])->name('tanaman.show');
// -----------------------------------------------------------------------------------------------------------
use App\Http\Controllers\CartController;
Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add'); // Rute untuk menambah ke keranjang
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart'); // Rute untuk melihat keranjang
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::put('/cart/decrease/{rowId}', [CartController::class, 'decrease_cart_quantity'])->name('cart.decreaseqty');
Route::put('/cart/increase/{rowId}', [CartController::class, 'increase_cart_quantity'])->name('cart.increaseqty');
// -----------------------------------------------------------------------------------------------------------
use App\Http\Controllers\TransaksiController;
// Route::post('/transaksi', [TransaksiController::class, 'store']);
Route::get('/transaksi', [TransaksiController::class, 'index']);
Route::put('/transaksi/{idTJual}', [TransaksiController::class, 'updateStatus']);
Route::get('/transaksi', [TransaksiController::class, 'show']);
Route::get('/transaksi', [TransaksiController::class, 'show'])->name('transaksi');


// Rute untuk menampilkan halaman pembayaran
// Route::get('/transaksi', [TransaksiController::class, 'show'])->name('transaksi.show');

// // Rute untuk memproses pembayaran (opsional, jika ada aksi pembayaran lebih lanjut)
// Route::post('/transaksi/bayar', [TransaksiController::class, 'bayar'])->name('transaksi.bayar');


// -----------------------------------------------------------------------------------------------------------
use App\Http\Controllers\pesananController;
Route::get('/pesanan', [PesananController::class, 'show'])->name('pesanan');
// Route::get('/tanaman', [tanamanController::class, 'listTanaman'])->name('listTanaman');


Route::get('/orders', [TransaksiController::class, 'index'])->name('orders.index');
Route::get('/orders/create', [TransaksiController::class, 'create'])->name('orders.create');
Route::post('/orders', [TransaksiController::class, 'store'])->name('orders.store');
Route::get('/orders/{id}/edit', [TransaksiController::class, 'edit'])->name('orders.edit');
Route::put('/orders/{id}', [TransaksiController::class, 'update'])->name('orders.update');
// Route::delete('/orders/{id}', [TransaksiController::class, 'destroy'])->name('orders.destroy');

