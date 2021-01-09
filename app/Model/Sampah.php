<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sampah extends Model
{
    protected $table = 'sampahs';
    protected $fillable = ['nama', 'harga_nasabah', 'harga_pengepul'];
}
