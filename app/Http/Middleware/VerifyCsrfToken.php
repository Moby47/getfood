<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //allow url, no csrf token needed
        'http://localhost:8000/add-favorite',
        'http://localhost:8000/remove-favorite',
        'http://localhost:8000/add-to-cart',
        
    ];
}
