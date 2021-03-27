@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <div class="container-fluid">

            <!-- Error Log -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Whoops!</strong> Hubo algunos problemas con su entrada.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::Open(['url' => 'enquiries','id'=>'enquiriesform','files'=>'true']) !!}
        <!-- detalles de llamada -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20">Ingrese los detalles de la llamada</div>
                        </div>
                        <div class="panel-body">
                            @include('enquiries.form')
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulario de seguimiento -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20">Ingrese los detalles del seguimiento</div>
                        </div>
                        <div class="panel-body">
                            @include('enquiries._followUp')
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enviar botón Fila-->
            <div class="row">
                <div class="col-sm-2 pull-right">
                    <div class="form-group">
                        {!! Form::submit('Create', ['class' => 'btn btn-primary pull-right']) !!}
                    </div>
                </div>
            </div>

            {!! Form::Close() !!}

        </div> <!-- Contenido -->
    </div> <!-- lado derecho -->


@stop
@section('footer_scripts')
    <script src="{{ URL::asset('assets/js/enquiry.js') }}" type="text/javascript"></script>
@stop