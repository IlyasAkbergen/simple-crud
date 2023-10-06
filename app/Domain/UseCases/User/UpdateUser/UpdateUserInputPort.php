<?php

declare(strict_types=1);

namespace App\Domain\UseCases\User\UpdateUser;

use App\Domain\Interfaces\ViewModel;

interface UpdateUserInputPort
{
    public function updateUser(UpdateUserRequestModel $requestModel): ViewModel;
}
