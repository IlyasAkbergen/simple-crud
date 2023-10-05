<?php

declare(strict_types=1);

namespace App\Domain\UseCases\User\GetList;

use app\Domain\Interfaces\User\UserRepository;
use App\Domain\Interfaces\ViewModel;

class GetUsersListInteractor implements GetUsersInputPort
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly GetUsersListViewModelFactory $viewModelFactory,
    ) {
    }

    public function getList(GetUsersListRequestModel $requestModel): ViewModel
    {
        $users = $this->userRepository->getList($requestModel);

        return $this->viewModelFactory->createListResponse(
            new GetUserListResponseModel($users),
            $requestModel,
        );
    }
}
