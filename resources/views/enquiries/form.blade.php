<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('name','Nombre',['class'=>'control-label']) !!}
            {!! Form::text('name',null,['class'=>'form-control', 'id' => 'name']) !!}
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
            {!! Form::label('email','Correo Electronico') !!}
            {!! Form::text('email',null,['class'=>'form-control', 'id' => 'email']) !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('DOB','Fecha de Cumpleaños') !!}
            {!! Form::text('DOB',null,['class'=>'form-control datepicker-default', 'id' => 'DOB']) !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('gender','Genero') !!}
            {!! Form::select('gender',array('m' => 'Hombre', 'f' => 'Mujer'),null,['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'gender']) !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('occupation','Ocupación') !!}
            {!! Form::select('occupation',array('0' => 'Estudiante', '1' => 'Ama de casa','2' => 'Empleado','3' => 'Profesional','4' => 'Independiente','5' => 'Otros'),null,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'occupation']) !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('start_by','Fecha de Inicio') !!}
            {!! Form::text('start_by',null,['class'=>'form-control datepicker-default', 'id' => 'start_by']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <?php $services = App\Service::lists('name', 'id'); ?>
            {!! Form::label('interested_in','Interesado en') !!}
            {!! Form::select('interested_in[]',$services,1,['class'=>'form-control selectpicker show-tick show-menu-arrow','multiple' => 'multiple','id' => 'interested_in']) !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('aim','¿Por qué planeas unirte?',['class'=>'control-label']) !!}
            {!! Form::select('aim',array('0' => 'Fitness', '1' => 'Competencia', '2' => 'Culturismo', '3' => 'Bajar de peso', '4' => 'Aumento de peso', '5' => 'Otros'),null,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'aim']) !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-6">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    {!! Form::label('source','¿Cómo llegaste a conocernos?',['class'=>'control-label']) !!}
                    {!! Form::select('source',array('0' => 'Promocion', '1' => 'Voz a Voz', '2' => 'Redes', '3' => 'Otros'),null,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'source']) !!}
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
