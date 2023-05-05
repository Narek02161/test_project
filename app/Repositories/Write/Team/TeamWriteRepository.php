<?php

namespace App\Repositories\Write\Team;

use App\Models\Team\Team;
use App\Exceptions\SavingErrorException;

class TeamWriteRepository implements TeamWriteRepositoryInterface
{

    /**
     * @throws SavingErrorException
     */
    public function save(Team $team): bool
    {
        if (!$team->save()) {
            throw new SavingErrorException();
        }

        return true;
    }
}
