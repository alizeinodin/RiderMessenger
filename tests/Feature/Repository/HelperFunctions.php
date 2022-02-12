<?php

namespace Tests\Feature\Repository;

use App\Models\Room;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class HelperFunctions
{
    public function actingAsUser()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        return $user;
    }

    public function makeMainRoom()
    {
        Room::factory()->create();
    }

    public function makeUser()
    {
        return User::factory()->create();
    }

    public function sendMessage($user)
    {
        Sanctum::actingAs($user);
        $this->makeMainRoom();

        $data = [
            'content' => 'Test Message'
        ];
        return $response = $this->postJson('api/messages', $data);
    }
}
