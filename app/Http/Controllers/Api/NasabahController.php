<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Spatie\Permission\Traits\HasRoles;
use App\Model\User;
use App\Model\Saldo;
use App\Model\Permintaan;

class NasabahController extends Controller
{

    public function permintaan (Request $request) {
        $user       = auth()->user();
        
        $permintaan = Permintaan::create([
            'user_id'       =>  $user->id,
            'nama'          =>  $user->name,
            'lokasi'        =>  $request->lokasi,
            'no_telpon'     =>  $user->no_telpon,
            'keterangan'    =>  $request->keterangan,
            'status'        =>  1,
        ]);

        return $this->sendResponse('success', 'Data Berhasil Di Buat',$permintaan, 200);
    }

    public function get_permintaan () {
        $user   = auth()->user();
        $permintaan = Permintaan::where('user_id', $user->id)->where('status', 1)->get();
        // if (!$permintaan) {
        //     $permintaan = Permintaan::where('status', 1)->get();
        // }

        return $this->sendResponse('success', 'Ini data permintaannya', $permintaan, 200);
    }

    public function get_permintaan_id ($id) {
        $user   = auth()->user();

        $permintaan = Permintaan::where('id', $id)->first();

        return $this->sendResponse('success', 'Ini detail permintaannya');
    }


    public function delete_permintaan($id) {
        $user   = auth()->user();

        $permintaan = Permintaan::where('id', $id)->first();

        $permintaan->delete();

        return $this->sendResponse('success', 'Data berhasil dihapus', NULL, 200);
    }
}
