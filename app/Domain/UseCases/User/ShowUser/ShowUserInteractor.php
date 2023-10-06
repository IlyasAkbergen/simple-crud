<?php

declare(strict_types=1);

namespace App\Domain\UseCases\User\ShowUser;

use App\Domain\Interfaces\User\UserRepository;
use App\Domain\Interfaces\ViewModel;

class ShowUserInteractor implements ShowUserInputPort
{
    public function __construct(
        private ShowUserViewModelFactory $viewModelFactory,
        private UserRepository $repository,
    ) {
    }

    public function get(int $userId): ViewModel
    {
        $user = $this->repository->getById($userId);

        if (!$user) {
            return $this->viewModelFactory->userNotFound();
        }

        return $this->viewModelFactory->userInfo(
            new ShowUserResponseModel($user),
        );
    }
}
