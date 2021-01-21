<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Alamat;
use App\Model\Permintaan;
use App\Model\Role;
use App\Model\User;
use App\Model\Saldo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Spatie\Permission\Traits\HasRoles;


class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $user   = User::where('email', $request->email)->first();
        $user->hasRole('admin');
        if($user->hasRole('admin')) {
            
        }

        $saldo = Saldo::where('user_id', $user->id)->first();


        $role   = Role::where('model_id', $user->id)->first();
        $role   = $role->role_id;

        return response()->json(compact('token', 'user', 'role', 'saldo'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users',
            'password'      => 'required|string|min:6|confirmed',
            'alamat'        => 'required|string|max:255',
            'no_telpon'     => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name'          =>  $request->get('name'),
            'email'         =>  $request->get('email'),
            'password'      =>  Hash::make($request->get('password')),
            'no_telpon'     =>  $request['no_telpon'],
            'avatar'        =>  'https:\/\/iili.io\/FVdLas.png',
        ]);
        $user->assignRole('nasabah');

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
        $role   = $role->role_id;

        $token  = JWTAuth::fromUser($user);


        // $accessToken = $user->createToken('authToken')->accessToken;

        // return response(['user'=> $user, 'access_token'=> $accessToken]);

        return response()->json(compact('old_user', 'token', 'role', 'saldo'), 201);
    }

    public function profile()
    {
        $user   = auth()->user();

        $users  = User::where('id', $user->id)->with('Saldo')->first();

        return $this->sendResponse('success', 'Ini data profilnya', $users, 200);
    }

    public function getAuthenticatedUser()
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());
        }

        return response()->json(compact('user'));
    }

    public function edit_profile(Request $request)
    {
        $user = auth()->user();

        // return $user;

        // $name   = $users->name;
        // if ($request->name) {
        //     $name = $request->name;
        // }
        // $no_telpon = $users->no_telpon;
        // if ($request->no_telpon) {
        //     $no_telpon = $request->no_telpon;
        // }
        // $avatar = $users->avatar;

        $password = $request->password_confirmation;

        if (!Hash::check($password, $user->password)) {
            return $this->sendResponse('error', 'please check your password', NULL, 404);
        }

        $data = $request->all();

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


        return $this->sendResponse('success', 'Ini Datanya', $user, 200);
    }

    public function home()
    {
        $user   = auth()->user();
        $role   = Role::where('model_id', $user->id)->first();
        $role   = $role->role_id;
        $alamat = Alamat::where('user_id', $user->id)->get();
        $tanggal= Carbon::now()->toDateString();
        $saldo  = Saldo::where('user_id', $user->id)->first();
        if ($role == 6) {
            
            $permintaan = Permintaan::where('user_id', $user->id)->get();

            if (!$permintaan) {
                
            }
        } elseif ($role == 4) {
            $alamat_utama = Alamat::where('user_id', $user->id)->where('status', 1)->first();
            $permintaan = Permintaan::where('tanggal', $tanggal)->where('wilayah_id', $alamat_utama->wilayah_id)->get();
        } 
        
        return response()->json([
            'status'    =>  'success',
            'message'   =>  'Ini data Homenya',
            'data'      =>  $user,
            'alamat'    =>  $alamat,
            'role'      =>  $role,
            'permintaan'=>  $permintaan,
            'saldo'     =>  $saldo,
        ],200);
        // return $this->sendResponse('success', 'Data berhasi di tampilkan', $user, 200);
    }

}
