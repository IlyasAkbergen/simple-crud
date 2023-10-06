<?php

namespace App\Domain\UseCases\User\DeleteUser;

use App\Domain\Interfaces\ViewModel;

interface DeleteUserViewModelFactory
{
    public function userNotFound(): ViewModel;

    public function userDeleted(): ViewModel;
}
