<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class pelangganModel extends Authenticatable
{
    // use AuthenticatableTrait; // Ini akan menambahkan fungsionalitas autentikasi
    use AuthenticatableTrait, HasFactory; 

    protected $table = 'pelanggan'; // Pastikan tabel yang sesuai
    protected $primaryKey = 'idCust'; // Sesuaikan dengan primary key
    public $timestamps = false;

    // Atur atribut mass assignable
    protected $fillable = [
        'namaCust',
        'usernameCust',
        'emailCust',
        'alamatCust',
        'notelp', // buat nampilin di profile
        'passwordCust'
    ];
    // Menyembunyikan kolom saat model dikembalikan dalam array atau JSON
    // protected $hidden = [
    //     'passwordCust',
    //     'remember_token',
    // ];

    // // Casting kolom tipe data tertentu
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    // Jika kamu menggunakan hashing password, jangan lupa untuk menambahkan mutator
    // public function setPasswordCustAttribute($password)
    // {
    //     $this->attributes['passwordCust'] = bcrypt($password);
    // }
}
