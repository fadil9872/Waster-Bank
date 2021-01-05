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
    public function home()
    {
        $users  = auth()->user();
        $user   = User::where('id', $users->id)->first();
        
        return $this->sendResponse('success', 'Data berhasi di tampilkan', $user, 200);
    }

    public function permintaan (Request $request) {
        $user       = auth()->user();
        if ($request->keterangan = 2) {
            
        }
        $permintaan = Permintaan::create([
            'user_id'       =>  $user->id,
            'nama'          =>  $user->name,
            'lokasi'        =>  $user->alamat,
            'no_telpon'     =>  $user->no_telpon,
            'keterangan'    =>  $request->keterangan,
            'status'        =>  1,
        ]);

        return $this->sendResponse('success', 'Data Berhasil Di Buat',$permintaan, 200);
    }

    public function delete_permintaan($id) {
        $user   = auth()->user();

        $permintaan = Permintaan::where('id', $id)->first();

        $permintaan->delete();

        return $this->sendResponse('success', 'Data berhasil dihapus', NULL, 200);
    }
}
