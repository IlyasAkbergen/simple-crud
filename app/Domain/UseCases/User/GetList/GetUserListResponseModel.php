<?php

declare(strict_types=1);

namespace App\Domain\UseCases\User\GetList;

use app\Domain\Interfaces\User\UserEntity;

class GetUserListResponseModel
{
    /**
     * @param UserEntity[] $users,
     */
    public function __construct(
        private array $users,
        // todo add pagination meta data
    ) {
    }

    /**
     * @return UserEntity[]
     */
    public function getUsers(): array
    {
        return $this->users;
    }
}
