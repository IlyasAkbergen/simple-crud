<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Domain\Collections\UsersCollection;
use App\Domain\Interfaces\User\UserFactory;
use App\Domain\Interfaces\User\UserRepository;
use App\Domain\UseCases\User\GetList\GetUserListResponseModel;
use App\Domain\UseCases\User\GetList\GetUsersListInteractor;
use App\Domain\UseCases\User\GetList\GetUsersListRequestModel;
use App\Domain\UseCases\User\GetList\GetUsersListViewModelFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Mockery\LegacyMockInterface;
use Mockery\MockInterface;
use Tests\TestCase;
use Tests\Traits\ProvidesUsers;

class GetUsersListUseCaseTest extends TestCase
{
    use ProvidesUsers;
    use RefreshDatabase;

    /**
     * @dataProvider userDataPaginatedListProvider
     */
    public function testInteractor(GetUsersListRequestModel $requestModel, array $response): void
    {
        /** @var GetUserListResponseModel $responseModel */
        (new GetUsersListInteractor(
            $this->mockGetUsersListPresenter($responseModel, $requestModel),
            $this->mockUserRepository($requestModel, $response),
        ))->getList(
            $requestModel,
        );

        /** @var UserFactory $userFactory */
        $userFactory = $this->app->get(UserFactory::class);
        $actualUsers = $responseModel->getUsersCollection()->all();
        $this->assertEquals(
            array_map(fn ($attributes) => $userFactory->make($attributes), $response['data']),
            $actualUsers,
        );
        $this->assertEquals($response['total'], $responseModel->getUsersCollection()->getTotal());
        $this->assertEquals($response['per_page'], $responseModel->getUsersCollection()->getPerPage());
        $this->assertEquals($response['page'], $responseModel->getUsersCollection()->getPage());
    }

    private function mockGetUsersListPresenter(&$responseModel, GetUsersListRequestModel $requestModel): GetUsersListViewModelFactory
    {
        return tap(
            Mockery::mock(GetUsersListViewModelFactory::class),
            function (MockInterface|LegacyMockInterface $mock) use (&$responseModel, $requestModel) {
                $mock
                    ->shouldReceive('createListResponse')
                    ->withArgs([
                        Mockery::capture($responseModel),
                        $requestModel,
                    ]);
            }
        );
    }

    private function mockUserRepository(GetUsersListRequestModel $requestModel, array $response): UserRepository
    {
        /** @var UserFactory $userFactory */
        $userFactory = $this->app->get(UserFactory::class);
        return tap(
            Mockery::mock(UserRepository::class),
            function ($mock) use ($requestModel, $response, $userFactory) {
                $users = array_map(fn ($attributes) => $userFactory->make($attributes), $response['data']);
                $mock
                    ->shouldReceive('getList')
                    ->once()
                    ->with($requestModel)
                    ->andReturn(new UsersCollection(
                        $response['total'],
                        $response['per_page'],
                        $response['page'],
                        ...$users
                    ));
            }
        );
    }
}
