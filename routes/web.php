<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('tanamanHPP');
});
Route::get('/tentangKami', function () {
    return view('tentangKami');
})->name('tentangKami');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

use App\Http\Controllers\PelangganController;

// Route::post('/editPelanggan', [PelangganController::class, 'edit'])->name('editProfile');
// Route::post('/updatePelanggan', [PelangganController::class, 'updateProfile'])->name('updateProfile');
Route::middleware(['auth:pelanggan'])->group(function () {
    Route::get('/profile', [PelangganController::class, 'showProfile'])->name('pelanggan.profile');
    Route::get('/profile/edit', [PelangganController::class, 'edit'])->name('pelanggan.edit');
    Route::post('/profile/update', [PelangganController::class, 'updateProfile'])->name('pelanggan.update');
    Route::post('/update-profile-picture', [PelangganController::class, 'updateProfilePicture'])->name('updateProfilePicture');

    Route::post('/profile/delete-image', [PelangganController::class, 'deleteProfilePicture'])->name('deleteProfilePicture');
});

use App\Http\Controllers\AuthController;

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerProcess']);
Route::get('/login', [AuthController::class, 'login'])->name('login.login');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('loginProcess');
// Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot-password');
// Route::post('/forgot-password', [AuthController::class, 'submitForgotPasswordForm'])->name('forgot-password.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');


// Rute untuk menampilkan form reset password setelah OTP diverifikasi
Route::get('/resetPass}', [AuthController::class, 'showResetForm'])->name('password.reset');
// Rute untuk menangani pengaturan password baru
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');


// -----------------------------------------------------------------------------------------------------------
use App\Http\Controllers\OtpController;

Route::get('/otp', [OtpController::class, 'showOtpSendForm'])->name('otp.send');
Route::get('/otpform', [OtpController::class, 'showOtpSendForm'])->name('otp.form');
Route::post('/otp', [OtpController::class, 'sendOtp'])->name('otp.send.submit');
Route::get('/otp/verify', [OtpController::class, 'showOtpForm'])->name('otp.verification');
Route::post('/otp/verify', [OtpController::class, 'verifyOtp'])->name('otp.verify');



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
Route::get('/search', [TanamanController::class, 'search'])->name('searchTanaman');
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

Route::post('/transaksi', [TransaksiController::class, 'prosesTransaksi'])->name('transaksi');
Route::post('/transaksi/simpan', [TransaksiController::class, 'simpanTransaksi'])->name('transaksi.simpan');
Route::get('/pesanan', [TransaksiController::class, 'showPesanan'])->name('pesanan');

// ----------------------------- transaksi di karyawan
Route::get('/orderlist', [TransaksiController::class, 'show_order'])->name('orderlist');
Route::put('/update-status/{idTJual}', [TransaksiController::class, 'updateStatus'])->name('updateStatus');
Route::get('/viewT/{id}', [TanamanController::class, 'viewT'])->name('viewT');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

