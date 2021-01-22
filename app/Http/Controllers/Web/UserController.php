<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Role;
use App\Model\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = Role::where('role_id', 6)->get();


        return view('admin.nasabah.index', compact('users', $users));
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
