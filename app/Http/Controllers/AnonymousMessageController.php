<?php

namespace App\Http\Controllers;

use App\Events\SendMessage;
use App\Models\AnonymousMessage;
use App\Models\Room;
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
        $room = Room::find($request->input('room_id'));

        $message = $room->anonymousMessages()->create([
            'content' => $request->input('content'),
            'ip' => $request->ip(),
        ]);

        $response = [
            'message' => 'message created successfully',
        ];

        event(new SendMessage($message->content));
        return response($response, 201);
    }

    /**
     * @param AnonymousMessage $message
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function show(AnonymousMessage $message)
    {
        $this->authorize('show', $message);

        $response = [
          'message' => $message,
          'room' => $message->room
        ];
        return response($response, 200);
    }

    /**
     * @param AnonymousMessage $message
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(AnonymousMessage $message, Request $request)
    {
        $this->authorize('update', $message, $request);
        $message->update([
            'content' => $request->input('content'),
        ]);

        $response = [
            'message' => 'edit message was successful'
        ];
        return response($response, 200);
    }

    /**
     * @param AnonymousMessage $message
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
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
