<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksiModel extends Model
{
    // use HasFactory;
    public $timestamps = false; // Nonaktifkan timestamps

    protected $table = 'transaksijual';
    protected $primaryKey = 'idTJual';

    protected $fillable = [
        'idCust',
        'idKywn',
        'idTanaman',
        'tglTJual',
        'waktuTJual',
        'metodeByr',
        'statusTjual',
        'total_harga',
    ];

}
