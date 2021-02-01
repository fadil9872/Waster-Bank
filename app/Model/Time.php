<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    public function getCreatedAtAttribute() {
        return Carbon::parse($this->attributes['created_at'])
            ->translatedFormat('d F Y H:i');
    }

    public function getUpdateAtAttribute() {
        return Carbon::parse($this->attributes['update_at'])
            ->translatedFormat('d F Y H:i');
    }
}
