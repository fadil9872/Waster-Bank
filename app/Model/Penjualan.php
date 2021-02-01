<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Traits\TimeNow;

class Penjualan extends Model
{
    protected $fillable = ['pengurus2_id', 'pembeli', 'gudang_id', 'berat', 'pendapatan'];

    use TimeNow;
    // public function getCreatedAtAttribute() {
    //     return Carbon::parse($this->attributes['created_at'])
    //         ->translatedFormat('d F Y H:i');
    // }
}
