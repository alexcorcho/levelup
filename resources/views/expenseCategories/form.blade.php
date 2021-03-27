<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('name','Nombre de la categoría') !!}
            {!! Form::text('name',null,['class'=>'form-control', 'id' => 'name']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        {!! Form::label('status','Estado') !!}
        <!--0 para  inactivo , 1 para activo-->
            {!! Form::select('status',array('1' => 'Activo', '0' => 'Inactivo'),null,['class' => 'form-control', 'id' => 'status']) !!}
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