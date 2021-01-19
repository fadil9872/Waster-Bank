<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Role;
use App\Model\Tabungan;
use Illuminate\Http\Request;

class Pengurus2Controller extends Controller
{
    public function penjualan() {
        $user =  auth()->user();
        
        $role = Role::where('model_id', $user)->first();

        //validasi Role yang hanya rolenya bendahara
        if ($role->role_id != 2) {
            return $this->sendResponse('error', 'Anda bukan bendahara', NULL, 404);
        } 
        $tabungan =  Tabungan::where('user_id', $role->model_id)->first();

        
        
    }
}
