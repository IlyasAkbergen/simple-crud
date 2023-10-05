<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Domain\UseCases\User\CreateUser\CreateUserInputPort;
use App\Domain\UseCases\User\CreateUser\CreateUserRequestModel;
use App\Domain\UseCases\User\GetList\GetUsersInputPort;
use App\Domain\UseCases\User\GetList\GetUsersListRequestModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\GetUsersListRequest;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    public function __construct(
        private readonly CreateUserInputPort $createUserInputPort,
        private readonly GetUsersInputPort $getUsersInputPort,
    ) {
    }

    public function index(GetUsersListRequest $request): JsonResource
    {
        return $this->getUsersInputPort->getList(
            new GetUsersListRequestModel($request->validated()),
        )->getResource();
    }
//
//    public function show(int $userId): JsonResource
//    {
//
//    }

    public function store(CreateUserRequest $request): JsonResource
    {
        $viewModel = $this->createUserInputPort->createUser(
            new CreateUserRequestModel($request->validated()),
        );

        return $viewModel->getResource();
    }

//    public function update(UpdateUserRequest $request): JsonResource
//    {
//
//    }
//
//    public function delete(int $userId): JsonResource
//    {
//
//    }
}
