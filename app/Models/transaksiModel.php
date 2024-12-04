<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\detailTModel;

class transaksiModel extends Model
{
    // use HasFactory;
    public $timestamps = false; // Nonaktifkan timestamps

    protected $table = 'transaksijual';
    protected $primaryKey = 'idTJual';

    protected $fillable = [
        'idCust',
        'subtotal',
        'pajak',
        'total_harga',
        'alamat_kirim',
        'tglTJual',
        'waktuTJual',
        'metodeByr',
        'statusTJual'
    ];

// ini awal code aslinya
    // public function details()
    // {
    //     return $this->hasMany(detailTModel::class, 'idTransaksi', 'idTJual');
    // }

    public function details()
    {
        // Mengubah foreign key menjadi 'idTJual'
        return $this->hasMany(detailTModel::class, 'idTJual', 'idTJual');
    }
}
