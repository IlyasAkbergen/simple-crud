<?php

declare(strict_types=1);

namespace App\Domain\UseCases\User\CreateUser;

use App\Domain\Interfaces\UserEntity;

class CreateUserResponseModel
{
    public function __construct(
        private readonly UserEntity $user
    ) {
    }

    public function getUser(): UserEntity
    {
        return $this->user;
    }
}
