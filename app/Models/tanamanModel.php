<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tanamanModel extends Model
{
    // use HasFactory;
    public $timestamps = false; // Nonaktifkan timestamps

    protected $table = 'tanaman';
    protected $primaryKey = 'idTanaman';

    // Jika Anda memiliki kolom tertentu di tabel, Anda dapat menentukan fillable di sini.
    protected $fillable = [
        'namaTanaman',
        'deskripsi',
        'jmlTanaman',
        'hargaTanaman',
        'gambar',
    ];
}
