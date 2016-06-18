<?php

namespace App\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Blade::directive('city', function($expression) {
            $cities = [
                'lapaz' => 'La Paz',
                'beni' => 'Beni',
                'cbba' => 'Cochabamba',
                'stacruz' => 'Santa Cruz',
                'oruro' => 'Oruro',
                'potosi' => 'Potosí',
                'tarija' => 'Tarija',
                'pando' => 'Pando',
                'sucre' => 'Sucre'
            ];
            // $city = $cities[with($expression)];
        });
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
