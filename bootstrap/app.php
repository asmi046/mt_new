<?php

use Illuminate\Foundation\Application;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        using: function () {
            Route::middleware('web')
                ->group(base_path('routes/asmi_all.php'));

            Route::middleware('web')
                ->group(base_path('routes/pay_order.php'));

            Route::middleware('web')
                ->group(base_path('routes/ticket.php'));
        }
    )
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('queue:work', [
            '--max-time' => 300
            ])->withoutOverlapping();
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: [
            '/pay/notification',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
