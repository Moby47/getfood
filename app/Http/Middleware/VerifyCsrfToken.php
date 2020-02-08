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
        'https://localhost:8000/add-favorite',
        'https://localhost:8000/remove-favorite',
        'https://localhost:8000/rate-vendor',

        'https://localhost:8000/add-to-cart',
        'https://localhost:8000/remove-from-cart',

        'https://localhost:8000/add-fav-to-cart',
        'https://localhost:8000/remove-fav-from-cart',

        'https://localhost:8000/remove-from-fav',

        'https://localhost:8000/new-food',
        'https://localhost:8000/delete-food',
        'https://localhost:8000/edit-food',
        
        'https://localhost:8000/player-id',

        'https://localhost:8000/login-user',
        'https://localhost:8000/register-user',
        'https://localhost:8000/save-order',

        'https://localhost:8000/clear-cart',
        'https://localhost:8000/push-to-vendors',
        'https://localhost:8000/clear-temp',
        'https://localhost:8000/approve-collection',
        'https://localhost:8000/approve-vendor',
        'https://localhost:8000/decline-vendor',
        'https://localhost:8000/send-survey',

    ];
}
