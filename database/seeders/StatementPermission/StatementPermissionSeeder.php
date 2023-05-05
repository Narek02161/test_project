<?php

namespace Database\Seeders\StatementPermission;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use App\Enum\StatementPermission\StatementPermission;

class StatementPermissionSeeder extends Seeder
{
    public function run(): void
    {
        foreach (StatementPermission::values() as $permission) {
            Permission::query()->create([
                'name' => $permission,
                'guard_name' => Config::get('auth.defaults.guard'),
            ]);
        }
    }
}
