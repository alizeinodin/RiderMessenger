<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * return all rooms of user
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = auth()->user()->rooms;
        return response(json_encode($rooms), 200);
    }

    public function show(Room $room)
    {
        return response($room, 200);
    }

    public function store(Request $request)
    {
        $room = auth()->user()->rooms()->create([
            'link' => $request['name']
        ]);

        $response = [
            'message' => 'room created successfully',
        ];

        return response($response, 201);
    }

    public function destory(Room $room)
    {
        $room->delete();

        $response = [
            'message' => 'delete message was successful'
        ];
        return response($response, 200);

    }
}
