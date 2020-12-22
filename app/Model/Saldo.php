<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    protected $table    = 'saldos';
    protected $fillable = ['saldo', 'user_id']; 
}
