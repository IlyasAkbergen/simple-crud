<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Domain\Interfaces\User\UserEntity;
use App\Domain\UseCases\User\GetList\GetUserListResponseModel;
use App\Domain\UseCases\User\GetList\GetUsersListRequestModel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersListResource extends JsonResource
{
    /** @noinspection PhpMissingParentConstructorInspection */
    public function __construct(
        private readonly GetUserListResponseModel $responseModel,
        private readonly GetUsersListRequestModel $requestModel
    ) {
    }

    public function toArray(Request $request): array
    {
        $usersCollection = $this->responseModel->getUsersCollection();

        return [
            'data' => array_map(fn (UserEntity $user) => [
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName(),
                'email' => $user->getEmail(),
            ], $this->responseModel->getUsersCollection()->all()),
            'total' => $usersCollection->getTotal(),
            'page' => $usersCollection->getPage(),
            'per_page' => $usersCollection->getPerPage(),
            'sort_field' => $this->requestModel->getSortField(),
            'sort_direction' => $this->requestModel->getSortDirection()->value,
            'email' => $this->requestModel->getEmail(),
            'first_name' => $this->requestModel->getLastName(),
            'last_name' => $this->requestModel->getLastName(),
        ];
    }
}
