<?php

declare(strict_types=1);

namespace App\Domain\UseCases\User\UpdateUser;

class UpdateUserRequestModel
{
    public function __construct(
        private readonly int $id,
        private readonly array $attributes,
    ) {
    }

    public function getFirstName(): string
    {
        return $this->attributes['first_name'] ?? '';
    }

    public function getLastName(): string
    {
        return $this->attributes['last_name'] ?? '';
    }

    public function getEmail(): string
    {
        return $this->attributes['email'] ?? '';
    }

    public function getId(): int
    {
        return $this->id;
    }
}
