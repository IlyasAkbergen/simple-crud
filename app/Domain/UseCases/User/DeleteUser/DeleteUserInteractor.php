<?php

declare(strict_types=1);

namespace App\Domain\UseCases\User\DeleteUser;

use App\Domain\Interfaces\User\UserRepository;
use App\Domain\Interfaces\ViewModel;

class DeleteUserInteractor implements DeleteUserInputPort
{
    public function __construct(
        private DeleteUserViewModelFactory $viewModelFactory,
        private UserRepository $repository,
    ) {
    }

    public function delete(int $userId): ViewModel
    {
        $user = $this->repository->getById($userId);

        if (!$user) {
            return $this->viewModelFactory->userNotFound();
        }

        $this->repository->delete($userId);

        return $this->viewModelFactory->userDeleted();
    }
}
