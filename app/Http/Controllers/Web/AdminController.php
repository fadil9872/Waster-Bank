<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Pendataan;
use App\Model\Penjualan;
use App\Model\Role;
use App\Model\Saldo;
use App\Model\Sampah;
use App\Model\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index ()
    {
        $user       = User::get()->count();
        $users      = Role::where('role_id', 2)->first();
        $saldo_bank = Saldo::where('id', $users->model_id)->first();
        $penjualan  = Penjualan::get()->count();
        $pendataan  = Pendataan::get()->count();
        return view('admin.index', compact('saldo_bank', 'user', 'penjualan', 'pendataan'));

    }
}
