<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Request;

class LoginRequest extends Request
{
    /**
     * Obtenga las reglas de validación que se aplican a la solicitud.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required', 'password' => 'required',
        ];
    }

    /**
     * Determine si el usuario está autorizado para hacer esta solicitud.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
