<?php

namespace App\Http;

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's route middleware.
     *
     * @var array
     */
    // protected $routeMiddleware = [
    //     // Other middleware...
    //     // 'admin' => \App\Http\Middleware\EnsureAdmin::class,
    //     // 'admin' => \App\Http\Middleware\AdminMiddleware::class, // Corrected line
    //     'admin' => \App\Http\Middleware\AdminMiddleware::class,
    //     'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
    //     'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    // ];
    protected $routeMiddleware = [
        // Other middleware...
        'admin' => \App\Http\Middleware\AdminMiddleware::class, // Ensure this points to AdminMiddleware
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
    
}
