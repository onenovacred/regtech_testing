<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper;

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
         if (env('APP_ENV') === 'production') {
        // This forces the app to use HTTPS protocol for URLs
        \URL::forceScheme('https');
    }
      
    }
}
