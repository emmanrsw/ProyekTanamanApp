<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\detailTModel;

class transaksiModel extends Model
{
    public $timestamps = false; // Nonaktifkan timestamps

    protected $table = 'transaksijual';
    protected $primaryKey = 'idTJual';

    protected $fillable = [
        'idCust',
        'harga_total',
        'pajak',
        'alamat_kirim',
        'tglTJual',
        'waktuTJual',
        'metodeByr',
        'statusTJual'
    ];

    public function details()
    {
        // Mengubah foreign key menjadi 'idTJual'
        return $this->hasMany(detailTModel::class, 'idTJual', 'idTJual');
    }

    public function pelanggan()
    {
        return $this->belongsTo(pelangganModel::class, 'idCust', 'idCust');
    }
}
