<div class="panel-body">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('plan_code','Codigo Plan') !!}
                {!! Form::text('plan_code',null,['class'=>'form-control', 'id' => 'plan_code']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('plan_name','Nombre plan') !!}
                {!! Form::text('plan_name',null,['class'=>'form-control', 'id' => 'plan_name']) !!}
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('plan_details','Detalles Plan') !!}
                {!! Form::text('plan_details',null,['class'=>'form-control', 'id' => 'plan_details']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <?php $services = App\Service::lists('name', 'id'); ?>
                {!! Form::label('service_id','Servicio') !!}
                {!! Form::select('service_id',$services,null,['class'=>'form-control selectpicker show-tick show-menu-arrow','id'=>'service_id','data-live-search'=> 'true']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('days','Dias') !!}
                {!! Form::text('days',null,['class'=>'form-control', 'id' => 'days']) !!}
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('amount','Cantidad (sin impuestos)') !!}
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-usd" ></i></div>
                    {!! Form::text('amount',null,['class'=>'form-control', 'id' => 'amount']) !!}
                </div>
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
                {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary pull-right']) !!}
            </div>
        </div>
    </div>
</div>
                            