<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailTModel extends Model
{
    use HasFactory;

    protected $table = 'detailtransaksijual';
    public $timestamps = false;

    protected $fillable = [
        'idTJual',
        'idTanaman',
        'harga_satuan',
        'jumlah',
    ];

    public function transaksi()
    {
        // Mengubah foreign key menjadi 'idTJual'
        // Mendefinisikan relasi kebalikannya, satu DetailTransaksiJual milik satu TransaksiJual
        return $this->belongsTo(transaksiModel::class, 'idTJual', 'idTJual');
    }

    // Pada model DetailTransaksi
    public function tanaman()
    {
        return $this->belongsTo(tanamanModel::class, 'idTanaman');
    }
}
