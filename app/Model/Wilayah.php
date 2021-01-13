<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    protected $table    = 'wilayahs';
    protected $fillable = ['id', 'id_kota', 'nama',];
}
