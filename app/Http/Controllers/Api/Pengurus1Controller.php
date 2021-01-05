<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Pendataan;
use Illuminate\Http\Request;
use App\Model\Permintaan;
use App\Model\Saldo;
use App\Model\Sampah;
use App\Model\Tabungan;

class Pengurus1Controller extends Controller
{
    public function get_permintaan()
    {
        $permintaan = Permintaan::where('status', 1)->get();

        return $this->sendResponse('success', 'Ini Data Permintaan', $permintaan, 200);
    }

    public function get_permintaan_id($id)
    {
        $permintaan = Permintaan::where('status', 1)->where('id', $id)->where('keterangan', 2)->first();

        return $this->sendResponse('success', 'Ini Data Permintaan satuan', $permintaan, 200);
    }

    public function pendataanJemput(Request $request, $id)
    {
        //Dapatkan Hasil Permintaan dari nasabah sesuai id
        $permintaan = Permintaan::where('id', $id)->where('status', 1)->first();
        //dapatkan user pengurus_1 yang online
        $user = auth()->user();
        return $request->sampah;
        //dapatkan sampah yang sesuai dengan idnya
        // $sampah = Sampah::where('id', $request->sampah_id)->first();
        // //pemasukan sampah dikalikan dari harga sampah * berat yang di imputkan - 10%
        // $debit  = $sampah->harga * $request->berat - ($sampah->harga * $request->berat * 0.1);
        // //dapatkan saldo user
        // $saldo_user  = Saldo::where('user_id', $permintaan->user_id)->first();
        // //penjumlahan saldo sebelum + yg baru di jual
        // $saldo  = $saldo_user->saldo + $debit;

        // $item  = Pendataan::create([
        //     'user_id'       =>  $permintaan->user_id,
        //     'pengurus1_id'  =>  $user->id,
        //     'permintaan_id' =>  $permintaan->id,
        //     'sampah_id'     =>  $request->sampah_id,
        //     'berat'         =>  $request->berat,
        //     'keterangan'    =>  $permintaan->keterangan,
        //     'debit'         =>  $debit,
        //     'saldo'         =>  $saldo,

        // ]);

        


        // Rencana B
        $sampahs = $request->sampah;

        foreach ($sampahs as $item) {
            $sampah = Sampah::where('id', $item['sampah_id'])->first();
            //pemasukan sampah dikalikan dari harga sampah * berat yang di imputkan - 10%
            $debit  = $sampah->harga * $item['berat'] - ($sampah->harga * $item['berat'] * 0.1);
            //dapatkan saldo user
            $saldo_user  = Saldo::where('user_id', $permintaan->user_id)->first();
            //penjumlahan saldo sebelum + yg baru di jual
            $saldo  = $saldo_user->saldo + $debit;

            $item  = Pendataan::create([
                'user_id'       =>  $permintaan->user_id,
                'pengurus1_id'  =>  $user->id,
                'permintaan_id' =>  $permintaan->id,
                'sampah_id'     =>  $item['sampah_id'],
                'berat'         =>  $item['berat'],
                'keterangan'    =>  $permintaan->keterangan,
                'debit'         =>  $debit,
                'saldo'         =>  $saldo,

            ]);
        }
        // $tabungan = Tabungan::create([
        //     'user_id'   =>  $permintaan->user_id,
        //     'debit'     =>  $debit,
        //     'saldo'     =>  $saldo,
        // ]);


        $saldo_tabungan  = $saldo_user->update([
            'saldo' =>  $saldo,
        ]);

        return response()->json([
            'status'    =>  'success',
            'message'   =>  'Ini data yang sudah dimasukan',
            'pendataan' =>  $pendataan,
            'saldo user' =>  $saldo_tabungan,
        ], 200);
    }
}
