@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <!-- cabecera -->
        <div class="page-head bg-grey-100 padding-top-15 no-padding-bottom">
            @include('flash::message')
            <h1 class="page-title">Configuraciones</h1>
            <a href="{{ action('SettingsController@edit') }}" class="btn btn-primary active pull-right" role="button"><i class="ion-compose"></i> Editar</a></h1>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title bg-white">
                            <div class="panel-head font-size-18"><i class="fa fa-cogs"></i> General</div>
                        </div>

                        <div class="panel-body"> 

                            <div class="row"> 

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Nombre GYM</label>
                                        <p>{{ $settings['gym_name'] }}</p>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Inicio año fiscal</label>
                                        <p>{{ $settings['financial_start'] }}</p>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Fin año fiscal</label>
                                        <p>{{ $settings['financial_end'] }}</p>
                                    </div>
                                </div>

                            </div>                

                            <div class="row">

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <!--logo gym-->
                                        <img alt="gym logo" src="{{url('/images/50x50/'.'gym_logo'.'.jpg') }}"/>
                                    </div>
                                </div>

                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Dirección de gimnasio Línea 1</label>
                                                <p>{{ $settings['gym_address_1'] }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Dirección de gimnasio Línea 2</label>
                                                <p>{{ $settings['gym_address_2'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div> 

                        </div>    

                    </div>
                </div> 
            </div> 


            <!--COnfiguracion factura-->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title bg-white">
                            <div class="panel-head font-size-18"><i class="fa fa-file"></i> Factura</div>
                        </div>
                        <div class="panel-body">
                            <div class="row">        
                                <div class="col-sm-12"> 

                                    <div class="row">   
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Prefijo de factura</label>
                                                <p>{{ $settings['invoice_prefix'] }}</p>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Último número de factura</label>
                                                <p>{{ $settings['invoice_last_number'] }}</p>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Mostrar en factura</label>
                                                <p>{{ Utilities::getDisplay($settings['invoice_name_type']) }}</p>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Modo de número de factura</label>
                                                <p>{{ Utilities::getMode($settings['invoice_number_mode']) }}</p>
                                            </div>
                                        </div>
                                    </div>    

                                </div>   
                            </div>  

                        </div>    

                    </div>    
                </div>   
            </div>   

            <!-- Configuracion miembro -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title bg-white">
                            <div class="panel-head font-size-18"><i class="fa fa-users"></i> Miembro</div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12">

                                    <div class="row">     <!-- Inner row -->
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Prefijo de código de miembro</label>
                                                <p>{{ $settings['member_prefix'] }}</p>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Último número de miembro</label>
                                                <p>{{ $settings['member_last_number'] }}</p>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Modo de número de miembro</label>
                                                <p>{{ Utilities::getMode($settings['member_number_mode']) }}</p>
                                            </div>
                                        </div>
                                    </div>     
                                </div>
                            </div>
                        </div>        

                    </div>    
                </div>    
            </div>   


        </div>   
    </div>    
@stop