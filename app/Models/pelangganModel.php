<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 


 class pelangganModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'pelanggan'; // Pastikan tabel yang sesuai
    protected $primaryKey = 'idCust'; // Sesuaikan dengan primary key
    public $timestamps = false;

    // Atur atribut mass assignable
    protected $fillable = [
        'namaCust',
        'usernameCust',
        'emailCust',
        'passwordCust',
        'alamatCust',
        'gambarCust',
        'notlpCust' // buat nampilin di profile
    ];
}
