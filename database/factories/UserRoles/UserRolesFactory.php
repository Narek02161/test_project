<?php

namespace Database\Factories\UserRoles;

use App\Models\UserRole;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserRolesFactory extends Factory
{
    protected $model = UserRole::class;

    public function definition(): array
    {
        return [
            'guard_name' => Config::get('auth.defaults.guard')
        ];
    }
}
