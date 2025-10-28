<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\AutoCompleteBookings;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
    )

    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => RoleMiddleware::class,
        ]);
    })

    ->withCommands([
        AutoCompleteBookings::class,
    ])

    ->withSchedule(function (Schedule $schedule) {
        // jalankan otomatis setiap jam
        $schedule->command('bookings:auto-complete')->everyFiveMinutes();
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
