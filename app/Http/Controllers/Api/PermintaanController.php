<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Permintaan;
use Illuminate\Http\Request;

class PermintaanController extends Controller
{
    
    public function get_permintaan () {
        $user   = auth()->user();
        $permintaan = Permintaan::where('user_id', $user->id)->where('status', 1)->get();

        return $this->sendResponse('success', 'Ini data permintaannya', $permintaan, 200);
    }

    public function get_permintaan_id ($id) {
        $user   = auth()->user();

        $permintaan = Permintaan::where('id', $id)->first();

        return $this->sendResponse('success', 'Ini detail permintaannya');
    }

}
