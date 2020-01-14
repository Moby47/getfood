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
        'http://localhost:8000/remove-from-cart',

        'http://localhost:8000/add-fav-to-cart',
        'http://localhost:8000/remove-fav-from-cart',

        'http://localhost:8000/remove-from-fav',

        'http://localhost:8000/new-food',
        'http://localhost:8000/delete-food',
        'http://localhost:8000/edit-food',
        
        'http://localhost:8000/player-id',

        'http://localhost:8000/login-user',
       'http://localhost:8000/save-order',
    ];
}
