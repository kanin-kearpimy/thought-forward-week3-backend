<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Participant;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function AllEvent(){
        try {
            $events = Event::get();
            return response()->json([
                'status' => 200,
                'data' => $events,
            ], 200);
        }catch (\Exception $error){
            return response()->json([
                'status' => 400,
                'error' => $error->getMessage()
            ], 400);
        }
    }

    public function RegisterEvent(Request $request){
        $user_id  = $request->input('user_id');
        $event_id = $request->input('event_id');
        $insert_obj = [
            'event_id' => $event_id,
            'user_id' => $user_id
        ];
        try {
            Participant::insert($insert_obj);
            return response()->json([
                'status' => 200,
                'data' => [],
                'message' => 'Successfully book your seat in event.'
            ], 200);
        }catch (\Exception $error){
            return response()->json([
                'status' => 400,
                'error' => $error->getMessage()
            ], 400);
        }
    }

    public function FetchParticipant($event_id){
        try {
            $participants = Participant::where('event_id', $event_id)
            ->join('users', 'participants.idparticipants', '=', 'users.iduser')
            ->get();
            return response()->json([
                'status' => 200,
                'data' => $participants,
            ], 200);
        }catch (\Exception $error){
            return response()->json([
                'status' => 400,
                'error' => $error->getMessage()
            ], 400);
        }
    }
}
