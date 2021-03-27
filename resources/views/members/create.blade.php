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

            {!! Form::Open(['url' => 'members','id'=>'membersform','files'=>'true']) !!}

        <!-- Member Details -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20">Ingrese los detalles del miembro</div>
                        </div>
                        <div class="panel-body">
                            @include('members.form')
                        </div>
                    </div>
                </div>
            </div>


            @if(Request::is('members/create'))
            <!-- detalles de suscripcion-->
                @include('members._subscription')

            <!-- detalles de factura -->
                @include('members._invoice')

            <!-- detalles de pagos -->
                @include('members._payment')

            <!-- boton -->
                <div class="row">
                    <div class="col-sm-2 pull-right">
                        <div class="form-group">
                            {!! Form::submit('Create', ['class' => 'btn btn-primary pull-right']) !!}
                        </div>
                    </div>
                </div>

            @endif

            {!! Form::Close() !!}

        </div>
    </div>


@stop
@section('footer_scripts')
    <script src="{{ URL::asset('assets/js/member.js') }}" type="text/javascript"></script>
@stop

@section('footer_script_init')
    <script type="text/javascript">
        $(document).ready(function () {
            gymie.loaddatepickerstart();
            gymie.chequedetails();
            gymie.subscription();
        });
    </script>
@stop        
