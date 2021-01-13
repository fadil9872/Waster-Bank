<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Alamat;
use Illuminate\Http\Request;


class AlamatController extends Controller
{
    public function addAlamat(Request $request)
    {
        $user = auth()->user();

        $alamat = Alamat::create([
            'user_id'   => $user->id,
            'alamat'    => $request->alamat,
            'wilayah_id' => $request->wilayah_id,
            'status'    => 2,
        ]);

        return $this->sendResponse('success', 'Alamat berhasil dibuat', $alamat, 200);
    }

    public function editAlamat(Request $request, $id)
    {
        $user   = auth()->user();

        $alamat = Alamat::where('id', $id)->where('user_id', $user->id)->first();

        $alamat->update([
            'alamat'    => $request->alamat,
            'wilayah_id' => $request->wilayah_id,
        ]);
        return $this->sendResponse('success', 'Alamat berhasil diubah', $alamat, 200);
    }

    public function delete($id) {
        $user   = auth()->user();

        $alamat = Alamat::where('id', $id)->where('user_id', $user->id)->first();
        if (empty($alamat)) {
            return $this->sendResponse('error', 'Alamat tidak ditemukan', NULL, 200);
        }
        $alamat->delete();

        return $this->sendResponse('success', 'Alamat berhasil dihapus', NULL, 200);
    }
}
