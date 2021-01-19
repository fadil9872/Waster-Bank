<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function getMessage() {
        $users  = Auth::id();

        $message = Message::where(function ($query) use ($user_id, $my_id) {
                $query
                ->where('from', $my_id)
                ->where('to', $user_id);
        })->orWhere(function ($query) use ($user_id, $my_id) {
                $query
                ->where('from', $user_id)
                ->where('to', $my_id);
        })->get();

        if (! $message) {
            return $this->sendResponse('error', 'Pesan tidak ada', NULL, 404);
        }
        return $this->sendResponse('success', 'Ini Pesannya', $message, 200);
    }

    

    public function sendMessage() {
            $from   = auth()->user();
            $to     = $request->receiver_id;
            $message= $request->message;
    
            $data   = new Message(); 
            $data   = Message::create([
                'from'      => $from,
                'to'        => $to,
                'message'   => $message,
                'data'      => 0,
            ]);

            $options = array(
                'cluster' => 'ap1',
                'useTLS' => true
              );
              $pusher = new Pusher\Pusher(
                '594d7839a80853fb4e7b',
                '6f50e033e2df64a669f1',
                '1140609',
                $options
              );
            
              $data = ['from' => $from, 'to' => $to];
              $pusher->trigger('my-channel', 'my-event', $data);
    }

    public function indexNasabah() {
        
    }
}