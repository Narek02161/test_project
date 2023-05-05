<?php

namespace Database\Seeders\User;

use App\Models\User;
use App\Models\UserRole;
use App\Models\Team\Team;
use Illuminate\Database\Seeder;
use App\Enum\UserRoles\UserRoles;
use App\Repositories\Write\User\UserWriteRepositoryInterface;
use App\Repositories\Read\UserRole\UserRoleReadRepositoryInterface;

class UserSeeder extends Seeder
{
    private Team $team;

    public function __construct(
        private readonly UserWriteRepositoryInterface $userWriteRepository,
        protected readonly UserRoleReadRepositoryInterface $userRoleReadRepository,
    ) {
    }

    public function run(): void
    {
        // GET ALL USER ROLES
        $roles = $this->userRoleReadRepository->getAll(['permissions']);

        // CLIENT USER
        $clientUser = User::factory()->create([
            'email' => 'clientuser@gmail.com',
            'password' => bcrypt(123456),
        ]);

        $clientRole = $roles->where('name', UserRoles::CLIENT->value)->first();
        $this->assignUserRole($clientUser, $clientRole);
        $this->createTeam($clientUser);
        $this->attachUserTeam($clientUser, $this->team->id, $clientRole->id);

        // ADMIN USER
        $adminUser = User::factory()->create([
            'email' => 'adminuser@gmail.com',
            'password' => bcrypt(123456),
        ]);

        $adminRole = $roles->where('name', UserRoles::ADMIN->value)->first();
        $this->assignUserRole($adminUser, $adminRole);
        $this->createTeam($adminUser);
        $this->attachUserTeam($adminUser, $this->team->id, $clientRole->id);
    }

    private function assignUserRole(User $user, UserRole $role): void
    {
        $user->assignRole($role);
    }

    private function createTeam(User $user): void
    {
        $this->team = Team::factory()->create([
            'name' => $user->email,
            'founder_id' => $user->id,
        ]);
    }

    private function attachUserTeam(User $user, int $teamId, int $roleId): void
    {
        $this->userWriteRepository->attachUserTeam($user, $teamId, $roleId);
    }
}
