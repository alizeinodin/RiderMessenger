<?php

namespace App\Http\Controllers;

use App\Events\SendMessage;
use App\Models\AnonymousMessage;
use Illuminate\Http\Request;

class AnonymousMessageController extends Controller
{
    /**
     * save message in database
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $room = Room::find($request['room_id']);

        $message = AnonymousMessage::create([
            'content' => $request->input('content'),
            'ip' => $request->ip(),
            'room_id' => $room->id
        ]);

        $response = [
            'message' => 'message created successfully',
        ];

        event(new SendMessage($message->content));
        return response($response, 201);
    }

    public function show(AnonymousMessage $message)
    {
        $response = [
          'message' => $message,
          'room' => $message->room
        ];
        return response($response, 200);
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(AnonymousMessage $message, Request $request)
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

    public function destroy(AnonymousMessage $message)
    {
        $this->authorize('delete', $message->room);

        $message->delete();
        $response = [
            'message' => 'delete message was successful'
        ];
        return response($response, 200);
    }
}
