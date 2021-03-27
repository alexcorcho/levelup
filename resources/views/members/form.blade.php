<?php use Carbon\Carbon; ?>

<!--Campos ocultos-->
@if(Request::is('members/create'))
    {!! Form::hidden('invoiceCounter',$invoiceCounter) !!}
    {!! Form::hidden('memberCounter',$memberCounter) !!}
@endif

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('member_code','Codigo Miembro') !!}
            {!! Form::text('member_code',$member_code,['class'=>'form-control', 'id' => 'member_code', ($member_number_mode == \constNumberingMode::Auto ? 'readonly' : '')]) !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('name','Nombre',['class'=>'control-label']) !!}
            {!! Form::text('name',null,['class'=>'form-control', 'id' => 'name']) !!}
        </div>
    </div>
</div>

<div class="row">

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('DOB','Fecha de cumpleños') !!}
            {!! Form::text('DOB',null,['class'=>'form-control datepicker-default', 'id' => 'DOB']) !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('gender','Genero') !!}
            {!! Form::select('gender',array('h' => 'Hombre', 'm' => 'Mujer'),null,['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'gender']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('contact','Telefono') !!}
            {!! Form::text('contact',null,['class'=>'form-control', 'id' => 'contact']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('email','Correo Elctronico') !!}
            {!! Form::text('email',null,['class'=>'form-control', 'id' => 'email']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('emergency_contact','Numero Emergencia') !!}
            {!! Form::text('emergency_contact',null,['class'=>'form-control', 'id' => 'emergency_contact']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('health_issues','Problemas de salud') !!}
            {!! Form::text('health_issues',null,['class'=>'form-control', 'id' => 'health_issues']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('proof_name','Prueba') !!}
            {!! Form::text('proof_name',null,['class'=>'form-control', 'id' => 'proof_name']) !!}
        </div>
    </div>

    @if(isset($member))
        <?php
        $media = $member->getMedia('proof');
        //imagen del test medico
        $image = ($media->isEmpty() ? '' : url($media[0]->getUrl('form')));
        ?>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('proof_photo','Foto prueba') !!}
                {!! Form::file('proof_photo',['class'=>'form-control', 'id' => 'proof_photo']) !!}
            </div>
        </div>
        <div class="col-sm-2">
            <img alt="proof Pic" class="pull-right" src="{{ $image }}"/>
        </div>
    @else
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('proof_photo','Foto prueba') !!}
                {!! Form::file('proof_photo',['class'=>'form-control', 'id' => 'proof_photo']) !!}
            </div>
        </div>
    @endif
</div>

<div class="row">
    @if(isset($member))
        <?php
        $media = $member->getMedia('profile');
        //foto perfil
        $image = ($media->isEmpty() ? '' : url($media[0]->getUrl('form')));
        ?>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('photo','Foto') !!}
                {!! Form::file('photo',['class'=>'form-control', 'id' => 'photo']) !!}
            </div>
        </div>
        <div class="col-sm-2">
            <img alt="profile Pic" class="pull-right" src="{{ $image }}"/>
        </div>
    @else
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('photo','Foto') !!}
                {!! Form::file('photo',['class'=>'form-control', 'id' => 'photo']) !!}
            </div>
        </div>
    @endif

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
            {!! Form::label('aim','¿Por qué planeas unirte?',['class'=>'control-label']) !!}
            {!! Form::select('aim',array('0' => 'Fitness', '1' => 'Competencia', '2' => 'Culturismo', '3' => 'Bajar de peso', '4' => 'Aumento de peso', '5' => 'Otros'),null,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'aim']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('source','¿Cómo llegaste a conocernos?',['class'=>'control-label']) !!}
            {!! Form::select('source',array('0' => 'Promociones', '1' => 'Boca a boca', '2' => 'Otros'),null,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'source']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    {!! Form::label('occupation','Ocupación') !!}
                    {!! Form::select('occupation',array('0' => 'Estudiante', '1' => 'Ama de casa','2' => 'Empleado','3' => 'Profecional','4' => 'Independiente','5' => 'Otros'),null,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'occupation']) !!}
                </div>
            </div>


            <div class="col-sm-12">
                <div class="form-group">
                    {!! Form::label('pin_code','Documento',['class'=>'control-label']) !!}
                    {!! Form::text('pin_code',null,['class'=>'form-control', 'id' => 'pin_code']) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('address','Direccion') !!}
            {!! Form::textarea('address',null,['class'=>'form-control', 'id' => 'address', 'rows' => 5]) !!}
        </div>
    </div>
</div>