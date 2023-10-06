<?php

declare(strict_types=1);

namespace App\Domain\Interfaces\User;

use App\Domain\Collections\UsersCollection;
use App\Domain\UseCases\User\GetList\GetUsersListRequestModel;

interface UserRepository
{
    public function exists(UserEntity $user): bool;

    public function save(UserEntity $user): UserEntity;

    public function getList(GetUsersListRequestModel $requestModel): UsersCollection;

    public function getById(int $id): ?UserEntity;

    public function update(int $id, UserEntity $user): UserEntity;

    public function delete(int $id): bool;
}
