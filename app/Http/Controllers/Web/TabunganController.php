<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Saldo;
use App\Model\Tabungan;
use Illuminate\Http\Request;

class TabunganController extends Controller
{
    public function index($id)
    {
        $users   = Tabungan::where('user_id', $id)->get();

        $idku = $id;

        return view('admin.tabungan.index', compact('users', 'idku'));
    }
    public function index2($id)
    {
        $users   = Tabungan::where('user_id', $id)->get();

        $idku = $id;

        return view('bendahara.tabungan.index', compact('users', 'idku'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {

        $penjumlahan = $request->debit - $request->kredit;

        $users = Tabungan::create([
            'user_id'       => $request->user_id,
            'keterangan'    => $request->keterangan,
            'debit'         => $request->debit,
            'kredit'        => $request->kredit,
        ]);

        $saldo = Saldo::where('user_id', $request->user_id)->first();
        $saldo->saldo = $saldo->saldo + $penjumlahan;
        $saldo->save();


        return redirect('admin/tabungan/nasabah/' . $request->user_id)->with('status', 'Tabungan Berhasil Di tambah');
    }

    public function store2(Request $request)
    {

        $penjumlahan = $request->debit - $request->kredit;

        $users = Tabungan::create([
            'user_id'       => $request->user_id,
            'keterangan'    => $request->keterangan,
            'debit'         => $request->debit,
            'kredit'        => $request->kredit,
        ]);

        $saldo = Saldo::where('user_id', $request->user_id)->first();
        $saldo->saldo = $saldo->saldo + $penjumlahan;
        $saldo->save();


        return redirect('bendahara/tabungan/nasabah/' . $request->user_id)->with('status', 'Tabungan Berhasil Di tambah');
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        $users = Tabungan::where('id', $id)->first();

        $data = $request->all();

        $filter   = array_filter($data);

        $users->update(
            $filter
        );

        $penjumlahan = $request->debit - $request->kredit;
        $saldo = Saldo::where('user_id', $request->user_id)->first();
        $saldo->saldo = $saldo->saldo + $penjumlahan;
        $saldo->save();

        return redirect('admin/tabungan/nasabah/' . $users->user_id)->with('status', 'Tabungan Berhasil Di Edit');
    }

    public function destroy($id)
    {
        $tabungan = Tabungan::where('id', $id)->first();

        $penjumlahan = $tabungan->debit - $tabungan->kredit;
        $saldo = Saldo::where('user_id', $tabungan->user_id)->first();
        $saldo->saldo = $saldo->saldo + $penjumlahan;
        $saldo->save();
        
        $user       = $tabungan->user_id;
        $tabungan->delete();
        return redirect('admin/tabungan/nasabah/' . $user)->with('status', 'Tabungan Berhasil Di Hapus');
    }
}
