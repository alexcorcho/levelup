<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as BaseEncrypter;

class EncryptCookies extends BaseEncrypter
{
    /**
     * Los nombres de las cookies que no deben cifrarse.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
