<?php

namespace App\Application\Providers;

use App\Domain\Book\Repositories\BookRepository;
use App\Domain\Book\Repositories\BookRepositoryInterface;
use App\Domain\Store\Repositories\StoreRepositoryInterface;
use App\Domain\Store\Repositories\StoreRepository;
use App\Domain\User\Repositories\UserRepository;
use App\Domain\User\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
        $this->app->bind(StoreRepositoryInterface::class, StoreRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
