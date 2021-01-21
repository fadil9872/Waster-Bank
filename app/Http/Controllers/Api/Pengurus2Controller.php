<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Gudang;
use App\Model\Penjualan;
use App\Model\Role;
use App\Model\Saldo;
use App\Model\Sampah;
use App\Model\Tabungan;
use Illuminate\Http\Request;

class Pengurus2Controller extends Controller
{
    public function penjualan(Request $request) {
        $user =  auth()->user();
        
        $role = Role::where('model_id', $user->id)->first();
        // dd($role);
        $bendahara = Role::where('role_id', 2)->first();
        $user->hasRole('bendahara');

        // if (!$user->hasRole('bendahara')) {
        //     return $this->sendResponse('error', 'Anda bukan bendahara', NULL, 404);
        // }

        //validasi Role yang hanya rolenya Pengurus2
        if ($role->role_id != 5) {
            return $this->sendResponse('error', 'Anda bukan Pengurus 2', NULL, 404);
        } 

        $pendataan = $request->pendataan;

        foreach ($pendataan as $pendataan) {
            //cari saldo milik bank 
            $saldo_bank =  Saldo::where('user_id', $user->id)->first();
            
            //gudang
            $gudang = Gudang::where('id', $pendataan['gudang_id'])->first();
    
            //pengurangan di gudang
            $pengurangan = $gudang->berat - $request->berat; 
            //penjumlahan sampah 
            $sampah = Sampah::where('id', $gudang->sampah_id)->first();
    
            $pendapatan = $sampah->harga_pengepul * $request->berat;
    
            $penjualan = Penjualan::create([
                'pengurus2_id'  => $user->id,
                'pembeli'       => $pendataan['pembeli'],
                'gudang_id'     => $pendataan['gudang_id'],
                'berat'         => $pendataan['berat'],
                'pendapatan'    => $pendapatan,
            ]);
    
            $gudang->berat = $pengurangan;
            $gudang->update();
    
            
            $saldo_bank->saldo = $saldo_bank->saldo + $pendapatan;
            $saldo_bank->update();
        }
        
        return $this->sendResponse('success', 'Pendataan Penjualan Berhasil dibuat', $penjualan, 200);
    }
    
    public function getGudang() {
        $gudang = Gudang::get();

        return $this->sendResponse('success', 'Data Gudangnya ini', $gudang, 200);
    }
    public function getPenjualanPengepul() {
        $penjualan = Penjualan::get();

        return $this->sendResponse('success', 'ini data Penjualannya', $penjualan, 200);
    }
}
