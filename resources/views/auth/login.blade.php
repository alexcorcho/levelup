<!DOCTYPE html>
<html lang="es">
<!-- INICIO HEAD -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <title>MiGym - Login</title>

    <!--FRAMEWORK DE ESTILOSE ICONOS -->
    <link href="{{ URL::asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/plugins/ionicons/css/ionicons.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"/>
   

    <!--  PLUGIN STYLES -->
    <link href="{{ URL::asset('assets/plugins/animate/animate.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/plugins/bootstrapValidator/bootstrapValidator.min.css') }}" rel="stylesheet"/>
  

    <!--  CSS PLANTILLAS -->
    <link href="{{ URL::asset('assets/css/material.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/plugins.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/helpers.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/responsive.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/mystyle.css') }}" rel="stylesheet"/>
    
</head>
<body class="auth-page height-auto bg-primary-600">
<div class="wrapper animated fadeInDown">
    <div class="panel overflow-hidden">
        <div class="bg-primary-900 padding-40 no-margin-bottom font-size-20 color-white text-center text-uppercase">
          <!--LOGO
            <img src="{{ asset('assets/img/web/logo.png') }}">
        -->
        </div>
        
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Los sentimos, ocuarrio una falla con tu ingreso<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form id="loginform" method="post" action="{{ url('/auth/login') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <div class="box-body padding-md">

                <div class="form-group">
                    <input type="text" name="email" class="form-control input-lg" placeholder="Correo Electronico"/>
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="form-control input-lg" placeholder="Contraseña"/>
                </div>

                <div class="form-group margin-top-20">
                    <div class="checkbox checkbox-theme">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Recuerdame</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn btn-primary-500 padding-10 btn-block color-white"><i class="ion-log-in"></i> Ingresar</button>
            </div>
        </form>
        <div class="panel-footer padding-md no-margin no-border bg-grey-900 text-center color-white">&copy; 2019 Mi Gym - AlexCorcho</div>
    </div>
</div>

<!-- Javascript -->
<script src="{{ URL::asset('assets/plugins/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/js/core.js') }}" type="text/javascript"></script>


<!-- bootstrap vaidador -->
<script src="{{ URL::asset('assets/plugins/bootstrapValidator/bootstrapValidator.min.js') }}" type="text/javascript"></script>

<!-- Login validador -->
<script src="{{ URL::asset('assets/js/login.js') }}" type="text/javascript"></script>

<!-- Javascript  -->
<script src="{{ URL::asset('assets/js/gymie.js') }}" type="text/javascript"></script>
</body>
</html>