<?php

declare(strict_types=1);

namespace app\Domain\Interfaces\User;

interface UserEntity
{
    public function getFirstName(): string;

    public function getLastName(): string;

    public function getEmail(): string;
}
