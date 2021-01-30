<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Alamat;
use App\Model\Role;
use App\Model\Saldo;
use App\Model\User;
use App\Model\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Traits\HasRoles;

class PengurusController extends Controller
{
    public function index()
    {
        $users      = Role::where('role_id', '!=', 6)->where('role_id', '!=', 1)->get();
        // $users = DB::select("select * from model_has_roles where role_id != 1 && role_id != 6");
        $wilayahs   = Wilayah::get();

        $roles      = DB::select("select * from roles where id != 1 AND id != 6");
        // dd($roles[0]);
        return view('admin.pengurus.index', compact('users', 'wilayahs', 'roles'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama'          => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users',
            'password'      => 'required|string|min:6',
            'alamat'        => 'required|string|max:255',
            'no_telpon'     => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $password = Hash::make($request->get('password'));

        $user = User::create([
            'name'                  =>  $request->get('nama'),
            'email'                 =>  $request->get('email'),
            'password'              =>  $password,
            'no_telpon'             =>  $request['no_telpon'],
            'avatar'                =>  'https:\/\/iili.io\/FVdLas.png',
        ]);
        $user->assignRole($request->role_id);

        //cek user yang sudah di buat tadi
        $old_user = User::where('email', $request->email)->first();

        $alamat = Alamat::create([
            'user_id'       =>  $old_user->id,
            'alamat'        =>  $request->alamat,
            'wilayah_id'    =>  $request->wilayah_id,
            'status'        =>  1,
        ]);

        $saldo = Saldo::create([
            'user_id'       =>  $old_user->id,
            'saldo'         =>  '0',
        ]);
        $role   = Role::where('model_id', $old_user->id)->first();
        // dd($role);

        if ($role->role_id == 6) {
            return redirect('admin/nasabah')->with('status', 'User Berhasil Di tambah');
        }
        
        return redirect('admin/pengurus')->with('status', 'User Berhasil Di tambah');
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
        $validator = Validator::make($request->all(), [
            'name'      =>  'required',
            'email'     =>  'required',
            'no_telpon' =>  'required',
            'role_id'   =>  'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        
        $user = User::where('id', $id)->first();
        if ($request->role_id) {
            $role = DB::select("SELECT * FROM roles WHERE id = $request->role_id");
            $user->syncRoles($role[0]->name);
        }
        
        $data = $request->all('name', 'email', 'no_telpon');

        $filter   = array_filter($data);

        $user->update(
            $filter
        );

        if ($request->avatar) {
            $img = base64_encode(file_get_contents($request->avatar));

            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', 'https://freeimage.host/api/1/upload', [
                'form_params' => [
                    'key'       => '6d207e02198a847aa98d0a2a901485a5',
                    'action'    => 'upload',
                    'source'    => $img,
                    'format'    => 'json'
                ]
            ]);
            $arr = json_decode($response->getBody()->getContents());
            $avatar = $arr->image->file->resource->chain->image;
            
            $user->avatar = $avatar;
            $user->update();

            
            
        }
        
        $role   = Role::where('model_id', $user->id)->first();
        // dd($role);

        if ($role->role_id == 6) {
            return redirect('admin/nasabah')->with('status', 'User Berhasil Di Edit');
        }
        
        return redirect('admin/pengurus')->with('status', 'User Berhasil Di Edit');
        

    }

    public function destroy($id)
    {
        //
    }
}
