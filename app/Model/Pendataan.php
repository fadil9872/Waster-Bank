<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pendataan extends Model
{
    protected $table    = 'pendataans';
    protected $fillable = ['user_id','pengurus1_id','permintaan_id','sampah_id','berat','keterangan','debit','kredit','saldo',];
}