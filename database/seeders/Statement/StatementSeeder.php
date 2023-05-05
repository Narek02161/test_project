<?php

namespace Database\Seeders\Statement;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Statement\Statement;
use App\Models\UserStatement\UserStatement;

class StatementSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::query()->limit(10)->get();

        foreach ($users as $user) {
            Statement::factory()->count(10)
                ->create(['owner_id' => $user->id])
                ->each(function (Statement $statement) {
                    UserStatement::factory()->create([
                        'statement_id' => $statement->id,
                        'user_id' => $statement->owner_id,
                    ]);
                });
        }
    }
}
