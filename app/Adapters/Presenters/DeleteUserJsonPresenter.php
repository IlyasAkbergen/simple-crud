<?php

declare(strict_types=1);

namespace App\Adapters\Presenters;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Domain\Interfaces\ViewModel;;
use App\Domain\UseCases\User\DeleteUser\DeleteUserViewModelFactory;
use App\Http\Resources\EntityNotFoundResource;
use App\Http\Resources\EntityWasDeletedResource;

class DeleteUserJsonPresenter implements DeleteUserViewModelFactory
{
    public function userNotFound(): ViewModel
    {
        return new JsonResourceViewModel(new EntityNotFoundResource());
    }

    public function userDeleted(): ViewModel
    {
        return new JsonResourceViewModel(new EntityWasDeletedResource());
    }
}
