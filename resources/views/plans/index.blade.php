@extends('app')

@section('content')
    <div class="rightside bg-grey-100">

        <!-- cabecera -->
        <div class="page-head bg-grey-100 padding-top-15 no-padding-bottom">
            @include('flash::message')
            <h1 class="page-title no-line-height">Planes
                @permission(['manage-gymie','manage-plans','add-plan'])
                <a href="{{ action('PlansController@create') }}" class="page-head-btn btn-sm btn-primary active" role="button">Agregar</a>
                <small>Detalles de todos los planes del GYM </small>
            </h1>
            @permission(['manage-gymie','pagehead-stats'])
            <h1 class="font-size-30 text-right color-blue-grey-600 animated fadeInDown total-count pull-right">
                <span data-toggle="counter" data-start="0"
                      data-from="0" data-to="{{ $count }}"
                      data-speed="600"
                      data-refresh-interval="10"></span>
                <small class="color-blue-grey-600 display-block margin-top-5 font-size-14">Planes Totales</small>
            </h1>
            @endpermission
            @endpermission
        </div>

        <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel no-border ">
                        <div class="panel-body no-padding-top bg-white">
                            <div class="row margin-top-15 margin-bottom-15">
                                <div class="col-xs-12 col-md-3 pull-right">
                                    {!! Form::Open(['method' => 'GET']) !!}
                                    <div class="btn-inline pull-right">
                                        <input name="search" id="search" type="text" class="form-control padding-right-35" placeholder="Buscar...">
                                        <button class="btn btn-link no-shadow bg-transparent no-padding-top padding-right-10" type="button">
                                            <i class="ion-search"></i></button>
                                    </div>
                                    {!! Form::Close() !!}

                                </div>
                            </div>

                            @if($plans->count() == 0)
                                <h4 class="text-center padding-top-15">¡Lo siento! No se encontrarón archivos</h4>
                            @else

                                <table id="plans" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Codigo Plan</th>
                                        <th>Nombre Plan</th>
                                        <th>Nombre servicio</th>
                                        <th>Detalle plan</th>
                                        <th>Dias</th>
                                        <th>Monto</th>
                                        <th>Estado</th>
                                        <th class="text-center">Comportamiento</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($plans as $plan)
                                        <tr>
                                            <td>{{ $plan->plan_code}}</td>
                                            <td>{{ $plan->plan_name}}</td>
                                            <td>{{ $plan->service->name}}</td>
                                            <td>{{ $plan->plan_details}}</td>
                                            <td>{{ $plan->days}}</td>
                                            <td>{{ $plan->amount}}</td>
                                            <td>
                                                <span class="{{ Utilities::getActiveInactive ($plan->status) }}">{{ Utilities::getStatusValue ($plan->status) }}</span>
                                            </td>

                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">Comportamiento</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Desplegar</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li>
                                                            @permission(['manage-gymie','manage-plans','edit-plan'])
                                                            <a href="{{ action('PlansController@edit',['id' => $plan->id]) }}">
                                                                Editar Detalles
                                                            </a>
                                                            @endpermission
                                                        </li>
                                                        <li>
                                                            <?php
                                                            $dependency = ($plan->Subscriptions->isEmpty() ? "false" : "true");
                                                            ?>
                                                            @permission(['manage-gymie','manage-plans','delete-plan'])
                                                            <a href="#"
                                                               class="delete-record"
                                                               data-dependency="{{ $dependency }}"
                                                               data-dependency-message="Tiene miembros asignados a este plan, elimínelos o asígnelos al nuevo plan"
                                                               data-delete-url="{{ url('plans/'.$plan->id.'/archive') }}"
                                                               data-record-id="{{$plan->id}}">
                                                                Eliminar Plan
                                                            </a>
                                                            @endpermission
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>


                                </table>

                                <!-- Pagination -->
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="gymie_paging_info">
                                            Mostrando página {{ $plans->currentPage() }} of {{ $plans->lastPage() }}
                                        </div>
                                    </div>

                                    <div class="col-xs-6">
                                        <div class="gymie_paging pull-right">
                                            {!! str_replace('/?', '?', $plans->appends(Input::Only('search'))->render()) !!}
                                        </div>
                                    </div>
                                </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer_script_init')
    <script type="text/javascript">
        $(document).ready(function () {
            gymie.deleterecord();
        });
    </script>
@stop 