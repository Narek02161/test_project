<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use App\Events\User\LogoutEvent;
use Illuminate\Testing\TestResponse;
use Illuminate\Support\Facades\Event;
use App\Exceptions\BusinessLogicException;

class LoginTest extends TestCase
{
    public function visitRoute(array $params): TestResponse
    {
        return $this->postJson('api/auth/login', $params);
    }

    public function test_it_can_login_success()
    {
        Event::fake();

        $data = [
            'email' => $this->faker->email,
            'password' => $this->faker->password,
        ];

        User::factory()->create([
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT),
        ]);

        $response = $this->visitRoute($data);
        $response->assertSuccessful();
        $data = $response->json('data');

        $this->assertArrayHasKey('access_token', $data);
        $this->assertArrayHasKey('refresh_token', $data);
        $this->assertArrayHasKey('expires_in', $data);
        $this->assertArrayHasKey('token_type', $data);

        Event::assertDispatched(LogoutEvent::class, 1);
    }

    public function test_it_can_not_login_with_wrong_user_email()
    {
        $data = [
            'email' => $this->faker->email,
            'password' => $this->faker->password,
        ];

        User::factory()->create([
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT),
        ]);

        $data['email'] .= $data['email'];

        $response = $this->visitRoute($data);
        $response->assertJsonPath('status', BusinessLogicException::USER_NOT_FOUND);
        $response->assertJsonPath('errors.message', 'User not found');
    }

    public function test_it_can_not_login_with_wrong_password()
    {
        $data = [
            'email' => $this->faker->email,
            'password' => $this->faker->password,
        ];

        User::factory()->create([
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT),
        ]);

        $data['password'] .= $data['password'];

        $response = $this->visitRoute($data);
        $response->assertJsonPath('errors.message', 'The user credentials were incorrect.');
    }
}
