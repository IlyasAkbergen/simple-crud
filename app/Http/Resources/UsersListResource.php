<?php

declare(strict_types=1);

namespace App\Http\Resources;

use app\Domain\Interfaces\User\UserEntity;
use App\Domain\UseCases\User\GetList\GetUserListResponseModel;
use App\Domain\UseCases\User\GetList\GetUsersListRequestModel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersListResource extends JsonResource
{
    public function __construct(
        private GetUserListResponseModel $responseModel,
        private GetUsersListRequestModel $requestModel
    ) {
    }

    public function toArray(Request $request): array
    {
        return [
            'data' => array_map(fn (UserEntity $user) => [
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName(),
                'email' => $user->getEmail(),
            ], $this->responseModel->getUsers()),
            'page' => $this->requestModel->getPage(),
            'per_page' => $this->requestModel->getPerPage(),
            'sort_field' => $this->requestModel->getSortField(),
            'sort_direction' => $this->requestModel->getSortDirection(),
            'email' => $this->requestModel->getEmail(),
            'first_name' => $this->requestModel->getLastName(),
            'last_name' => $this->requestModel->getLastName(),
            // todo add pagination meta data
        ];
    }
}
