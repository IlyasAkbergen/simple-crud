<?php

declare(strict_types=1);

namespace App\Factories\Eloquent;

use App\Domain\Interfaces\UserEntity;
use App\Domain\Interfaces\UserFactory;
use App\Models\User;

class UserEloquentModelFactory implements UserFactory
{
    public function make(array $attributes = []): UserEntity
    {
        return new User($attributes);
    }
}
