<?php

declare(strict_types=1);

namespace App\Domain\Collections;

use App\Domain\Interfaces\User\UserEntity;

class UsersCollection extends AbstractPaginatedObjectCollection
{
    public function __construct(int $total, int $perPage, int $page, UserEntity ...$users)
    {
        parent::__construct($total, $perPage, $page, ...$users);
    }
}
