<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Events\SendMessage;

class MessageController extends Controller
{
    /**
     * for use message section
     * user must be logged in
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * get all messages
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index()
    {
        $messages = auth()->user()->messages;
        return response(json_encode($messages), 200);
    }

    /**
     * save message in database
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $room = Room::find($request['room_id'] ?? 1);

        $message = $user->messages()->create([
            'content' => $request->input('content'),
            'room_id' => $room->id
        ]);

        $response = [
          'message' => 'message created successfully',
        ];

        event(new SendMessage($message->content));
        return response($response, 201);
    }

    public function show(Message $message)
    {
        return response($message, 200);
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Message $message, Request $request)
    {
        $this->authorize('update', $message);
        $message->update([
           'content' => $request->input('content'),
        ]);

        $response = [
          'message' => 'edit message was successful'
        ];
        return response($response, 200);
    }

    public function destroy(Message $message)
    {
        $this->authorize('delete', $message);

        $message->delete();
        $response = [
            'message' => 'delete message was successful'
        ];
        return response($response, 200);
    }
}
