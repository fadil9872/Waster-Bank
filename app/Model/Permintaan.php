<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    protected $table    = 'permintaans';
    protected $fillable = ['user_id','nama','lokasi','no_telpon','keterangan','status'];

    public function saldo() {
        return $this->belongsTo('App\Model\Saldo', 'id', 'id');
    } 
    
}
