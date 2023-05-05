<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\User\UserSeeder;
use Database\Seeders\UserRoles\UserRolesSeeder;
use Database\Seeders\Statement\StatementSeeder;
use Database\Seeders\StatementPermission\StatementPermissionSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserRolesSeeder::class,
            StatementPermissionSeeder::class,
            UserSeeder::class,
            StatementSeeder::class,
        ]);
    }
}
