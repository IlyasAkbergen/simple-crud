<?php

declare(strict_types=1);

namespace App\Domain\UseCases\User\CreateUser;

use App\Domain\Interfaces\ViewModel;

interface CreateUserInputPort
{
    public function createUser(CreateUserRequestModel $requestModel): ViewModel;
}
