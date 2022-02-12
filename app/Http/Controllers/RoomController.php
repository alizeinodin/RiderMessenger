<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only('index', 'store');
    }

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
        $messages = $room->messages;
        $anonymousMessages = $room->anonymousMessages;

        $response = [
            'messages' => $messages,
            'anonymous_messages' => $anonymousMessages,
            'room' => $room
        ];

        return response($response, 200);
    }

    public function store(Request $request)
    {
        $room = auth()->user()->rooms()->create();

        $response = [
            'message' => 'room created successfully',
        ];

        return response($response, 201);
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Room $room)
    {
        $this->authorize('delete', $room);

        $room->delete();

        $response = [
            'message' => 'delete message was successful'
        ];
        return response($response, 200);

    }
}
