<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    protected $table = 'gudangs';
    protected $fillable = ['sampah_id', 'berat']; 
}
