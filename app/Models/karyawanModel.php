<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

use Illuminate\Foundation\Auth\User as Authenticatable;

class karyawanModel extends Authenticatable
{
    use AuthenticatableTrait;
    protected $table = 'karyawan';
    protected $primaryKey = 'idKywn';

    protected $fillable = [
        'namaKywn',
        'usernameKywn',
        'emailKywn',
        'passwordKywn',
        'alamatKywn',
    ];

    protected $hidden = [
        'passwordKywn',
        'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = $password; // Simpan password sebagai teks biasa
    }

}
