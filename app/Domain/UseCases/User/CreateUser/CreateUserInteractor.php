<?php

declare(strict_types=1);

namespace App\Domain\UseCases\User\CreateUser;

use App\Domain\Interfaces\User\UserFactory;
use App\Domain\Interfaces\User\UserRepository;
use App\Domain\Interfaces\ViewModel;

class CreateUserInteractor implements CreateUserInputPort
{
    public function __construct(
        private CreateUserViewModelFactory $viewModelFactory,
        private UserRepository $repository,
        private UserFactory $userFactory,
    ) {
    }

    public function createUser(CreateUserRequestModel $requestModel): ViewModel
    {
        $user = $this->userFactory->make([
            'first_name' => $requestModel->getFirstName(),
            'last_name' => $requestModel->getLastName(),
            'email' => $requestModel->getEmail(),
        ]);

        if ($this->repository->exists($user)) {
            return $this->viewModelFactory->userAlreadyExists(new CreateUserResponseModel($user));
        }

        try {
            $user = $this->repository->save($user);
        } catch (\Exception $e) {
            return $this->viewModelFactory->unableToCreateUser(new CreateUserResponseModel($user), $e);
        }

        return $this->viewModelFactory->userCreated(
            new CreateUserResponseModel($user),
        );
    }
}
