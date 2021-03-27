<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * Las URls que deben excluirse de la verificación CSRF.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
