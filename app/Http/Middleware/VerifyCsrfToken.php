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
        'https://testing.henrymoby.tech/add-favorite',
        'https://testing.henrymoby.tech/remove-favorite',

        'https://testing.henrymoby.tech/add-to-cart',
        'https://testing.henrymoby.tech/remove-from-cart',

        'https://testing.henrymoby.tech/add-fav-to-cart',
        'https://testing.henrymoby.tech/remove-fav-from-cart',

        'https://testing.henrymoby.tech/remove-from-fav',

        'https://testing.henrymoby.tech/new-food',
        'https://testing.henrymoby.tech/delete-food',
        'https://testing.henrymoby.tech/edit-food',
        
        'https://testing.henrymoby.tech/player-id',

        'https://testing.henrymoby.tech/login-user',
        'https://testing.henrymoby.tech/register-user',
        'https://testing.henrymoby.tech/save-order',
    ];
}
