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
        'https://getfoods.ng/add-favorite',
        'https://getfoods.ng/remove-favorite',
        'https://getfoods.ng/rate-vendor',

        'https://getfoods.ng/add-to-cart',
        'https://getfoods.ng/remove-from-cart',

        'https://getfoods.ng/add-fav-to-cart',
        'https://getfoods.ng/remove-fav-from-cart',

        'https://getfoods.ng/remove-from-fav',

        'https://getfoods.ng/new-food',
        'https://getfoods.ng/delete-food',
        'https://getfoods.ng/edit-food',
        
        'https://getfoods.ng/player-id',

        'https://getfoods.ng/login-user',
        'https://getfoods.ng/register-user',
        'https://getfoods.ng/save-order',

        'https://getfoods.ng/clear-cart',
        'https://getfoods.ng/push-to-vendors',
        'https://getfoods.ng/clear-temp',
        'https://getfoods.ng/approve-collection',
        'https://getfoods.ng/approve-vendor',
        'https://getfoods.ng/decline-vendor',
        'https://getfoods.ng/send-survey',

    ];
}
