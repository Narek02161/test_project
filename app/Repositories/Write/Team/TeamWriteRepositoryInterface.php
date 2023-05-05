<?php

namespace App\Repositories\Write\Team;

use App\Models\Team\Team;

interface TeamWriteRepositoryInterface
{
    public function save(Team $team): bool;
}
