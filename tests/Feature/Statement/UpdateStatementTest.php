<?php

namespace Tests\Feature\Statement;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Statement\Statement;
use Illuminate\Testing\TestResponse;
use App\Exceptions\BusinessLogicException;
use App\Models\UserStatement\UserStatement;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\Feature\Statement\Classes\GetStatementJsonStructureKeys;

class UpdateStatementTest extends TestCase
{
    public function visitRoute(array $params, int $id): TestResponse
    {
        return $this->patchJson('api/statements/' . $id, $params);
    }

    public function test_it_can_not_update_statement_without_title()
    {
        $user = $this->authorizeUser(self::ADMIN);

        $statementId = $this->createStatement($user->id);

        $data = [
            'author_name' => $this->faker->name,
            'description' => $this->faker->text,
            'source_title' => $this->faker->url,
            'source_url' => $this->faker->imageUrl,
            'date_published' => Carbon::now('UTC'),
            'is_published' => $this->faker->randomElement([true, false]),
        ];

        $response = $this->visitRoute($data, $statementId);

        $response->assertUnprocessable();
        $response->assertJsonPath('errors.message', 'The title field is required.');
    }

    public function test_it_can_not_update_statement_when_statement_from_another_user()
    {
        $user = $this->authorizeUser(self::ADMIN);

        $statementId = $this->createStatement($user->id + 1);

        $data = [
            'author_name' => $this->faker->name,
            'description' => $this->faker->text,
            'source_title' => $this->faker->url,
            'source_url' => $this->faker->imageUrl,
            'date_published' => Carbon::now('UTC'),
            'is_published' => $this->faker->randomElement([true, false]),
        ];

        $response = $this->visitRoute($data, $statementId);

        $response->assertJsonPath('status', ResponseAlias::HTTP_FORBIDDEN);
        $response->assertJsonPath('errors.message', 'Access denied for modifying statement');
    }

    public function test_it_can_not_update_statement_with_wrong_statement_id()
    {
        $user = $this->authorizeUser(self::ADMIN);

        $statementId = $this->createStatement($user->id);

        $data = [
            'title' => $this->faker->title,
            'author_name' => $this->faker->name,
            'description' => $this->faker->text,
            'source_title' => $this->faker->url,
            'source_url' => $this->faker->imageUrl,
            'date_published' => Carbon::now('UTC'),
            'is_published' => $this->faker->randomElement([true, false]),
        ];

        $response = $this->visitRoute($data, $statementId + 1);
        $response->assertJsonPath('status', BusinessLogicException::STATEMENT_NOT_FOUND);
        $response->assertJsonPath('errors.message', 'Statement is not found');
    }

    public function test_it_can_update_success()
    {
        $user = $this->authorizeUser(self::ADMIN);

        $statementId = $this->createStatement($user->id);

        $data = [
            'title' => $this->faker->title,
            'author_name' => $this->faker->name,
            'description' => $this->faker->text,
            'source_title' => $this->faker->url,
            'source_url' => $this->faker->imageUrl,
            'date_published' => Carbon::now('UTC'),
            'is_published' => $this->faker->randomElement([true, false]),
        ];

        $response = $this->visitRoute($data, $statementId);

        $response->assertSuccessful();

        $response->assertJsonStructure([
            'data' => GetStatementJsonStructureKeys::indexStatementJsonStructureKeys()
        ]);

        $this->assertDatabaseHas('statements', [
            'owner_id' => $user->id,
            'source_url' => $data['source_url'],
            'author_name' => $data['author_name'],
            'description' => $data['description'],
            'source_title' => $data['source_title'],
            'is_published' => $data['is_published'],
            'date_published' => $data['date_published'],
        ]);
    }

    private function createStatement(int $userId): ?int
    {
        $statement = Statement::factory()
            ->create(['owner_id' => $userId]);

        UserStatement::factory()->create([
            'user_id' => $userId,
            'statement_id' => $statement->id ?? 1,
        ]);

        return $statement->id ?? 1;
    }
}
