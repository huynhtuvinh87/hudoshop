<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('category', function ($app) {
            return new \App\Facades\Category();
        });
        $this->app->singleton('menu', function ($app) {
            return new \App\Facades\Menu();
        });
        $this->app->singleton('province', function ($app) {
            return new \App\Facades\Province();
        });
        $this->app->singleton('constant', function ($app) {
            return new \App\Facades\Constant();
        });
        $this->app->singleton('page', function ($app) {
            return new \App\Facades\Page();
        });
        $this->app->singleton('setting', function ($app) {
            return new \App\Facades\Setting();
        });
        $this->app->singleton('widget', function ($app) {
            return new \App\Facades\Widget();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
