<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AnonymousMessagesTest extends TestCase
{
    use RefreshDatabase;

    private function actingAsUser()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        return $user;
    }

    private function makeRoomForUser()
    {
        $respnose = $this->postJson(route('rooms.store'));
    }

    private function makeUser()
    {
        return User::factory()->create();
    }

    private function sendMessage(): \Illuminate\Testing\TestResponse
    {
        $this->makeRoomForUser();

        $room = auth()->user()->rooms->last();
        auth()->user()->tokens()->delete();

        $data = [
            'content' => 'Test Anonymous Message',
            'room_id' => $room->id
        ];

        return $response = $this->postJson(route('anonymousMessages.store'), $data);
    }

    public function test_send_anonymous_message()
    {
        $this->actingAsUser();
        $response = $this->sendMessage();
        $response->assertStatus(201);
    }

    public function test_get_anonymous_messages()
    {
        $user = $this->actingAsUser();

        $response = $this->get(route('anonymousMessages.show', ['anonymousMessages' => $anonymousMessage]));
        $response->assertStatus(200);
    }
//
//    public function test_user_must_be_update_own_message()
//    {
//        $user = $this->makeUser();
//        $this->sendMessage($user);
//        $messages = auth()->user()->messages;
//
//        $this->actingAsUser();
//        $data = [
//            'content' => 'edit message'
//        ];
//        $response = $this->putJson(route('messages.update', ['message' => $messages->last()]), $data);
//        $response->assertStatus(403);
//    }
//
//    public function test_update_message()
//    {
//        $this->withoutExceptionHandling();
//
//        $this->test_send_message();
//        $messages = auth()->user()->messages;
//        $data = [
//            'content' => 'edit message'
//        ];
//        $response = $this->putJson(route('messages.update', ['message' => $messages->last()]), $data);
//        $response->assertStatus(200); // 200
//        $messages = Message::where('user_id', auth()->id())->get();
//        $this->assertEquals('edit message', $messages->last()->content);
//    }
//
//    public function test_get_messages_of_main_room()
//    {
//        $this->test_send_message();
//        $response = $this->getJson(route('rooms.show', ['room' => 1]));
//
//        $response->assertOk();
//        $data = $response->decodeResponseJson()['messages'];
//        $this->assertEquals('Test Message', $data[0]['content']);
//    }
//
//    public function test_users_must_be_delete_own_messages()
//    {
//        $user = $this->makeUser();
//        $this->sendMessage($user);
//        $messages = auth()->user()->messages;
//
//        $this->actingAsUser();
//
//        $response = $this->deleteJson(route('messages.destroy', ['message' => $messages->last()]));
//        $response->assertStatus(403);
//    }
//
//    public function test_delete_message()
//    {
//        $user = $this->makeUser();
//        $this->sendMessage($user);
//        $messages = auth()->user()->messages;
//
//        $response = $this->deleteJson(route('messages.destroy', ['message' => $messages->last()]));
//        $response->assertStatus(200);
//    }
}
