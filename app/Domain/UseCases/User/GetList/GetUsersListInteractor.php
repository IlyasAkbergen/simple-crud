<?php

declare(strict_types=1);

namespace App\Domain\UseCases\User\GetList;

use App\Domain\Interfaces\User\UserRepository;
use App\Domain\Interfaces\ViewModel;

class GetUsersListInteractor implements GetUsersInputPort
{
    public function __construct(
        private readonly GetUsersListViewModelFactory $viewModelFactory,
        private readonly UserRepository $userRepository,
    ) {
    }

    public function getList(GetUsersListRequestModel $requestModel): ViewModel
    {
        return $this->viewModelFactory->createListResponse(
            new GetUserListResponseModel($this->userRepository->getList($requestModel)),
            $requestModel,
        );
    }
}
