<?php

declare(strict_types=1);

namespace app\Domain\Interfaces\User;

use App\Domain\Collections\UsersCollection;
use App\Domain\UseCases\User\GetList\GetUsersListRequestModel;

interface UserRepository
{
    public function exists(UserEntity $user): bool;

    public function save(UserEntity $user): UserEntity;

    public function getList(GetUsersListRequestModel $requestModel): UsersCollection;
}
