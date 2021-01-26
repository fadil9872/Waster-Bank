<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Room extends Model
{
public function participant() {
    return BelongsToMany('App/Room', 'id', 'room_id');
}
}
