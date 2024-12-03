<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailTModel extends Model
{
    use HasFactory;

    protected $table = 'detailtransaksijual';
    protected $primaryKey = 'idDetailTransaksi';
    public $timestamps = false;

    protected $fillable = [
        'idTJual',
        'idTanaman',
        'nama_tanaman',
        'harga_satuan',
        'jumlah',
        'total_harga'
    ];

    public function transaksi()
    {
        // Menggunakan 'idTJual' sebagai foreign key yang mengarah ke 'id' pada tabel transaksi
        return $this->belongsTo(transaksiModel::class, 'idTJual', 'id');
    }
}
