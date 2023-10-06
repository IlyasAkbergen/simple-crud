<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Domain\Interfaces\User\UserEntity;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAlreadyExistsResource extends JsonResource
{
    protected UserEntity $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * @inheritDoc
     */
    public function toArray($request): array
    {
        return [
            'first_name' => $this->user->getFirstName(),
            'last_name' => $this->user->getLastName(),
            'email' => $this->user->getEmail(),
        ];
    }
}
