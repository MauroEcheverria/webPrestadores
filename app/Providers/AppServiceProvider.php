<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DateTime;
use DateTimeZone;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $hora = new DateTime();
        $hora->setTimezone(new DateTimeZone('America/Bogota'));
        config(['global.fechaActual_0' => $hora->format("Y-m-d H:i:s.u")]);
        config(['global.fechaActual_1' => $hora->format("Y-m-d H:i:s")]);
        config(['global.fechaActual_2' => $hora->format("Y-m-d_His")]);
        config(['global.fechaActual_3' => $hora->format("Ymd_His")]);
        config(['global.fechaActual_4' => $hora->format("Y-m-d")]);
        config(['global.fechaActual_5' => $hora->format("H:i:s")]);
        config(['global.fechaActual_6' => $hora->format("Ymd")]);
        config(['global.fechaActual_7' => $hora->format("Ym")]);
        config(['global.fechaActual_8' => $hora->format("Y")]);
        config(['global.fechaActual_9' => $hora->format("m")]);
        config(['global.fechaActual_10' => $hora->format("d")]);
    }
}
