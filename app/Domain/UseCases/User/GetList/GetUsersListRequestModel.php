<?php

namespace App\Domain\UseCases\User\GetList;

use App\Dictionaries\SortDirection;

class GetUsersListRequestModel
{
    const DEFAULT_PER_PAGE = 5;

    public function __construct(private readonly array $attributes) {}

    public function getPerPage(): int
    {
        return $this->attributes['perPage'] ?? self::DEFAULT_PER_PAGE;
    }

    public function getPage(): int
    {
        return $this->attributes['page'] ?? 1;
    }

    public function getSortField(): ?string
    {
        return $this->attributes['sortField'] ?? null;
    }

    public function getSortDirection(): SortDirection
    {
        return SortDirection::tryFrom($this->attributes['sortDirection'] ?? null) ?? SortDirection::ASC;
    }

    public function getFirstName(): ?string
    {
        return $this->attributes['first_name'] ?? null;
    }

    public function getLastName(): ?string
    {
        return $this->attributes['last_name'] ?? null;
    }

    public function getEmail(): ?string
    {
        return $this->attributes['email'] ?? null;
    }
}
