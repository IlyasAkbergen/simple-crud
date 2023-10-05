<?php

declare(strict_types=1);

namespace App\Domain\UseCases\User\GetList;

use App\Domain\Interfaces\ViewModel;

interface GetUsersListViewModelFactory
{
    public function createListResponse(
        GetUserListResponseModel $responseModel,
        GetUsersListRequestModel $requestModel,
    ): ViewModel;
}
