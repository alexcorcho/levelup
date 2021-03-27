@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <div class="container-fluid">

        @include('flash::message')

        <!-- Error Log -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Whoops!</strong>Hubo algunos problemas con su entrada.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20">Ingrese los detalles del mensaje</div>
                        </div>

                        {!! Form::Open(['url' => 'sms/shoot','id'=>'sendform']) !!}
                        <?php
                        $count = collect(array_filter(explode(',', \Utilities::getSetting('sender_id_list'))))->count();
                        $senderIds = explode(',', \Utilities::getSetting('sender_id_list'));
                        ?>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('send_to','Enviar a') !!} </br>
                                        <div class="checkbox checkbox-theme display-inline-block">
                                            <input type="checkbox" name="send[]" id="activeMembers" value="0">
                                            <label for="activeMembers" class="padding-left-30">Miembro activos</label>
                                        </div>

                                        <div class="checkbox checkbox-theme display-inline-block">
                                            <input type="checkbox" name="send[]" id="inactiveMembers" value="1">
                                            <label for="inactiveMembers" class="padding-left-30">Miembros Inactivos</label>
                                        </div>

                                        <div class="checkbox checkbox-theme display-inline-block margin-right-5">
                                            <input type="checkbox" name="send[]" id="leadEnquiries" value="2">
                                            <label for="leadEnquiries" class="padding-left-30">Llamadas principales</label>
                                        </div>

                                        <div class="checkbox checkbox-theme display-inline-block margin-right-11">
                                            <input type="checkbox" name="send[]" id="lostEnquiries" value="3">
                                            <label for="lostEnquiries" class="padding-left-30">Llamadas perdidas</label>
                                        </div>

                                        <div class="checkbox checkbox-theme display-inline-block margin-right-5">
                                            <input type="checkbox" name="send[]" id="custom" value="4">
                                            <label for="custom" class="padding-left-30">Personalizada</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if($count == 1)

                                {!! Form::hidden('sender_id',\Utilities::getSetting('sms_sender_id')) !!}

                            @elseif($count > 1)

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="sender_id">Identificación del remitente</label>
                                            <select id="sender_id" name="sender_id" class="form-control selectpicker show-tick">
                                                @foreach($senderIds as $senderId)
                                                    <option value="{{ $senderId }}">{{ $senderId }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            @endif

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group" id="customcontactsdiv">
                                        {!! Form::label('customcontacts','Numero Contacto') !!}
                                        {!! Form::text('customcontacts',null,['class'=>'form-control tokenfield', 'id' => 'customcontacts', 'placeholder' => 'Escriba números de contacto de 10 dígitos y presione enter']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('message','Mensaje de texto') !!}
                                        {!! Form::textarea('message',null,['class'=>'form-control', 'id' => 'message','rows' => '5']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::submit('Enviar ahora', ['class' => 'btn btn-primary pull-right']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {!! Form::Close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>


@stop

@section('footer_scripts')
    <script src="{{ URL::asset('assets/js/send.js') }}" type="text/javascript"></script>
@stop

@section('footer_script_init')
    <script type="text/javascript">
        $(document).ready(function () {
            gymie.loadBsTokenInput();
            gymie.customsendmessage();
        });
    </script>
@stop     