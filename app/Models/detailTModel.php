<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailTModel extends Model
{
    // use HasFactory;
    public $timestamps = false; // Nonaktifkan timestamps

    protected $table = 'detailtransaksijual';
    // protected $primaryKey = 'idTJual';

    protected $fillable = [
        'idTJual',
        'idTanaman',
        'jmlTJual',
        'hargaTjual',
    ];
}
