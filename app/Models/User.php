<?php

namespace App\Models;

use App\Models\Team\Team;
use Laravel\Passport\HasApiTokens;
use App\Models\Statement\Statement;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Services\User\Dto\CreateUserDTO;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string|null $display_name
 * @property string|null $telegram_username
 * @property string $password
 * @property mixed $id
 * @property string $email
 * @property string $language
 */
class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use HasApiTokens;
    use HasRoles;

    protected $fillable = [
        'email',
        'password',
        'display_name',
        'telegram_username',
        'language',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function createUser(CreateUserDTO $dto): User
    {
        $user = new self();

        $user->setUsername($dto->email);
        $user->setPassword($dto->password);
        $user->setDisplayName($dto->displayName);
        $user->setTelegramUsername($dto->telegramUsername);
        $user->setLanguage($dto->language);

        return $user;
    }

    public function setUsername(string $email): void
    {
        $this->email = $email;
    }

    public function setDisplayName(?string $displayName): void
    {
        $this->display_name = $displayName;
    }

    public function setTelegramUsername(?string $telegramUsername): void
    {
        $this->telegram_username = $telegramUsername;
    }

    public function setPassword(string $password): void
    {
        $this->password = bcrypt($password);
    }

    public function setLanguage(?string $language): void
    {
        $this->language = $language;
    }

    public function team(): BelongsToMany
    {
        return $this->belongsToMany(
            Team::class,
            'user_teams',
            'user_id',
            'team_id'
        )->withPivot('role_id')->withTimestamps();
    }

    public function userStatement(): BelongsToMany
    {
        return $this->belongsToMany(
            Statement::class,
            'user_statements',
            'user_id',
            'statement_id',
        );
    }
}
