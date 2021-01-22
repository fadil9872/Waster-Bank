<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Tabungan;
use Illuminate\Http\Request;

class TabunganController extends Controller
{
    public function index($id)
    {
        $users   = Tabungan::where('user_id', $id)->get();

        return view('admin.tabungan.index', compact('users', $users));
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
