<?php use Carbon\Carbon; ?>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('name','Nombre') !!}
            {!! Form::text('name',null,['class'=>'form-control','id'=>'name']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <?php $expenseCategories = App\ExpenseCategory::where('status', '=', '1')->lists('name', 'id'); ?>
            {!! Form::label('category_id','Categoria') !!}
            {!! Form::select('category_id',$expenseCategories,null,['class'=>'form-control selectpicker show-tick show-menu-arrow','id'=>'category_id','data-live-search'=> 'true']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('due_date','Fecha de vencimiento / fecha de pago') !!}
            {!! Form::text('due_date',(isset($expense->due_date) ? $expense->due_date->format('Y-m-d') : Carbon::today()->format('Y-m-d')),['class'=>'form-control datepicker-default','id'=>'due_date']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        {!! Form::label('repeat','Repetir') !!}
        <!--0 para inactivo , 1 for activo-->
            {!! Form::select('repeat',array('0' => 'Nunca repitas', '1' => 'Todos los días', '2' => 'Cada día de la semana', '3' => 'Cada mes', '4' => 'Todos los años'),null,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'repeat']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('note','Nota') !!}
            {!! Form::text('note',null,['class'=>'form-control','id'=>'note']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('amount','Monto') !!}
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-usd" ></i></div>
                {!! Form::text('amount',null,['class'=>'form-control','id'=>'amount']) !!}
            </div>
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