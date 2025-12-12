<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // 👉 ĐĂNG KÝ MIDDLEWARE Ở ĐÂY

    $middleware->alias([
        'nguoi_dung' => \App\Http\Middleware\KiemTraNguoiDung::class,
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    ]);


    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
