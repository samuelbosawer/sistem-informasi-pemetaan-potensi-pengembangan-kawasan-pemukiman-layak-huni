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
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            // 'Excel' => Maatwebsite\Excel\Facades\Excel::class,
            // 'PDF' => Barryvdh\DomPDF\Facade::class,
            // 'Image' => Intervention\Image\Facades\Image::class,
//             'SnappyPdf' => Barryvdh\Snappy\Facades\SnappyPdf::class,
// '           SnappyImage' => Barryvdh\Snappy\Facades\SnappyImage::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
