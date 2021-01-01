<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    public function user () {
        return $this->belongsTo('App\Model\User', 'id', 'user_id');
    }
}
