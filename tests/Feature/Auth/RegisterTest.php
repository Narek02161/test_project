<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Events\User\RegisterEvent;
use Illuminate\Testing\TestResponse;
use Illuminate\Support\Facades\Event;
use Tests\Feature\Auth\Classes\AssertErrorJsonStructureKeys;

class RegisterTest extends TestCase
{
    public function visitRoute(array $params): TestResponse
    {
        return $this->postJson('api/auth/register', $params);
    }

    public function test_it_can_not_register_with_out_password()
    {
        $data = [
            'email' => $this->faker->email,
            'display_name' => $this->faker->name,
            'language' => $this->faker->languageCode,
            'telegram_username' => '@test',
        ];

        $response = $this->visitRoute($data);

        $response->assertUnprocessable();
        $response->assertJsonStructure(resolve(AssertErrorJsonStructureKeys::class)->run());
        $response->assertJsonPath('errors.message', 'The password field is required.');
    }

    public function test_it_can_not_register_with_out_email()
    {
        $data = [
            'password' => '12345',
            'display_name' => $this->faker->name,
            'language' => $this->faker->languageCode,
            'telegram_username' => '@test',
        ];

        $response = $this->visitRoute($data);

        $response->assertUnprocessable();
        $response->assertJsonStructure(resolve(AssertErrorJsonStructureKeys::class)->run());
        $response->assertJsonPath('errors.message', 'The email field is required.');
    }

    public function test_it_can_not_register_with_less_than_five_characters()
    {
        $data = [
            'password' => '123',
            'email' => $this->faker->email,
            'display_name' => $this->faker->name,
            'language' => $this->faker->languageCode,
            'telegram_username' => '@test',
        ];

        $response = $this->visitRoute($data);

        $response->assertUnprocessable();
        $response->assertJsonStructure(resolve(AssertErrorJsonStructureKeys::class)->run());
        $response->assertJsonPath('errors.message', 'The password must be at least 5 characters.');
    }

    public function test_it_can_register_success()
    {
        Event::fake();

        $data = [
            'password' => '123456',
            'email' => $this->faker->email,
            'telegram_username' => '@test',
            'display_name' => $this->faker->name,
            'language' => $this->faker->languageCode,
        ];

        $response = $this->visitRoute($data);
        $response->assertSuccessful();

        $this->assertDatabaseHas('users', [
            'email' => $data['email'],
            'display_name' => $data['display_name'],
            'telegram_username' => $data['telegram_username'],
        ]);

        $this->assertDatabaseHas('teams', [
            'name' => $data['email'],
        ]);

        $data = $response->json('data');

        $this->assertArrayHasKey('access_token', $data);
        $this->assertArrayHasKey('refresh_token', $data);
        $this->assertArrayHasKey('expires_in', $data);
        $this->assertArrayHasKey('user', $data);

        Event::assertDispatched(RegisterEvent::class, 1);
    }
}
