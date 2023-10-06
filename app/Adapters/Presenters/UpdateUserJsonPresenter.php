<?php

declare(strict_types=1);

namespace App\Adapters\Presenters;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Domain\Interfaces\ViewModel;
use App\Domain\UseCases\User\UpdateUser\UpdateUserViewModelFactory;
use App\Domain\UseCases\User\UpdateUser\UpdateUserResponseModel;
use App\Http\Resources\EntityNotFoundResource;
use App\Http\Resources\UnableToUpdateUserResource;
use App\Http\Resources\UserResource;

class UpdateUserJsonPresenter implements UpdateUserViewModelFactory
{
    public function userNotFound(): ViewModel
    {
        return new JsonResourceViewModel(new EntityNotFoundResource());
    }

    public function unableToUpdateUser(UpdateUserResponseModel $responseModel, \Exception $e): ViewModel
    {
        if (config('app.debug')) {
            /** @phpstan-ignore-next-line */
            throw $e;
        }

        return new JsonResourceViewModel(
            new UnableToUpdateUserResource($e),
        );
    }

    public function userUpdated(UpdateUserResponseModel $responseModel): ViewModel
    {
        return new JsonResourceViewModel(
            new UserResource($responseModel->getUser())
        );
    }
}
