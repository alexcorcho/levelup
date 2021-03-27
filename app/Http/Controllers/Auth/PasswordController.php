<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Controlador de restablecimiento de contraseña
    |--------------------------------------------------------------------------
    |
    | Este controlador es responsable de manejar las solicitudes de restablecimiento de contraseña
    |
    */

    use ResetsPasswords;

    /**
     *Cree una nueva instancia de controlador de contraseña.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
