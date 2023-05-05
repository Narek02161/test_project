<?php

namespace App\Models\Team;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\Team\TeamFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $name
 * @property int $founder_id
 * @property int $id
 */
class Team extends Model
{
    use HasFactory;

    protected $table = 'teams';

    protected $fillable = [
        'name',
        'founder_id',
    ];

    public static function create(int $founderId, string $name): self
    {
        $team = new self();

        $team->setName($name);
        $team->setFounderId($founderId);

        return $team;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setFounderId(int $founderId): void
    {
        $this->founder_id = $founderId;
    }

    public static function newFactory(): TeamFactory
    {
        return new TeamFactory();
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'user_teams',
            'team_id',
            'user_id'
        )->withPivot('role_id')->withTimestamps();
    }
}
