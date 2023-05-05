<?php

namespace Tests\Feature\Statement;

use Tests\TestCase;
use App\Models\Statement\Statement;
use Illuminate\Testing\TestResponse;
use App\Models\UserStatement\UserStatement;
use Database\Seeders\Statement\StatementSeeder;
use Tests\Feature\Statement\Classes\GetStatementJsonStructureKeys;

class IndexStatementTest extends TestCase
{
    protected function visitRoute(array $params = []): TestResponse
    {
        return $this->getJson('api/statements' . '?' . http_build_query($params));
    }

    public function test_it_can_get_statement()
    {
        $this->authorizeUser(self::ADMIN);

        $this->seed(StatementSeeder::class);

        $response = $this->visitRoute();

        $response->assertSuccessful();
        $response->assertJsonStructure([
            'data' => [
                '*' => GetStatementJsonStructureKeys::indexStatementJsonStructureKeys()
            ]
        ]);
    }

    public function test_it_can_get_statement_in_second_page()
    {
        $this->authorizeUser(self::ADMIN);

        $this->seed(StatementSeeder::class);

        $params = [
            'page' => 2,
            'perPage' => 10,
        ];

        $response = $this->visitRoute($params);

        $response->assertSuccessful();
        $response->assertJsonStructure([
            'data' => [
                '*' => GetStatementJsonStructureKeys::indexStatementJsonStructureKeys()
            ]
        ]);
    }

    public function test_it_can_get_statement_with_search_query()
    {
        $user = $this->authorizeUser(self::ADMIN);

        $params = [
            'query' => 'Hello World',
        ];

        Statement::factory()->create(['owner_id' => $user->id, 'title' => $params['query']])
            ->each(function (Statement $statement) {
                UserStatement::factory()->create([
                    'statement_id' => $statement->id,
                    'user_id' => $statement->owner_id,
                ]);
            });

        $response = $this->visitRoute($params);

        $response->assertSuccessful();

        $this->assertEquals('Hello World', $response->json('data.0.title'));

        $response->assertJsonStructure([
            'data' => [
                '*' => GetStatementJsonStructureKeys::indexStatementJsonStructureKeys()
            ]
        ]);
    }
}
