<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Gudang;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    public function index()
    {
        $gudang     = Gudang::get();
        return view('admin.gudang.index', compact('gudang', $gudang));

    }
    public function index2()
    {
        $gudang     = Gudang::get();
        return view('bendahara.gudang.index', compact('gudang', $gudang));

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
