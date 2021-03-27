<?php
$count = collect(array_filter(explode(',', \Utilities::getSetting('sender_id_list'))))->count();
$senderIds = explode(',', \Utilities::getSetting('sender_id_list'));
?>
<div class="panel-body">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('name','Nombre del evento') !!}
                {!! Form::text('name',null,['class'=>'form-control', 'id' => 'name']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('date','Fecha del evento') !!}
                @if(isset($event) && $event->date != "")
                    {!! Form::text('date',$event->date->format('Y-m-d'),['class'=>'form-control datepicker-default', 'id' => 'date']) !!}
                @else
                    {!! Form::text('date',null,['class'=>'form-control datepicker-default', 'id' => 'date']) !!}
                @endif
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('description','Descripción del evento') !!}
                {!! Form::text('description',null,['class'=>'form-control', 'id' => 'description']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
            {!! Form::label('status','Estado') !!}
            <!--0 para inactivo , 1 para activo-->
                {!! Form::select('status',array('1' => 'Activo', '0' => 'Inactivo'),null,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'status']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('send_to','Enviar a') !!}
                {!! Form::select('send_to[]',array('0' => 'Miembro Activo', '1' => 'Miembros Inactivos', '2' => 'Llamadas principales', '3' => 'Llamadas perdidas'),null,['class'=>'form-control selectpicker show-tick show-menu-arrow','multiple' => 'multiple', 'id' => 'send_to']) !!}
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
            <div class="form-group">
                {!! Form::label('message','Mensaje de texto') !!}
                {!! Form::textarea('message',null,['class'=>'form-control', 'id' => 'message','rows' => '5']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary pull-right']) !!}
            </div>
        </div>
    </div>
</div>
                            