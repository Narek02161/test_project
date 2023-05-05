<?php

namespace Tests\Feature\Statement;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Testing\TestResponse;
use Tests\Feature\Statement\Classes\GetStatementJsonStructureKeys;

class CreateStatementTest extends TestCase
{
    public function visitRoute(array $params): TestResponse
    {
        return $this->postJson('api/statements', $params);
    }

    public function test_it_can_not_create_statement_without_title()
    {
        $this->authorizeUser(self::ADMIN);

        $data = [
            'author_name' => $this->faker->name,
            'description' => $this->faker->text,
            'source_title' => $this->faker->url,
            'source_url' => $this->faker->imageUrl,
            'date_published' => Carbon::now('UTC'),
            'is_published' => $this->faker->randomElement([true, false]),
        ];

        $response = $this->visitRoute($data);

        $response->assertUnprocessable();
        $response->assertJsonPath('errors.message', 'The title field is required.');
    }

    public function test_it_can_not_create_statement_without_author_name()
    {
        $this->authorizeUser(self::ADMIN);

        $data = [
            'title' => $this->faker->title,
            'description' => $this->faker->text,
            'source_title' => $this->faker->url,
            'source_url' => $this->faker->imageUrl,
            'date_published' => Carbon::now('UTC'),
            'is_published' => $this->faker->randomElement([true, false]),
        ];

        $response = $this->visitRoute($data);

        $response->assertUnprocessable();
        $response->assertJsonPath('errors.message', 'The author name field is required.');
    }

    public function test_it_can_not_create_statement_without_date_published()
    {
        $this->authorizeUser(self::ADMIN);

        $data = [
            'title' => $this->faker->title,
            'author_name' => $this->faker->name,
            'description' => $this->faker->text,
            'source_title' => $this->faker->url,
            'source_url' => $this->faker->imageUrl,
            'is_published' => $this->faker->randomElement([true, false]),
        ];

        $response = $this->visitRoute($data);

        $response->assertUnprocessable();
        $response->assertJsonPath('errors.message', 'The date published field is required.');
    }

    public function test_it_can_create_statement_success()
    {
        $user = $this->authorizeUser(self::ADMIN);

        $data = [
            'title' => $this->faker->title,
            'author_name' => $this->faker->name,
            'description' => $this->faker->text,
            'source_title' => $this->faker->url,
            'source_url' => $this->faker->imageUrl,
            'date_published' => Carbon::now('UTC'),
            'is_published' => $this->faker->randomElement([true, false]),
        ];

        $response = $this->visitRoute($data);

        $response->assertSuccessful();

        $this->assertDatabaseHas('statements', [
            'owner_id' => $user->id,
            'source_url' => $data['source_url'],
            'description' => $data['description'],
            'source_title' => $data['source_title'],
            'is_published' => $data['is_published'],
        ]);

        $response->assertJsonStructure([
            'data' => GetStatementJsonStructureKeys::createStatementJsonStructureKeys()
        ]);
    }
}
