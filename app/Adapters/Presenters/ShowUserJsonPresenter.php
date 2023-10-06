<?php

declare(strict_types=1);

namespace App\Adapters\Presenters;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Domain\Interfaces\ViewModel;
use App\Domain\UseCases\User\ShowUser\ShowUserResponseModel;
use App\Domain\UseCases\User\ShowUser\ShowUserViewModelFactory;
use App\Http\Resources\EntityNotFoundResource;
use App\Http\Resources\UserResource;

class ShowUserJsonPresenter implements ShowUserViewModelFactory
{
    public function userNotFound(): ViewModel
    {
        return new JsonResourceViewModel(new EntityNotFoundResource());
    }

    public function userInfo(ShowUserResponseModel $responseModel): ViewModel
    {
        return new JsonResourceViewModel(
            new UserResource($responseModel->getUser())
        );
    }
}
