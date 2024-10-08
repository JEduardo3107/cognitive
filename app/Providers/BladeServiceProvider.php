<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;

class BladeServiceProvider extends ServiceProvider{
    /**
     * Register services.
     */
    public function register(): void{
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void{
        Blade::if('hasNotRole', function($expression){
            return !Auth::user()->hasRole($expression);
        });

        // Cierra el bloque de la directiva
        Blade::directive('endNotRole', function () {
            return "<?php endif; ?>";
        });
    }
}