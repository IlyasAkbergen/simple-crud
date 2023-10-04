<?php

declare(strict_types=1);

namespace App\Domain\UseCases\User\CreateUser;

use App\Domain\Interfaces\ViewModel;

interface CreateUserOutputPort
{
    public function userCreated(CreateUserResponseModel $model): ViewModel;

    public function userAlreadyExists(CreateUserResponseModel $model): ViewModel;

    public function unableToCreateUser(CreateUserResponseModel $model, \Throwable $e): ViewModel;
}
