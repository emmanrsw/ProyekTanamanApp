<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

use Illuminate\Foundation\Auth\User as Authenticatable;

// class karyawan extends Model implements Authenticatable
class cartModel extends Authenticatable
{
    use AuthenticatableTrait;
    protected $table = 'keranjang';
    protected $primaryKey = 'idKeranjang';
    // public $timestamps = false;

    protected $fillable = [
        'namaKywn',
        'usernameKywn',
        'emailKywn',
        'passwordKywn',
        'alamatKywn',
    ];

}
