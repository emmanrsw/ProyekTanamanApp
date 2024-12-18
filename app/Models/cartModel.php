<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cartModel extends Authenticatable

{
    use HasFactory;
    use AuthenticatableTrait;
    protected $table = 'keranjang';
    protected $primaryKey = 'idKeranjang';
    public $timestamps = false;

    protected $fillable = [
        'idCust',
        'idTanaman',
        'jumlah',
        'harga_satuan',
    ];

    // Relasi ke model Pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(pelangganModel::class, 'idCust');
    }

    // Relasi ke model Tanaman
    public function tanaman()
    {
        return $this->belongsTo(tanamanModel::class, 'idTanaman');
    }

}
