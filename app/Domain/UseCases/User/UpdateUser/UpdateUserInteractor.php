<?php

declare(strict_types=1);

namespace App\Domain\UseCases\User\UpdateUser;

use App\Domain\Interfaces\User\UserFactory;
use App\Domain\Interfaces\User\UserRepository;
use App\Domain\Interfaces\ViewModel;

class UpdateUserInteractor implements UpdateUserInputPort
{
    public function __construct(
        private UpdateUserViewModelFactory $viewModelFactory,
        private UserRepository $repository,
        private UserFactory $userFactory,
    ) {
    }

    public function updateUser(UpdateUserRequestModel $requestModel): ViewModel
    {
        $user = $this->repository->getById($requestModel->getId());

        if (!$user) {
            return $this->viewModelFactory->userNotFound();
        }

        $user = $this->userFactory->make([
            'first_name' => $requestModel->getFirstName(),
            'last_name' => $requestModel->getLastName(),
            'email' => $requestModel->getEmail(),
        ]);

        try {
            $this->repository->update($requestModel->getId(), $user);
        } catch (\Exception $e) {
            return $this->viewModelFactory->unableToUpdateUser(new UpdateUserResponseModel($user), $e);
        }

        return $this->viewModelFactory->userUpdated(
            new UpdateUserResponseModel($user),
        );
    }
}
