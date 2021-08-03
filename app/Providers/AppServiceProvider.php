<?php

namespace App\Providers;

use App\Http\Controllers\SecurityAlgorithms\AECAlgo;
use App\Http\Controllers\SecurityAlgorithms\MainSecurity;
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

        $this->app->bind(MainSecurity::class, AECAlgo::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
