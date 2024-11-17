<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimbulanSampah extends Model
{
    use HasFactory;

    protected $table = 'timbulan_sampah';

    protected $fillable = [
        'kategori','nama','jumlah'
    ];
    protected $hidden = [];
}
