<?php

declare(strict_types=1);

namespace App\Domain\UseCases\User\GetList;

use App\Domain\Collections\UsersCollection;

class GetUserListResponseModel
{
    public function __construct(
        private UsersCollection $usersCollection,
    ) {
    }

    public function getUsersCollection(): UsersCollection
    {
        return $this->usersCollection;
    }
}
