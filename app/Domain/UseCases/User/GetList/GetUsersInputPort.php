<?php

declare(strict_types=1);

namespace App\Domain\UseCases\User\GetList;

use App\Domain\Interfaces\ViewModel;

interface GetUsersInputPort
{
    public function getList(GetUsersListRequestModel $requestModel): ViewModel;
}
