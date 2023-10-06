<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Domain\UseCases\User\CreateUser\CreateUserInputPort;
use App\Domain\UseCases\User\CreateUser\CreateUserRequestModel;
use App\Domain\UseCases\User\GetList\GetUsersInputPort;
use App\Domain\UseCases\User\GetList\GetUsersListRequestModel;
use App\Domain\UseCases\User\ShowUser\ShowUserInputPort;
use App\Domain\UseCases\User\DeleteUser\DeleteUserInputPort;
use App\Domain\UseCases\User\UpdateUser\UpdateUserInputPort;
use App\Domain\UseCases\User\UpdateUser\UpdateUserRequestModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\GetUsersListRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function __construct(
        private readonly CreateUserInputPort $createUserInputPort,
        private readonly GetUsersInputPort $getUsersInputPort,
        private readonly ShowUserInputPort $showUserInputPort,
        private readonly UpdateUserInputPort $updateUserInputPort,
        private readonly DeleteUserInputPort $deleteUserInputPort,
    ) {
    }

    public function index(GetUsersListRequest $request): JsonResource
    {
        return $this->getUsersInputPort->getList(
            new GetUsersListRequestModel($request->validated()),
        )->getResource();
    }

    public function show(int $userId): JsonResource
    {
        return $this->showUserInputPort->get($userId)->getResource();
    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        $viewModel = $this->createUserInputPort->createUser(
            new CreateUserRequestModel($request->validated()),
        );

        return $viewModel->getResource()->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(int $user, UpdateUserRequest $request): JsonResource
    {
        $viewModel = $this->updateUserInputPort->updateUser(new UpdateUserRequestModel($user, $request->validated()));

        return $viewModel->getResource();
    }

    public function destroy(int $userId): JsonResource
    {
        $viewModel = $this->deleteUserInputPort->delete($userId);

        return $viewModel->getResource();
    }
}
