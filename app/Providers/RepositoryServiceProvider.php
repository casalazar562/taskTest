<?php

namespace App\Providers;

use App\Contracts\Cuenta\CuentaRepositoryInterface;
use App\Contracts\Cuenta\PedidoRepositoryInterface;
use App\Contracts\Task\TaskRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\EloquentCuentaRepository;
use App\Repositories\EloquentPedidoRepository;
use App\Repositories\EloquentTaskRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            TaskRepositoryInterface::class,
            EloquentTaskRepository::class
        );

        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
