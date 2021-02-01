<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder\Trait_;

Trait TimeNow
{
    public function getCreatedAtAttribute() {
        return Carbon::parse($this->attributes['created_at'])
            ->translatedFormat('d F Y H:i');
    }

    public function getUpdatedAtAttribute() {
        return Carbon::parse($this->attributes['updated_at'])
            ->translatedFormat('d F Y H:i');
    }
}
