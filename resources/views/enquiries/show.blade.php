@extends('app')

@section('content')


    <div class="rightside bg-grey-100">
        <div class="container-fluid">

            @include('flash::message')

            <div class="row"><!--  row -->
                <div class="col-md-12"><!--  col -->
                    <div class="panel no-border ">
                        <div class="panel-title">

                            <div class="panel-head font-size-20">Detalles de la llamada</div>
                            <div class="pull-right no-margin">
                                @if($enquiry->status == 1)
                                    @permission(['manage-gymie','manage-enquiries','edit-enquiry'])
                                    <a href="#" class="mark-enquiry-as btn btn-sm btn-primary active pull-right margin-right-5"
                                       data-goto-url="{{ url('enquiries/'.$enquiry->id.'/markMember') }}" data-record-id="{{$enquiry->id}}"><i
                                                class="fa fa-user"></i> Marcar como miembro</a>
                                    <a href="#" class="mark-enquiry-as btn btn-sm btn-primary active pull-right margin-right-5"
                                       data-goto-url="{{ url('enquiries/'.$enquiry->id.'/lost') }}" data-record-id="{{$enquiry->id}}"><i
                                                class="fa fa-times"></i> Marcar como perdido</a>
                                    @endpermission
                                @endif

                                @permission(['manage-gymie','manage-enquiries','edit-enquiry'])
                                <a class="btn btn-sm btn-primary pull-right margin-right-5"
                                   href="{{ action('EnquiriesController@edit',['id' => $enquiry->id]) }}"><span>Editar</span></a>
                                @endpermission
                            </div>
                        </div>

                        <div class="panel-body">

                            <div class="row">                <!-- row iniar-->
                                <div class="col-sm-8">          <!--  columna iniciar -->
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <i class="fa fa-user center-icons color-blue-grey-100 fa-7x"></i>
                                        </div>

                                        <div class="col-sm-8">

                                            <!-- espacio -->
                                            <div class="row visible-md visible-lg">
                                                <div class="col-sm-4">
                                                    <label>&nbsp;</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>Nombre</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <span class="show-data">{{$enquiry->name}}</span>
                                                </div>
                                            </div>
                                            <hr class="margin-top-0 margin-bottom-10">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>Fecha de Cumpleaños</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <span class="show-data">{{$enquiry->DOB}}</span>
                                                </div>
                                            </div>
                                            <hr class="margin-top-0 margin-bottom-10">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>Correo Electronico</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <span class="show-data">{{$enquiry->email}}</span>
                                                </div>
                                            </div>
                                            <hr class="margin-top-0 margin-bottom-10">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>Direccion</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <span class="show-data">{{$enquiry->address}}</span>
                                                </div>
                                            </div>
                                            <hr class="margin-top-0 margin-bottom-10">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>Genero</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <span class="show-data">{{Utilities::getGender($enquiry->gender)}}</span>
                                                </div>
                                            </div>
                                            <hr class="margin-top-0 margin-bottom-10">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>Telefono</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <span class="show-data">{{$enquiry->contact}}</span>
                                                </div>
                                            </div>
                                            <hr class="margin-top-0 margin-bottom-10">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>Documento</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <span class="show-data">{{$enquiry->pin_code}}</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="row"><!--  row -->
                                        <div class="col-md-12"><!--  Col -->
                                            <div class="panel bg-grey-50">
                                                <div class="panel-title margin-top-5 bg-transparent">
                                                    <div class="panel-head"><strong><span class="fa-stack">
							  <i class="fa fa-circle-thin fa-stack-2x"></i>
							  <i class="fa fa-ellipsis-h fa-stack-1x"></i>
							</span> Detalle adicionals</strong></div>
                                                </div>
                                                <div class="panel-body">

                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label>Ocupacion</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <span class="show-data">{{Utilities::getOccupation($enquiry->occupation)}}</span>
                                                        </div>
                                                    </div>
                                                    <hr class="margin-top-0 margin-bottom-10">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label>comienza por</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <span class="show-data">{{$enquiry->start_by}}</span>
                                                        </div>
                                                    </div>
                                                    <hr class="margin-top-0 margin-bottom-10">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label>Interesado en</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <?php
                                                            $Int1 = array();
                                                            $InName = App\Service::whereIn('id', explode(',', $enquiry->interested_in))->get();

                                                            foreach ($InName as $Int2) {
                                                                $Int1[] = $Int2->name;
                                                            }
                                                            ?>
                                                            <span class="show-data">{{ implode(",",$Int1) }}</span>
                                                        </div>
                                                    </div>
                                                    <hr class="margin-top-0 margin-bottom-10">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label>Objetivo</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <span class="show-data">{{Utilities::getAim($enquiry->aim)}}</span>
                                                        </div>
                                                    </div>
                                                    <hr class="margin-top-0 margin-bottom-10">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label>Fuente</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <span class="show-data">{{Utilities::getSource($enquiry->source)}}</span>
                                                        </div>
                                                    </div>
                                                    <hr class="margin-top-0 margin-bottom-10">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label>Estado</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <span class="show-data">{{Utilities::getEnquiryStatus ($enquiry->status)}}</span>
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
            </div>

            <!-- Seguimiento ya creado-->

            <!-- ############################ Cronología de seguimiento ya creada ######################### -->

            <div class="row"><!-- row -->
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title bg-white no-border">
                            <div class="panel-head"><i class="fa fa-bookmark-o"></i> <span>Cronología de seguimiento</span></div>
                            @permission(['manage-gymie','manage-enquiries','add-enquiry-followup'])
                            <button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#createFollowupModal"
                                    data-id="createFollowupModal">
                                    Agregar seguimiento
                            </button>
                            @endpermission
                        </div>

                        <div class="panel-body">

                            @if($followups->count() != 0)
                                <div class="timeline-centered">
                                    @foreach($followups as $followup)
                                        <article class="timeline-entry">
                                            <div class="timeline-entry-inner">
                                                <time class="timeline-time"><span
                                                            class="followup-time">{{ $followup->updated_at->toFormattedDateString() }}</span></time>
                                                <div class="timeline-icon {{ Utilities::getIconBg($followup->status) }}">
                                                    <i class="{{ Utilities::getStatusIcon($followup->status) }}"></i>
                                                </div>
                                                <div class="timeline-label">
                                                    <p>Via {{ Utilities::getFollowupBy($followup->followup_by) }}
                                                        @if($followup->status == 0)
                                                            @permission(['manage-gymie','manage-enquiries','edit-enquiry-followup'])
                                                            <button class="btn btn-info btn-sm pull-right" data-toggle="modal"
                                                                    data-target="#editFollowupModal-{{$followup->id}}" data-id="{{$followup->id}}">
                                                                Editar
                                                            </button>
                                                            @endpermission
                                                        @else
                                                            <span class="label label-primary pull-right followup-label">Hecho</span>
                                                        @endif
                                                    </p>
                                                    @if($followup->status == 0)
                                                        <p>Fecha de vencimiento: {{ $followup->due_date->format('Y-m-d') }}</p>
                                                    @else
                                                        <p>{{ $followup->outcome }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </article>
                                    @endforeach
                                </div>
                            @else
                                <h2 class="text-center padding-top-15">No hay seguimientos todavía.</h2>
                            @endif
                        </div>

                    </div>
                </div>
            </div>

            <!-- Editar modal de seguimiento -->
            @if($followups->count() != 0)
                @foreach($followups as $followup)
                    <div id="editFollowupModal-{{$followup->id}}" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal contenido-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Actualice  el estado y el resultado</h4>
                                </div>
                                {!! Form::Open(['action' => ['FollowupsController@update',$followup->id],'id' => 'followupform']) !!}
                                <div class="modal-body">

                                    {!! Form::hidden('enquiry_id',$followup->enquiry->id) !!}

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                {!! Form::label('date','Fecha') !!}
                                                {!! Form::text('date',$followup->created_at->format('Y-m-d'),['class'=>'form-control', 'id' => 'date', 'readonly']) !!}
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                {!! Form::label('followup_by','Seguimiento por') !!}
                                                {!! Form::select('followup_by',array('0' => 'Llamada', '1' => 'mensaje', '2' => 'Personal'),$followup->followup_by,['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'followup_by']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                {!! Form::label('due_date','Fecha de vencimiento') !!}
                                                {!! Form::text('due_date',$followup->due_date->format('Y-m-d'),['class'=>'form-control', 'id' => 'due_date', 'readonly']) !!}
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                {!! Form::label('status','Estado') !!}
                                                {!! Form::select('status',array('0' => 'Pendiante', '1' => 'Hecho',),$followup->status,['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'status']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                {!! Form::label('outcome','Salir') !!}
                                                {!! Form::text('outcome',$followup->outcome,['class'=>'form-control', 'id' => 'outcome']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-info" value="Hecho" id="btn-{{ $followup->id }}"/>
                                </div>
                                {!! Form::Close() !!}
                            </div>
                        </div>
                    </div>

            @endforeach
        @endif

        <!-- Crear modal de seguimiento -->
            <div id="createFollowupModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal contenido-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Nuevo seguimiento</h4>
                        </div>
                        <div class="modal-body">
                            {!! Form::Open(['action' => 'FollowupsController@store','files'=>'true']) !!}
                            {!! Form::hidden('enquiry_id',$enquiry->id) !!}

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('followup_by','Seguimiento por') !!}
                                        {!! Form::select('followup_by',array('0' => 'Llamada', '1' => 'Mensaje', '2' => 'Personal'),null,['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'followup_by']) !!}
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('due_date','Fecha de vencimiento') !!}
                                        {!! Form::text('due_date',null,['class'=>'form-control datepicker-default', 'id' => 'due_date']) !!}
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-info" value="Crear" id="createFollowup"/>
                            {!! Form::Close() !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop
@section('footer_scripts')
    <script src="{{ URL::asset('assets/js/followup.js') }}" type="text/javascript"></script>
@stop
@section('footer_script_init')
    <script type="text/javascript">
        $(document).ready(function () {
            gymie.markEnquiryAs();
        });
    </script>
@stop