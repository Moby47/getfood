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
        'https://getfoods.ng.tech/add-favorite',
        'https://getfoods.ng.tech/remove-favorite',
        'https://getfoods.ng.tech/rate-vendor',

        'https://getfoods.ng.tech/add-to-cart',
        'https://getfoods.ng.tech/remove-from-cart',

        'https://getfoods.ng.tech/add-fav-to-cart',
        'https://getfoods.ng.tech/remove-fav-from-cart',

        'https://getfoods.ng.tech/remove-from-fav',

        'https://getfoods.ng.tech/new-food',
        'https://getfoods.ng.tech/delete-food',
        'https://getfoods.ng.tech/edit-food',
        
        'https://getfoods.ng.tech/player-id',

        'https://getfoods.ng.tech/login-user',
        'https://getfoods.ng.tech/register-user',
        'https://getfoods.ng.tech/save-order',

        'https://getfoods.ng.tech/clear-cart',
        'https://getfoods.ng.tech/push-to-vendors',
        'https://getfoods.ng.tech/clear-temp',
        'https://getfoods.ng.tech/approve-collection',
        'https://getfoods.ng.tech/approve-vendor',
        'https://getfoods.ng.tech/decline-vendor',
        'https://getfoods.ng.tech/send-survey',

    ];
}
