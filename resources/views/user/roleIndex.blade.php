@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <!-- cabecera -->
        <div class="page-head bg-grey-100">
            @include('flash::message')
            <h1 class="page-title">Roles</h1>
            <a href="{{ action('AclController@createRole') }}" class="btn btn-primary active pull-right" role="button"> Add</a></h1>
        </div>

        <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel no-border ">
                        <div class="panel-title bg-white no-border">
                        </div>
                        <div class="panel-body no-padding-top bg-white">
                            <table id="staffs" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Mostrar como</th>
                                    <th class="text-center">Descripcion</th>
                                    <th class="text-center">Comportamiento</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    @foreach ($roles as $role)
                                        <td class="text-center">{{ $role->name}}</td>
                                        <td class="text-center">{{ $role->display_name}}</td>
                                        <td class="text-center">{{ $role->description}}</td>

                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info">Comportamiento</button>
                                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Despliegue</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a href="{{ action('AclController@editRole',['id' => $role->id]) }}">
                                                            Editar
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="modal" data-target="#deleteModal-{{$role->id}}" data-id="{{$role->id}}">
                                                            Eliminar
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        <!-- Modal -->
                                        <div id="deleteModal-{{$role->id}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Confirmar</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>¿Está seguro de que desea eliminarlo?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        {!! Form::Open(['action'=>['AclController@deleteRole',$role->id],'method' => 'POST','id'=>'deleteform-'.$role->id]) !!}
                                                        <input type="submit" class="btn btn-danger" value="Yes" id="btn-{{ $role->id }}"/>
                                                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                                                        {!! Form::Close() !!}
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                </tr>

                                @endforeach


                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop