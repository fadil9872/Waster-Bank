<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    protected $table = 'tabungans';
    protected $fillable = ['user_id','keterangan', 'debit', 'kredit'];
    public function user () {
        return $this->belongsTo('App\Model\User', 'id', 'user_id');
    }
}
