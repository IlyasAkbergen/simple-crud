<?php

declare(strict_types=1);

namespace App\Domain\UseCases\User\ShowUser;

use App\Domain\Interfaces\ViewModel;

interface ShowUserInputPort
{
    public function get(int $userId): ViewModel;
}
