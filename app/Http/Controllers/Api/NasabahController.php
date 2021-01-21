<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Alamat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Spatie\Permission\Traits\HasRoles;
use App\Model\User;
use App\Model\Saldo;
use App\Model\Permintaan;
use Carbon\Carbon;

class NasabahController extends Controller
{

    public function permintaan (Request $request) {
        $user       = auth()->user();

        $alamat     = Alamat::where('id', $request->alamat_id)->where('user_id', $user->id)->first();

        $tanggal    = Carbon::now()->toDateString();

        if (! $alamat) {
            return $this->sendResponse('error', 'alamat tidak ditemukan', NULL, 400);
        }
        
        $permintaan = Permintaan::create([
            'user_id'       =>  $user->id,
            'nama'          =>  $user->name,
            'lokasi'        =>  $alamat->alamat,
            'alamat_id'     =>  $alamat->id,
            'wilayah_id'    =>  $alamat->wilayah_id,
            'no_telpon'     =>  $user->no_telpon,
            'keterangan'    =>  $request->keterangan,
            'tanggal'       =>  $alamat,
            'status'        =>  1,
        ]);

        return $this->sendResponse('success', 'Data Berhasil Di Buat',$permintaan, 200);
    }

    public function get_permintaan () {
        $user   = auth()->user();

        $tanggal = Carbon::now()->toDateString();
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
