<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemilahanSampah extends Model
{
    use HasFactory;
    
    protected $table = 'pemilahan_sampah';

    protected $fillable = [
        'kategori','jumlah'
    ];
    protected $hidden = [];
}
