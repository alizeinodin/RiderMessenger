<?php

namespace Tests\Feature;

use App\Http\Controllers\RoomController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Repository\HelperFunctions;
use Tests\TestCase;


class RoomTest extends TestCase
{
    use RefreshDatabase;

    private function help(): HelperFunctions
    {
        return $helper = new HelperFunctions();
    }

    public function test_show_all_rooms_for_user_which_not_logged_in()
    {
        $respnose = $this->getJson(route('rooms.index'));
        $respnose->assertStatus(401);
    }

    public function test_show_all_rooms()
    {
        $this->help()->actingAsUser();

        $respnose = $this->getJson(route('rooms.index'));
        $respnose->assertStatus(200);
    }

    public function test_create_room_for_user_which_not_logged_in()
    {
        $respnose = $this->postJson(route('rooms.store'));
        $respnose->assertStatus(401);
    }

    public function test_create_room()
    {
        $this->help()->actingAsUser();

        $respnose = $this->postJson(route('rooms.store'));
        $respnose->assertStatus(201);
    }

    public function test_destroy_room_for_user_which_not_logged_in()
    {
        $respnose = $this->deleteJson(route('rooms.destroy', ['room' => 1]));
        $respnose->assertStatus(401);
    }

    public function test_destroy_room()
    {
        $user = $this->help()->actingAsUser();
        $this->postJson(route('rooms.store'));
        $room = $user->rooms->last();

        $respnose = $this->deleteJson(route('rooms.destroy', ['room' => $room]));
        $respnose->assertStatus(200);

    }

    public function test_show_room()
    {
        $user = $this->help()->actingAsUser();
        $this->postJson(route('rooms.store'));
        $room = $user->rooms->last();

        $respnose = $this->getJson(route('rooms.show', ['room' => $room]));
        $respnose->assertStatus(200);
    }
}
