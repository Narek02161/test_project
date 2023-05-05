<?php

namespace Database\Seeders\UserRoles;

use App\Models\UserRole;
use Illuminate\Database\Seeder;
use App\Enum\UserRoles\UserRoles;

class UserRolesSeeder extends Seeder
{
    public function run(): void
    {
        foreach (UserRoles::values() as $role) {
            UserRole::factory()->create([
                'name' => $role
            ]);
        }
    }
}
