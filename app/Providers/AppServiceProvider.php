<?php

namespace App\Providers;

use App\Repositories\Percents\EloquentPercents;
use App\Repositories\Percents\PercentsInterface;
use App\Repositories\Users\EloquentUsers;
use App\Repositories\Users\UsersInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UsersInterface::class, EloquentUsers::class);
        $this->app->bind(PercentsInterface::class, EloquentPercents::class);
    }
}
