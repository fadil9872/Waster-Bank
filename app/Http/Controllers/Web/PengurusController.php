<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Role;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class PengurusController extends Controller
{
    public function index()
    {
        $users = Role::where('role_id', '!=', 6)->where('role_id', '!=', 1)->get();
        // $users = DB::select("select * from model_has_roles where role_id != 1 && role_id != 6");

        return view('admin.pengurus.index', compact('users', $users));
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
