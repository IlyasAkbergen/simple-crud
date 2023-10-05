<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \app\Domain\Interfaces\User\UserFactory::class,
            \App\Factories\Eloquent\UserEloquentModelFactory::class,
        );

        $this->app->bind(
            \app\Domain\Interfaces\User\UserRepository::class,
            \App\Repositories\Eloquent\UserEloquentRepository::class,
        );

        $this->app
            ->when(\App\Http\Controllers\Api\UserController::class)
            ->needs(\App\Domain\UseCases\User\CreateUser\CreateUserInputPort::class)
            ->give(function ($app) {
                return $app->make(\App\Domain\UseCases\User\CreateUser\CreateUserInteractor::class, [
                    'viewModelFactory' => $app->make(\App\Adapters\Presenters\CreateUserJsonPresenter::class),
                ]);
            });

        $this->app
            ->when(\App\Http\Controllers\Api\UserController::class)
            ->needs(\App\Domain\UseCases\User\GetList\GetUsersInputPort::class)
            ->give(function ($app) {
                return $app->make(\App\Domain\UseCases\User\GetList\GetUsersListInteractor::class, [
                    'viewModelFactory' => $app->make(\App\Adapters\Presenters\CreateUserJsonPresenter::class),
                ]);
            });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
