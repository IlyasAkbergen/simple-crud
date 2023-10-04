<?php

declare(strict_types=1);

namespace App\Domain\Interfaces;

interface UserEntity
{
    public function getFirstName(): string;

    public function getLastName(): string;

    public function getEmail(): string;
}
