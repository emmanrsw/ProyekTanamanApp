<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    use HasFactory;

    protected $table = 'otp'; // Nama tabel

    protected $primaryKey = 'id'; // Primary key tabel

    public $timestamps = false; // Nonaktifkan created_at dan updated_at

    protected $fillable = [
        'otp',       // Kolom untuk kode OTP
        'waktu',     // Kolom waktu (datetime)
        'idCust',    // ID pelanggan
    ];
}
