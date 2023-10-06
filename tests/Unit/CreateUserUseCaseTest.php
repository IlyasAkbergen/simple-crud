<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Domain\Interfaces\User\UserEntity;
use App\Domain\Interfaces\User\UserFactory;
use App\Domain\Interfaces\User\UserRepository;
use App\Domain\UseCases\User\CreateUser\CreateUserInteractor;
use App\Domain\UseCases\User\CreateUser\CreateUserRequestModel;
use App\Domain\UseCases\User\CreateUser\CreateUserViewModelFactory;
use Mockery;
use Tests\TestCase;
use Tests\Traits\ProvidesUsers;

class CreateUserUseCaseTest extends TestCase
{
    use ProvidesUsers;

    /**
     * @dataProvider userDataProvider
     */
    public function testInteractor(array $data)
    {
        (new CreateUserInteractor(
            $this->mockCreateUserPresenter($responseModel),
            $this->mockUserRepository(exists: false),
            $this->mockUserFactory($this->mockUserEntity($data)),
        ))->createUser(
            $this->mockRequestModel($data)
        );

        $this->assertUserMatches($data, $responseModel->getUser());
    }

    private function mockUserEntity(array $data): UserEntity
    {
        return tap(Mockery::mock(UserEntity::class), function ($mock) use ($data) {
            $mock
                ->shouldReceive('getFirstName')->andReturn($data['first_name'])
                ->shouldReceive('getLastName')->andReturn($data['last_name'])
                ->shouldReceive('getEmail')->andReturn($data['email']);
        });
    }

    private function mockUserFactory(UserEntity $user): UserFactory
    {
        return tap(Mockery::mock(UserFactory::class), function ($mock) use ($user) {
            $mock
                ->shouldReceive('make')
                ->with(Mockery::type('array'))
                ->andReturn($user);
        });
    }

    private function mockUserRepository(bool $exists = false): UserRepository
    {
        return tap(Mockery::mock(UserRepository::class), function ($mock) use ($exists) {
            $mock
                ->shouldReceive('exists')
                ->with(UserEntity::class)
                ->andReturn($exists);

            $mock
                ->shouldReceive('save')
                ->with(UserEntity::class)
                ->andReturnUsing(fn($user) => $user);
        });
    }

    private function mockCreateUserPresenter(&$responseModel): CreateUserViewModelFactory
    {
        return tap(Mockery::mock(CreateUserViewModelFactory::class), function ($mock) use (&$responseModel) {
            $mock
                ->shouldReceive('userCreated')
                ->with(Mockery::capture($responseModel));
        });
    }

    private function mockRequestModel(array $data): CreateUserRequestModel
    {
        return tap(Mockery::mock(CreateUserRequestModel::class), function ($mock) use ($data) {
            $mock
                ->shouldReceive('getFirstName')->andReturn($data['first_name'])
                ->shouldReceive('getLastName')->andReturn($data['last_name'])
                ->shouldReceive('getEmail')->andReturn($data['email']);
        });
    }
}
