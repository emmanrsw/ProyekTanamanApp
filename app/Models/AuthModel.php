<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class AuthModel extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pelanggan';
    protected $primaryKey = 'idCust';
    public $timestamps = false;

    // Kolom yang diizinkan untuk mass assignment
    protected $fillable = [
        'namaCust',
        'usernameCust',
        'emailCust',
        'passwordCust',
        'gambarCust',
        'alamatCust',
        'notlpCust'
    ];

    // Menyembunyikan kolom saat model dikembalikan dalam array atau JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casting kolom tipe data tertentu
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Mutator untuk meng-hash password sebelum disimpan
    public function setPasswordCustAttribute($password)
    {
        $this->attributes['passwordCust'] = Hash::make($password);
    }
    protected $appends = ['password'];

    public function getPasswordAttribute()
    {
        return $this->attributes['passwordCust'];
    }
}
