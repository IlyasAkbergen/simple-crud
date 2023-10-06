<?php

namespace App\Domain\UseCases\User\UpdateUser;

use app\Domain\Interfaces\User\UserEntity;

class UpdateUserResponseModel
{
    public function __construct(private readonly ?UserEntity $userEntity = null)
    {
    }

    public function getUser(): ?UserEntity
    {
        return $this->userEntity;
    }
}
