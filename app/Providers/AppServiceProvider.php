<?php

namespace App\Providers;

use Dingo\Api\Transformer\Adapter\Fractal;
use Illuminate\Support\ServiceProvider;
use League\Fractal\Manager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        $this->app['Dingo\Api\Transformer\Factory']->setAdapter(function ($app) {
//            $fractal = new Manager();
//            $fractal->setSerializer(new \League\Fractal\Serializer\ArraySerializer());
//            return new Fractal($fractal);
//        });
        \Carbon\Carbon::setLocale('zh');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
