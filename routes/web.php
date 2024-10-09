<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\karyawanController;
use App\Http\Controllers\tanamanController;

Route::get('/', function () {
    return view('welcome');
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

// Route::get('/addPlant', [tanamanController::class, 'tambahTanaman'])->name('addPlant');



Route::get('/tambahTanaman', [tanamanController::class, 'tambahTanaman'])->name('tambahTanaman');
Route::get('/batalTambah', [tanamanController::class, 'batalTambah'])->name('batalTambah');

// Route untuk menyimpan tanaman
Route::post('/simpanTanaman', [tanamanController::class, 'simpanTanaman'])->name('simpanTanaman');




// Route::post('/simpanTanaman', [tanamanController::class, 'tambahTanaman'])->name('tambah');
// // Menampilkan form edit
// Route::get('/tanaman/edit/{id}', [TanamanController::class, 'edit'])->name('tanaman.edit');
// // Mengupdate data tanaman
// Route::post('/tanaman/update/{id}', [TanamanController::class, 'update'])->name('tanaman.update');


// Route::get('/tanaman/{id}', [tanamanController::class, 'show'])->name('tanaman.show');

// Route::get('/tanaman', [tanamanController::class, 'index'])->name('tanaman');
// Route::post('/simpanTanaman', [tanamanController::class, 'add'])->name('tanaman.store');
// Route::get('/tanaman/{id}/edit', [tanamanController::class, 'edit'])->name('tanaman.edit');
// Route::post('/tanaman/{id}/update', [tanamanController::class, 'update'])->name('tanaman.update');
