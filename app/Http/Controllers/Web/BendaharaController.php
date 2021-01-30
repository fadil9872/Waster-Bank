<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
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
        return view('admin.index', compact('saldo_bank', 'user', 'penjualan', 'pendataan'));
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
