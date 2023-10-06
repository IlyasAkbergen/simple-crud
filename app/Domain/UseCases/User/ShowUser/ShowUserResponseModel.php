<?php

namespace App\Domain\UseCases\User\ShowUser;

use app\Domain\Interfaces\User\UserEntity;

class ShowUserResponseModel
{
    public function __construct(private readonly ?UserEntity $userEntity = null)
    {
    }

    public function getUser(): ?UserEntity
    {
        return $this->userEntity;
    }
}
