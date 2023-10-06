<?php

declare(strict_types=1);

namespace App\Domain\UseCases\User\DeleteUser;

use App\Domain\Interfaces\ViewModel;

interface DeleteUserInputPort
{
    public function delete(int $userId): ViewModel;
}
