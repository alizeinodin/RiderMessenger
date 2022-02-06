<?php

    namespace Tests\Feature;

    use App\Models\Message;
    use App\Models\User;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Illuminate\Support\Facades\URL;
    use Laravel\Sanctum\Sanctum;
    use Tests\TestCase;

    class MesssageTest extends TestCase
    {
        use RefreshDatabase;

        private function actingAsUser()
        {
            $user = User::factory()->create();
            Sanctum::actingAs($user);

            return $user;
        }

        private function makeUser()
        {
            return User::factory()->create();
        }

        private function sendMessage($user)
        {
            Sanctum::actingAs($user);

            $data = [
                'content' => 'Test Message'
            ];
            return $response = $this->postJson('api/messages', $data);
        }

        public function test_user_must_be_authenticated_for_use_message()
        {
            $data = [];
            $response = $this->get(route('messages.index')); // for read
            $response->assertStatus(302);

            $response = $this->postJson(route('messages.store'), $data); // for write
            $response->assertStatus(401);

            $message = Message::factory()->make();

            $response = $this->putJson("api/messages/{$message}", $data); // for update
            $response->assertStatus(401);

            $response = $this->deleteJson("api/messages/{$message}"); // for delete
            $response->assertStatus(401);
        }

        public function test_send_message()
        {
            $response = $this->sendMessage($this->makeUser());
            $response->assertStatus(201);
        }

        public function test_get_messages()
        {
            $this->actingAsUser();

            $response = $this->get(route('messages.index'));
            $response->assertStatus(200);
        }

        public function test_user_must_be_update_own_message()
        {
            $user = $this->makeUser();
            $this->sendMessage($user);
            $messages = auth()->user()->messages;

            $this->actingAsUser();
            $data = [
                'content' => 'edit message'
            ];
            $response = $this->putJson(route('messages.update', ['message' => $messages->last()]), $data);
            $response->assertStatus(403);
        }

        public function test_update_message()
        {
            $this->withoutExceptionHandling();

            $this->test_send_message();
            $messages = auth()->user()->messages;
            $data = [
                'content' => 'edit message'
            ];
            $response = $this->putJson(route('messages.update', ['message' => $messages->last()]), $data);
            $response->assertStatus(200); // 200
            $messages = Message::where('user_id', auth()->id())->get();
            $this->assertEquals('edit message', $messages->last()->content);
        }

        public function test_users_must_be_delete_own_messages()
        {
            $user = $this->makeUser();
            $this->sendMessage($user);
            $messages = auth()->user()->messages;

            $this->actingAsUser();

            $response = $this->deleteJson(route('messages.destroy', ['message' => $messages->last()]));
            $response->assertStatus(403);
        }

        public function test_delete_message()
        {
            $user = $this->makeUser();
            $this->sendMessage($user);
            $messages = auth()->user()->messages;

            $response = $this->deleteJson(route('messages.destroy', ['message' => $messages->last()]));
            $response->assertStatus(200);
        }
    }
