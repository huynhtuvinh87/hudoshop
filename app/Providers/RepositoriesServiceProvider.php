<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
    }

    /**
     * Repositories Bindings.
     * Bind Every Repository to interface.
     */
    public function register()
    {

        $models = array(
            'Article',
            'Product',
            'Category',
            'User',
            'Contact',
            'Menu',
            'MenuItem',
            'Order',
            'Page',
            'Setting',
            'Maker'
        );

        foreach ($models as $model) {
            $this->app->bind("App\Contracts\{$model}Interface", "App\Repositories\{$model}Repository");
        }
    }
}
