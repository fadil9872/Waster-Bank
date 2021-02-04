<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Role;
use App\Model\Saldo;
use App\Model\User;
use App\Model\Wilayah;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = Role::where('role_id', 6)->get();

        $wilayahs = Wilayah::get();
        // dd($wilayah[0]['id']);

        return view('admin.nasabah.index', compact('users', 'wilayahs'));
    }
    public function index2()
    {
        $users = Role::where('role_id', 6)->with('saldo')->get();

        // dd($users);

        // $saldo = Saldo::where('user_id', $users->model_id)->first();

        $wilayahs = Wilayah::get();
        // dd($wilayah[0]['id']);

        return view('bendahara.nasabah.index', compact('users', 'wilayahs'));
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
