<?php

namespace App\Providers;

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

        $default=config('securityAlgos.default');
       // $securityAlog = config("securityAlgos.{$default}.class");

        $this->app->bind(
            App\Http\Controllers\SecurityAlgorithms\MainSecurity::class, // the  interface
            App\Http\Controllers\SecurityAlgorithms\AECAlgo::class
        );
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
