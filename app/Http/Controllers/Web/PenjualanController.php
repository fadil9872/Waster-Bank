<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualan     = Penjualan::get();
        return view('admin.penjualan.index', compact('penjualan', $penjualan));

    }
    public function index2()
    {
        $penjualan     = Penjualan::get();
        return view('bendahara.penjualan.index', compact('penjualan', $penjualan));

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
