<?php

declare(strict_types=1);

namespace App\Domain\UseCases\User\ShowUser;

use App\Domain\Interfaces\ViewModel;

interface ShowUserViewModelFactory
{
    public function userNotFound(): ViewModel;

    public function userInfo(ShowUserResponseModel $responseModel): ViewModel;
}
