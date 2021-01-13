<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    protected $table    = 'alamats';
    protected $fillable = ['alamat', 'wilayah_id', 'user_id', 'status'];
}
