<?php

namespace App\Providers;

use App\Services\ReadPrice\ReadPrice;
use Illuminate\Support\ServiceProvider;

class ReadPriceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ReadPrice::class, function (){
            return new ReadPrice();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
