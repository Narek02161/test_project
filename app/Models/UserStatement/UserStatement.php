<?php

namespace App\Models\UserStatement;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasPermissions;
use Database\Factories\Statement\UserStatementFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $user_id
 * @property int $statement_id
 */
class UserStatement extends Model
{
    use HasFactory;
    use HasPermissions;

    protected string $guard_name = 'api';

    protected $table = 'user_statements';

    protected $fillable = [
        'user_id',
        'statement_id',
    ];

    public static function create(int $userId, int $statementId): self
    {
        $userStatement = new self();

        $userStatement->setUserId($userId);
        $userStatement->setStatementId($statementId);

        return $userStatement;
    }

    public function setUserId(int $userId): void
    {
        $this->user_id = $userId;
    }

    public function setStatementId(int $statementId): void
    {
        $this->statement_id = $statementId;
    }

    public static function newFactory(): UserStatementFactory
    {
        return new UserStatementFactory();
    }
}
