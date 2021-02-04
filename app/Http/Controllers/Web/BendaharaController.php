<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Gudang;
use App\Model\Pendataan;
use App\Model\Penjualan;
use App\Model\Role;
use App\Model\Saldo;
use App\Model\User;
use Illuminate\Http\Request;

class BendaharaController extends Controller
{
    public function index()
    {
        $user       = User::get()->count();
        $users      = Role::where('role_id', 2)->first();
        $saldo_bank = Saldo::where('id', $users->model_id)->first();
        $penjualan  = Penjualan::get()->count();
        $pendataan  = Pendataan::get()->count();
        $gudang     = Gudang::get();
        return view('bendahara.index', compact('saldo_bank', 'gudang', 'user', 'penjualan', 'pendataan'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
