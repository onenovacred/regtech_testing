<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'success',
        'failure',
        'get-token',
        'reponse_new/*',
        'reponses/*',
        'success_url/*',
        'failure_url/*',
        'failureResponse',
        'successResponse',
        'seamless_payment_submit'
        
    ];
}
