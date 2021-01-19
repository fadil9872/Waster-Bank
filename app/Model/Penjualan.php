<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable = ['pengurus2_id', 'pembeli', 'gudang_id', 'berat', 'pendapatan'];
}
