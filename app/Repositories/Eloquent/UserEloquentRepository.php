<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Domain\Interfaces\UserEntity;
use App\Domain\Interfaces\UserRepository;
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
}
