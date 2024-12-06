<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokLogModel extends Model
{
    use HasFactory;

    protected $table = 'stok_log'; // Nama tabel jika berbeda
    // Jika tabel ini tidak menggunakan timestamps (created_at, updated_at), matikan fitur tersebut
    protected $primaryKey = 'idStok';
    public $timestamps = false;
    protected $fillable = [
        'idTanaman',
        'tanggal',
        'jumlah_sebelumnya',
        'jumlah_terjual',
        'jumlah_masuk',
        'jumlah_baru',    
    ];
}
