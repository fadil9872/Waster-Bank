<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Role;
use App\Model\User;
use App\Model\Saldo;
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
        $role   = Role::where('model_id', $user->id)->first();
        $role   = $role->role_id;

        return response()->json(compact('token', 'user', 'role'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'alamat' => 'required|string|max:255',
            'no_telpon' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name'      =>  $request->get('name'),
            'email'     =>  $request->get('email'),
            'password'  =>  Hash::make($request->get('password')),
            'alamat'    =>  $request['alamat'],
            'no_telpon' =>  $request['no_telpon'],
            'avatar'    =>  'https:\/\/iili.io\/FVdLas.png',
        ]);
        $user->assignRole('nasabah');

        //cek user yang sudah di buat tadi
        $old_user = User::where('email', $request->email)->first();

        $saldo = Saldo::create([
            'user_id'       =>  $old_user->id,
            'saldo'         =>  '0',
        ]);
        $role   = Role::where('model_id', $old_user->id)->first();
        $role   = $role->role_id;

        $token  = JWTAuth::fromUser($user);


        // $accessToken = $user->createToken('authToken')->accessToken;

        // return response(['user'=> $user, 'access_token'=> $accessToken]);

        return response()->json(compact('old_user', 'token', 'role'), 201);
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

        $users = User::where('id', $user->id)->first();

        $name   = $users->name;
        if ($request->name) {
            $name = $request->name;
        }
        $alamat = $users->alamat;
        if ($request->alamat) {
            $alamat = $request->alamat;
        }
        $no_telpon = $users->no_telpon;
        if ($request->no_telpon) {
            $no_telpon = $request->no_telpon;
        }
        $avatar = $users->avatar;
        if ($request->avatar) {
            $img = base64_encode(file_get_contents($request->avatar));

            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', 'https://freeimage.host/api/1/upload', [
                'form_params' => [
                    'key' => '6d207e02198a847aa98d0a2a901485a5',
                    'action' => 'upload',
                    'source' => $img,
                    'format' => 'json'
                ]
            ]);
            $arr = json_decode($response->getBody()->getContents());
            $avatar = $arr->image->file->resource->chain->image;
        }
        $password = $user->password;
        if ($request->password) {
            $password = Hash::make($request->get('password'));
        }

        $users->update([
            'name'      =>  $name,
            'alamat'    =>  $alamat,
            'no_telpon' =>  $no_telpon,
            'avatar'    =>  $avatar,
            'password'  =>  $password,
        ]);


        return $this->sendResponse('success', 'Ini Datanya', $users, 200);
    }
}
