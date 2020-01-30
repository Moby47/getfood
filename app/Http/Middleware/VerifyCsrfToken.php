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
        'https://www.getfoods.ng/add-favorite',
        'https://www.getfoods.ng/remove-favorite',
        'https://www.getfoods.ng/rate-vendor',

        'https://www.getfoods.ng/add-to-cart',
        'https://www.getfoods.ng/remove-from-cart',

        'https://www.getfoods.ng/add-fav-to-cart',
        'https://www.getfoods.ng/remove-fav-from-cart',

        'https://www.getfoods.ng/remove-from-fav',

        'https://www.getfoods.ng/new-food',
        'https://www.getfoods.ng/delete-food',
        'https://www.getfoods.ng/edit-food',
        
        'https://www.getfoods.ng/player-id',

        'https://www.getfoods.ng/login-user',
        'https://www.getfoods.ng/register-user',
        'https://www.getfoods.ng/save-order',

        'https://www.getfoods.ng/clear-cart',
        'https://www.getfoods.ng/push-to-vendors',
        'https://www.getfoods.ng/clear-temp',
        'https://www.getfoods.ng/approve-collection',
        'https://www.getfoods.ng/approve-vendor',
        'https://www.getfoods.ng/decline-vendor',
        'https://www.getfoods.ng/send-survey',

    ];
}
