<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Pendataan;
use Illuminate\Http\Request;

class PenyetoranController extends Controller
{
    public function index()
    {
        $penyetoran = Pendataan::get();

        return view('admin.penyetoran.index', compact('penyetoran', $penyetoran));
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
