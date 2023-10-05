<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Domain\Collections\UsersCollection;
use app\Domain\Interfaces\User\UserEntity;
use app\Domain\Interfaces\User\UserRepository;
use App\Domain\UseCases\User\GetList\GetUsersListRequestModel;
use App\Models\User;

class UserEloquentRepository implements UserRepository
{
    public function exists(UserEntity $user): bool
    {
        return User::query()->where('email', $user->getEmail())->exists();
    }

    public function save(UserEntity $user): UserEntity
    {
        return User::create([
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'email' => $user->getEmail(),
        ]);
    }

    public function getList(GetUsersListRequestModel $requestModel): UsersCollection
    {
        $query = User::query();

        if ($requestModel->getEmail()) {
            $query = $query->where('email', $requestModel->getEmail());
        }

        if ($requestModel->getFirstName()) {
            $query = $query->where('first_name', $requestModel->getFirstName());
        }

        if ($requestModel->getLastName()) {
            $query = $query->where('last_name', $requestModel->getLastName());
        }

        // todo sort

        $paginationResult = $query->paginate(
            perPage: $requestModel->getPerPage(),
            page: $requestModel->getPage(),
        );

        return new UsersCollection(
            $paginationResult->total(),
            $paginationResult->perPage(),
            $paginationResult->currentPage(),
            ...$paginationResult->items(),
        );
    }
}
