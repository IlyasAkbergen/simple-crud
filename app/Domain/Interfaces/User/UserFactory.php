<?php

declare(strict_types=1);

namespace App\Domain\Interfaces\User;

interface UserFactory
{
    public function make(array $attributes = []): UserEntity;
}
