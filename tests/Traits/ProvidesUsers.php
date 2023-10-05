<?php

declare(strict_types=1);

namespace Tests\Traits;

use app\Domain\Interfaces\User\UserEntity;

trait ProvidesUsers
{
    public function userDataProvider(): array
    {
        return [
            'Iliyas Akbergen' => [
                'attributes' => [
                    'first_name' => 'Iliyas',
                    'last_name' => 'Akbergen',
                    'email' => 'iliyasakbergen@gmail.com',
                ],
            ],
        ];
    }

    public function assertUserMatches(array $data, UserEntity $user): void
    {
        $this->assertEquals($data['first_name'], $user->getFirstName());
        $this->assertEquals($data['last_name'], $user->getLastName());
        $this->assertEquals($data['email'], $user->getEmail());
    }
}
