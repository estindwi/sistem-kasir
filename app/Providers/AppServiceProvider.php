<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\RepositoryInterface\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\RepositoryInterface\ProdukRepositoryInterface;
use App\Repositories\ProdukRepository;
use App\Repositories\RepositoryInterface\TransaksiPenjualanRepositoryInterface;
use App\Repositories\TransaksiPenjualanRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            ProdukRepositoryInterface::class,
            ProdukRepository::class
        );

        $this->app->bind(
            TransaksiPenjualanRepositoryInterface::class,
            TransaksiPenjualanRepository::class
        );
    }

    public function boot(): void
    {
        //
    }
}