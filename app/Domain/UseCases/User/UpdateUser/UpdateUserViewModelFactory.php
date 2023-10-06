<?php

namespace App\Domain\UseCases\User\UpdateUser;

use App\Domain\Interfaces\ViewModel;

interface UpdateUserViewModelFactory
{
    public function userNotFound(): ViewModel;

    public function unableToUpdateUser(UpdateUserResponseModel $responseModel, \Exception $e): ViewModel;

    public function userUpdated(UpdateUserResponseModel $responseModel): ViewModel;
}
