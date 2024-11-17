<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomposisiSampah extends Model
{
    use HasFactory;
    
    protected $table = 'komposisi_sampah';

    protected $fillable = [
        'kategori','jumlah'
    ];
    protected $hidden = [];
}
