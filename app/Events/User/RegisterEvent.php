<?php

namespace App\Events\User;

use Illuminate\Queue\SerializesModels;
use App\Services\User\Dto\CreateUserDTO;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class RegisterEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(
        public string $userId,
        public CreateUserDTO $dto,
    ) {
    }
}
