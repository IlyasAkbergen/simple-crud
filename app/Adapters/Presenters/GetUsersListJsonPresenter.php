<?php

declare(strict_types=1);

namespace App\Adapters\Presenters;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Domain\Interfaces\ViewModel;
use App\Domain\UseCases\User\GetList\GetUserListResponseModel;
use App\Domain\UseCases\User\GetList\GetUsersListRequestModel;
use App\Domain\UseCases\User\GetList\GetUsersListViewModelFactory;
use App\Http\Resources\UsersListResource;

class GetUsersListJsonPresenter implements GetUsersListViewModelFactory
{

    public function createListResponse(
        GetUserListResponseModel $responseModel,
        GetUsersListRequestModel $requestModel,
    ): ViewModel
    {
        return new JsonResourceViewModel(
            new UsersListResource(
                $responseModel,
                $requestModel,
            ),
        );
    }
}
