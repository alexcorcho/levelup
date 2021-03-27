@extends('app')

@section('content')

    <div class="rightside bg-grey-100">

        <!-- cabecera -->
        <div class="page-head bg-grey-100 padding-top-15 no-padding-bottom">
            @include('flash::message')
            <h1 class="page-title no-line-height">Miembros Inactivos
                <small>Detalles de todos los miembros inactivos del gimnasio.</small>
            </h1>
            @permission(['manage-gymie','pagehead-stats'])
            <h1 class="font-size-30 text-right color-blue-grey-600 animated fadeInDown total-count pull-right"><span data-toggle="counter" data-start="0"
                                                                                                                     data-from="0" data-to="{{ $count }}"
                                                                                                                     data-speed="600"
                                                                                                                     data-refresh-interval="10"></span>
                <small class="color-blue-grey-600 display-block margin-top-5 font-size-14">Miembros Inactivos</small>
            </h1>
            @endpermission
        </div>

        <div class="container-fluid">
            <div class="row"><!-- row -->
                <div class="col-lg-12"><!-- col -->
                    <div class="panel no-border ">
                        <div class="panel-title bg-blue-grey-50">
                            <div class="panel-head font-size-15">

                                <div class="row">
                                    <div class="col-sm-12 no-padding">
                                        {!! Form::Open(['method' => 'GET']) !!}

                                        <div class="col-sm-3">

                                            {!! Form::label('member-daterangepicker','Rango de fechas') !!}

                                            <div id="member-daterangepicker"
                                                 class="gymie-daterangepicker btn bg-grey-50 daterange-padding no-border color-grey-600 hidden-xs no-shadow">
                                                <i class="ion-calendar margin-right-10"></i>
                                                <span>{{$drp_placeholder}}</span>
                                                <i class="ion-ios-arrow-down margin-left-5"></i>
                                            </div>

                                            {!! Form::text('drp_start',null,['class'=>'hidden', 'id' => 'drp_start']) !!}
                                            {!! Form::text('drp_end',null,['class'=>'hidden', 'id' => 'drp_end']) !!}
                                        </div>

                                        <div class="col-sm-2">
                                            {!! Form::label('sort_field','Ordenar por') !!}
                                            {!! Form::select('sort_field',array('created_at' => 'Fecha','name' => 'Nombre', 'member_code' => 'Codigo miembro', 'plan_name' => 'Nombre plan', 'status' => 'estado'),old('sort_field'),['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'sort_field']) !!}
                                        </div>

                                        <div class="col-sm-2">
                                            {!! Form::label('sort_direction','Order') !!}
                                            {!! Form::select('sort_direction',array('desc' => 'Descendente','asc' => 'Ascendente'),old('sort_direction'),['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'sort_direction']) !!}</span>
                                        </div>

                                        <div class="col-xs-3">
                                            {!! Form::label('search','Palabra clave') !!}
                                            <input value="{{ old('search') }}" name="search" id="search" type="text" class="form-control padding-right-35"
                                                   placeholder="Buscar...">
                                        </div>

                                        <div class="col-xs-2">
                                            {!! Form::label('&nbsp;') !!} <br/>
                                            <button type="submit" class="btn btn-primary active no-border">Buscar</button>
                                        </div>

                                        {!! Form::Close() !!}
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="panel-body bg-white">

                            @if($members->count() == 0)
                                <h4 class="text-center padding-top-15">¡Lo siento! No se encontrarón archivos</h4>
                            @else
                                <table id="members" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Contacto</th>
                                        <th>Nombre Plan</th>
                                        <th>Miembro desde</th>
                                        <th>Estado</th>
                                        <th class="text-center">Comportamiento</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach ($members as $member)
                                        <?php
                                        $subscriptions = $member->subscriptions;
                                        $plansArray = array();
                                        foreach ($subscriptions as $subscription) {
                                            $plansArray[] = $subscription->plan->plan_name;
                                        }
                                        $images = $member->getMedia('profile'); // direccion de la foto en las comillas de perfil
                                        $profileImage = ($images->isEmpty() ? '' : url($images[0]->getUrl('thumb')));
                                        ?>
                                        <tr>
                                            <td><a href="{{ action('MembersController@show',['id' => $member->id]) }}"><img src="{{ $profileImage }}"/></a></td>
                                            <td><a href="{{ action('MembersController@show',['id' => $member->id]) }}">{{ $member->member_code}}</a></td>
                                            <td><a href="{{ action('MembersController@show',['id' => $member->id]) }}">{{ $member->name}}</a></td>
                                            <td>{{ $member->contact}}</td>
                                            <td>{{ implode(",",$plansArray) }}</td>
                                            <td>{{ $member->created_at->format('Y-m-d')}}</td>
                                            <td>
                                                <span class="{{ Utilities::getActiveInactive ($member->status) }}">{{ Utilities::getStatusValue ($member->status) }}</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">Comportamiento</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Despliegue</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li>
                                                            @permission(['manage-gymie','manage-members','view-member'])
                                                            <a href="{{ action('MembersController@show',['id' => $member->id]) }}">Mirar detalles</a>
                                                            @endpermission
                                                        </li>
                                                        <li>
                                                            @permission(['manage-gymie','manage-members','edit-member'])
                                                            <a href="{{ action('MembersController@edit',['id' => $member->id]) }}">Editar detalles</a>
                                                            @endpermission
                                                        </li>
                                                        <li>
                                                            @permission(['manage-gymie','manage-members','delete-member'])
                                                            <a href="#" class="delete-record" data-delete-url="{{ url('members/'.$member->id.'/archive') }}"
                                                               data-record-id="{{$member->id}}">Eliminar miembro</a>
                                                            @endpermission
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="gymie_paging_info">
                                            Mostrando página {{ $members->currentPage() }} of {{ $members->lastPage() }}
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="gymie_paging pull-right">
                                            {!! str_replace('/?', '?', $members->appends(Input::all())->render()) !!}
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