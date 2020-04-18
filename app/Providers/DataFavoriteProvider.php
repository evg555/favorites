<?php

namespace App\Providers;

use App\Classes\DataFavorite;
use Illuminate\Support\ServiceProvider;

class DataFavoriteProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('DataFavorite', DataFavorite::class);
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
