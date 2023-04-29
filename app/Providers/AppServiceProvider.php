<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public $menuItems;

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
        // Model::preventLazyLoading(!app()->isProduction());
        // $this->menuItems = ["Home", "About Us", "Contact"];

        // view()->composer('layouts.navbar', function ($view) {
        //     $view->with(['contents' => $this->menuItems]);
        // });
    }
}
