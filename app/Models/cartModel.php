<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// class karyawan extends Model implements Authenticatable
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
        'namaTanaman',
        'jumlah',
        'harga_satuan',
        'total_harga',
    ];

    // Relasi ke model Pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(pelangganModel::class, 'idCust', 'idCust');
    }

    // Relasi ke model Tanaman
    public function tanaman()
    {
        return $this->belongsTo(tanamanModel::class, 'idTanaman', 'idTanaman');
    }

}
