<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\karyawanController;
use App\Http\Controllers\tanamanController;
use App\Http\Controllers\CartController;
use App\Models\tanamanModel;

Route::get('/', function () {
    return view('tanamanHPP');
});

Route::get('/login', [AuthController::class, 'login'])->name('login.login');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('loginProcess');

Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot-password');
Route::post('/forgot-password', [AuthController::class, 'submitForgotPasswordForm'])->name('forgot-password.submit');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerProcess']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/home', [tanamanController::class, 'indexP'])->name('home');
Route::get('/homeKywn', [karyawanController::class, 'indexKywn'])->name('homeKywn');

// -------------------

Route::get('/tambahTanaman', [tanamanController::class, 'tambahTanaman'])->name('tambahTanaman');
Route::get('/batalTambah', [tanamanController::class, 'batalTambah'])->name('batalTambah');
// Route untuk menyimpan tanaman yang ditambahkan
Route::post('/simpanTanaman', [tanamanController::class, 'simpanTanaman'])->name('simpanTanaman');

Route::get('/editTanaman/{id}', [tanamanController::class, 'editTanaman'])->name('editTanaman');
Route::post('/tanaman/update/{id}', [tanamanController::class, 'updateTanaman'])->name('tanaman.update');
Route::post('/deleteTanaman', [tanamanController::class, 'destroy'])->name('deleteTanaman');








Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');

Route::get('/tanaman', [tanamanController::class, 'listTanaman'])->name('listTanaman');


Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add'); // Rute untuk menambah ke keranjang
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart'); // Rute untuk melihat keranjang

Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');