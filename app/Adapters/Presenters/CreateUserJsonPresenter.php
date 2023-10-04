<?php

declare(strict_types=1);

namespace App\Adapters\Presenters;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Domain\Interfaces\ViewModel;
use App\Domain\UseCases\User\CreateUser\CreateUserOutputPort;
use App\Domain\UseCases\User\CreateUser\CreateUserResponseModel;
use App\Http\Resources\UserCreatedResource;

class CreateUserJsonPresenter implements CreateUserOutputPort
{
    public function userCreated(CreateUserResponseModel $model): ViewModel
    {
        return new JsonResourceViewModel(
            new UserCreatedResource($model->getUser())
        );
    }

    public function userAlreadyExists(CreateUserResponseModel $model): ViewModel
    {
        // TODO: Implement userAlreadyExists() method.
    }

    public function unableToCreateUser(CreateUserResponseModel $model, \Throwable $e): ViewModel
    {
        // TODO: Implement unableToCreateUser() method.
    }
}
