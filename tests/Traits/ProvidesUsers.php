<?php

declare(strict_types=1);

namespace Tests\Traits;

use App\Dictionaries\SortDirection;
use App\Domain\Interfaces\User\UserEntity;
use App\Domain\UseCases\User\GetList\GetUsersListRequestModel;

trait ProvidesUsers
{
    public static function userDataProvider(): array
    {
        return [
            'Iliyas Akbergen' => [
                'data' => [
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

    public static function userDataPaginatedListProvider(): array
    {
        return [
            [
                'request' => new GetUsersListRequestModel([
                    'per_page' => 1,
                    'page' => 1,
                ]),
                'response' => [
                    'data' => [
                        [
                            'first_name' => 'Iliyas',
                            'last_name' => 'Akbergen',
                            'email' => 'iliyasakbergen@gmail.com',
                        ]
                    ],
                    'total' => 1,
                    'page' => 1,
                    'per_page' => GetUsersListRequestModel::DEFAULT_PER_PAGE,
                    'sort_field' => 'last_name',
                    'sort_direction' => SortDirection::ASC->value,
                    'email' => null,
                    'first_name' => null,
                    'last_name' => null,
                ],
            ]
        ];
    }
}
