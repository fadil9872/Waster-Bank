<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    protected $table    = 'permintaans';
    protected $fillable = ['user_id','pengurus_id','nama','alamat_id', 'wilayah_id', 'lokasi','no_telpon','keterangan','status', 'tanggal'];

    public function saldo() {
        return $this->belongsTo('App\Model\Saldo', 'id', 'id');
    } 

    public function getTanggalAttribute($value) {
        return Carbon::parse($this->attributes['tanggal'])->translatedFormat('l, d-m-Y');
    }
    
}
