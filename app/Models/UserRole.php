<?php

namespace App\Models;

use Spatie\Permission\Models\Role;
use Database\Factories\UserRoles\UserRolesFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserRole extends Role
{
    use HasFactory;

    public static function newFactory(): UserRolesFactory
    {
        return new UserRolesFactory();
    }
}
