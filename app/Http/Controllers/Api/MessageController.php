<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Message;
use App\Model\Role;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;


class MessageController extends Controller
{
    public function getMessage($my_id)
    {
        $user_id  = Auth::id();

        $message = Message::where(function ($query) use ($user_id, $my_id) {
            $query
                ->where('from', $my_id)
                ->where('to', $user_id);
        })->orWhere(function ($query) use ($user_id, $my_id) {
            $query
                ->where('from', $user_id)
                ->where('to', $my_id);
        })->get();

        $messageMe = Message::where(function ($query) use ($user_id, $my_id) {
            $query
            ->where('from', $my_id)
            ->where('to', $user_id);
        })->get();
        // dd($messageMe);
        $messageMe->is_read = 1;
        $messageMe->update();

        if (!$message) {
            return $this->sendResponse('error', 'Pesan tidak ada', NULL, 404);
        }
        return $this->sendResponse('success', 'Ini Pesannya', $message, 200);
    }



    public function sendMessage(Request $request, $id)
    {
        $from   = auth()->user();
        $to     = $id;
        $message = $request->message;

        $data   = new Message();
        $data   = Message::create([
            'from'      => $from->id,
            'to'        => $to,
            'message'   => $message,
            'is_read'      => 0,
        ]);

        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher(
            '594d7839a80853fb4e7b',
            '6f50e033e2df64a669f1',
            '1140609',
            $options
        );

        $data = ['from' => $from, 'to' => $to];
        $pusher->trigger('my-channel', 'my-event', $data);

        return $this->sendResponse('success', 'berhasil dikirim', $data, 200);
    }

    public function addindexNasabah()
    {
        $user = auth()->user();

        // $from  = DB::select(users.id)
        $role = Role::where('model_id', '!=', $user->id)->where('role_id', 3)->with('user')->get();

        // foreach ($role as $users) {
        //     $kontak = User::where('id', $users->model_id)->all();

        // }
        // $kontaks = $kontak->get();
        return $this->sendResponse('success', 'this kontak Costumer Service for Nasabah', $role, 200);;
    }

    public function addindexCs()
    {
        $user = auth()->user();

        // $from  = DB::select(users.id)
        $role = Role::where('model_id', '!=', $user->id)->where('role_id', 6)->with('user')->get();

        // foreach ($role as $users) {
        //     $kontak = User::where('id', $users->model_id)->all();

        // }
        // $kontaks = $kontak->get();
        return $this->sendResponse('success', 'this kontak Nasabah for Costumer Service', $role, 200);;
    }

    public function indexKontak()
    {
        $user = auth()->user();

        $from = User::select('users.id', 'users.name', 'users.avatar')->distinct()
            ->join('messages', 'users.id', '=', 'messages.from')
            ->where('users.id', '!=', $user->id)
            ->where('messages.to', '=', $user->id)    
            ->get()->toArray();

        $to   = User::select('users.id', 'users.name', 'users.avatar')->distinct()
            ->join('messages', 'users.id', '=', 'messages.to')
            ->where('users.id', '!=', $user->id)
            ->where('messages.from', '=', $user->id)    
            ->get()->toArray();

        $data = array_merge($from, $to);
        
        $data = array_unique($data, SORT_REGULAR);
        $kontak = array_values($data);


        return response()->json([
            'status'    => 'success',
            'message'   => 'ini kontaknya',
            'data'      => $kontak,
        ]);
    }

}
