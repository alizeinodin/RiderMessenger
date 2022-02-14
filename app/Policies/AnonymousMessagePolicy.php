<?php

namespace App\Policies;

use App\Models\AnonymousMessage;
use App\Models\Room;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;

class AnonymousMessagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param AnonymousMessage $message
     * @param Request $request
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(AnonymousMessage $message, Request $request)
    {
        return $message->ip == $request->ip();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Room $room)
    {
        return $user->id == $room->user_id;
    }
}
