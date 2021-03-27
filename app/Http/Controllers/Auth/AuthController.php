<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;

class AuthController extends Controller
{
    /**
     * La instancia del modelo.
     * @var User
     */
    protected $user;
    /**
     * La implementación deL Guard.
     *
     * @var Authenticator
     */
    protected $auth;

    /**
     * Cree una nueva instancia de controlador de autenticación.
     *
     * @param  Authenticator  $auth
     * @return void
     */
    public function __construct(Guard $auth, User $user)
    {
        $this->user = $user;
        $this->auth = $auth;

        $this->middleware('guest', ['except' => ['getLogout']]);
    }

    /**
     * Mostrar el formulario de registro de la solicitud.
     *
     * @return Response
     */
    public function getRegister()
    {
        return view('auth.register');
    }

    /**
     * Manejar una solicitud de registro para la aplicación.
     *
     * @param  RegisterRequest  $request
     * @return Response
     */
    public function postRegister(RegisterRequest $request)
    {
        $this->user->name = $request->name;
        $this->user->email = $request->email;
        $this->user->password = bcrypt($request->password);
        $this->user->save();
        $this->auth->login($this->user);

        return redirect('/dashboard');
    }

    /**
     *Mostrar el formulario de inicio de sesión de la aplicación.
     *
     * @return Response
     */
    public function getLogin()
    {
        return view('auth.login');
    }

    /**
     * Manejar una solicitud de inicio de sesión a la aplicación.
     *
     * @param  LoginRequest  $request
     * @return Response
     */
    public function postLogin(LoginRequest $request)
    {
        if ($this->auth->attempt(['email'=>  $request->email, 'password'=> $request->password, 'status'=> 1], $request->remember)) {
            return redirect()->intended('/dashboard');
        }

        return redirect('/auth/login')->withErrors([
            'email' => 'Las credenciales que ingresó no coincidían con nuestros registros. Inténtalo de nuevo',
        ]);
    }

    /**
     * Cierre la sesión del usuario de la aplicación.
     *
     * @return Response
     */
    public function getLogout()
    {
        $this->auth->logout();

        return redirect('/');
    }
}
