<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Domain\UseCases\User\CreateUser\CreateUserInputPort;
use App\Domain\UseCases\User\CreateUser\CreateUserRequestModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    public function __construct(
        private readonly CreateUserInputPort $interactor,
    ) {
    }

    public function store(CreateUserRequest $request): ?JsonResource
    {
        $viewModel = $this->interactor->createUser(
            new CreateUserRequestModel($request->validated()),
        );

        return $viewModel instanceof JsonResourceViewModel
            ? $viewModel->getResource()
            : null;
    }
}
