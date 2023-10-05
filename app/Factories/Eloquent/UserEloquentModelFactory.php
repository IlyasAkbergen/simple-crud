<?php

declare(strict_types=1);

namespace App\Factories\Eloquent;

use app\Domain\Interfaces\User\UserEntity;
use app\Domain\Interfaces\User\UserFactory;
use App\Models\User;

class UserEloquentModelFactory implements UserFactory
{
    public function make(array $attributes = []): UserEntity
    {
        return new User($attributes);
    }
}
