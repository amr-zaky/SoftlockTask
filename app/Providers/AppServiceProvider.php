<?php

namespace App\Providers;

use App\Http\Controllers\SecurityAlgorithms\AESAlgo;
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
        // to bind the interface to the Alogrithm
        $this->app->bind(MainSecurity::class, AESAlgo::class);
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
