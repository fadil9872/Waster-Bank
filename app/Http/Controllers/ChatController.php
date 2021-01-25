<?php

namespace App\Http\Controllers;

use App\Model\User;
use App\Room;
use App\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function chat(Request $request, $user_id) {
        if ($user_id == Auth::id()) {
            return $this->sendResponse('error', 'Kamu gak bisa chat dengan diri sendiri', NULL, 400);
        }

        $user = User::findOrFail($user_id);

        $room = Room::where('participant', function($q) {
            $q->where('user_id', Auth::id());
        })->with(['participant' => function($q) use ($user_id) {
            $q->where('user_id', $user_id);
        }]);

        if (is_null($room->first()->participant()->first())) {
            $room = null;
        } else {
            $room = $room->first()->id;
        }

        $room = Room::firstOrCreate(['id'   => $room], 
                                    ['name' => auth()->user() . ' - ' . $user->name]);

        $participants = [Auth::id(), $user_id];

        foreach ($participants as $participant) {
            $room->participant()->firstOrCreate([
                'user_id'   => $participant,
                'room_id'   => $room->id,   
            ]);
        }

        return $this->sendResponse('success', 'Room Berhasil dibuat', $room->id, 200);
    }

    public function showContact() {
        $room = Room::whereHas('participant', function($q) {
            $q->where('user_id', Auth::id());
        })->with(['participant' => function($q) {
            $q->where('user_id', '!=', Auth::id());
        }])->get();

        return $this->sendResponse('success', 'ini kontak penguna yang ikut', $room, 200);
    }

    public function getMessage($room_id) {
        // $me
    }
}
