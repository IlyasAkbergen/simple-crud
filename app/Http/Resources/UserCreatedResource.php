<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Domain\Interfaces\UserEntity;
use Illuminate\Http\Resources\Json\JsonResource;

class UserCreatedResource extends JsonResource
{
    protected UserEntity $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * @inheritDoc
     */
    public function toArray($request)
    {
        return [
            'first_name' => $this->user->getFirstName(),
            'last_name' => $this->user->getLastName(),
            'email' => $this->user->getEmail()
        ];
    }
}
