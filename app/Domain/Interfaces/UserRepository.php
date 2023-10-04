<?php

declare(strict_types=1);

namespace App\Domain\Interfaces;

interface UserRepository
{
    public function exists(UserEntity $user): bool;

    public function save(UserEntity $user): UserEntity;
}
