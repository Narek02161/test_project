<?php

namespace Tests\Feature\Statement;

use Tests\TestCase;
use App\Models\Statement\Statement;
use Illuminate\Testing\TestResponse;
use App\Exceptions\BusinessLogicException;
use App\Models\UserStatement\UserStatement;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DeleteStatementTest extends TestCase
{
    public function visitRoute(int $id): TestResponse
    {
        return $this->deleteJson('api/statements/' . $id);
    }

    public function test_it_can_not_delete_statement_when_statement_from_another_user()
    {
        $user = $this->authorizeUser(self::ADMIN);

        $statementId = $this->createStatement($user->id + 1);

        $response = $this->visitRoute($statementId);

        $response->assertJsonPath('status', ResponseAlias::HTTP_FORBIDDEN);
        $response->assertJsonPath('errors.message', 'Access denied for modifying statement');
    }

    public function test_it_can_not_update_statement_with_wrong_statement_id()
    {
        $user = $this->authorizeUser(self::ADMIN);

        $statementId = $this->createStatement($user->id);

        $response = $this->visitRoute($statementId + 1);

        $response->assertJsonPath('status', BusinessLogicException::STATEMENT_NOT_FOUND);
        $response->assertJsonPath('errors.message', 'Statement is not found');
    }

    public function test_it_can_delete_success()
    {
        $user = $this->authorizeUser(self::ADMIN);

        $statementId = $this->createStatement($user->id);

        $response = $this->visitRoute($statementId);

        $response->assertSuccessful();
        $response->assertJsonFragment(['success' => true]);
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
