<?php

namespace Tests;

use App\Models\User;
use Database\Mocks\Users\UserDto;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use WithFaker;
    use CreatesApplication;
    use DatabaseTransactions;

    protected UserDto $adminUser;
    protected UserDto $clientUser;

    public const ADMIN = 'admin';
    public const CLIENT = 'client';

    public function setUp(): void
    {
        parent::setUp();
        $this->initUser(self::ADMIN);
        $this->initUser(self::CLIENT);
    }

    public function authorizeUser(string $role)
    {
        $user = $this->initUser($role);
        $userModel = User::make($user->toArray());
        $userModel->id = $user->id;
        $this->be($userModel);
        return $userModel;
    }

    public function initUser(string $role)
    {
        $filePath = base_path('database/mocks/credentials.json');
        $file = file_get_contents($filePath);
        $credentials = json_decode($file, true)['users'];
        $classNameKey = ucfirst($role) . 'User';
        $credential = $credentials[$classNameKey];
        $className = 'Database\Mocks\Users\\' . ucfirst($role) . 'User';
        $propertyName = "{$role}User";
        $user = new $className($credential);
        $this->$propertyName = $user->dto;
        return $this->$propertyName;
    }
}
