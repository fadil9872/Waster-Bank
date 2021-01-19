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

    public function hapusAlamat($id) {
        $user   = auth()->user();

        $alamat = Alamat::where('id', $id)->where('user_id', $user->id)->first();

        if ($alamat->status == 1) {
            return $this->sendResponse('error', 'Alamat Utama tidak bisa di hapus', NULL, 200);
        }
        if (empty($alamat)) {
            return $this->sendResponse('error', 'Alamat tidak ditemukan', NULL, 200);
        }
        $alamat->delete();

        return $this->sendResponse('success', 'Alamat berhasil dihapus', NULL, 200);
    }

    public function ubahAlamat($id) {
        $user   = auth()->user();

        $alamats = Alamat::where('user_id', $user->id)->get();

        foreach ($alamats as $alamat) {
            $alamat->status = 2;
            $alamat->update();
        }

        $alamatNew  = Alamat::where('id', $id)->where('user_id', $user->id)->first();
        $alamatNew->status = 1;
        $alamatNew->update();

        return $this->sendResponse('success', 'Alamat Utama berhasil di ubah', $alamatNew , 200);
    }
}
