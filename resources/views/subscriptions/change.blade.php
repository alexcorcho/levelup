@extends('app')

@section('content')
    <?php use Carbon\Carbon; ?>
    <div class="rightside bg-grey-100">
        <div class="container-fluid">
            {!! Form::Open(['action' => ['SubscriptionsController@modify',$subscription->id],'id'=>'subscriptionschangeform']) !!}
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20"> Ingrese los detalles de la suscripción </div>
                        </div>


                        <div class="panel-body">

                            <div class="row">
                                <div class="col-sm-3">

                                    {!! Form::label('member_id','Codigo miembro')!!}

                                </div>

                                <div class="col-sm-3">
                                    {!! Form::label('plan_0','Plan') !!}
                                </div>

                                <div class="col-sm-3">
                                    {!! Form::label('start_date_0','Fecha de inicio') !!}
                                </div>

                                <div class="col-sm-3">
                                    {!! Form::label('end_date_0','Fecha de finalización') !!}
                                </div>


                            </div> <!-- / Row -->
                            <div id="servicesContainer">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <?php $member_code = App\Member::where('status', '=', '1')->lists('member_code', 'id'); ?>

                                            {!! Form::text('member_id',$subscription->member->member_code,['class'=>'form-control','id'=>'member_id','readonly']) !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group plan-id">
                                            <?php $plans = App\Plan::where('status', '=', '1')->get(); ?>

                                            <select id="plan_0" name="plan[0][id]" class="form-control selectpicker show-tick show-menu-arrow childPlan"
                                                    data-live-search="true" data-row-id="0">
                                                @foreach($plans as $plan)
                                                    <option value="{{ $plan->id }}"
                                                            {{ ($plan->id == $subscription->plan_id ? "selected" : "") }} data-price="{{ $plan->amount }}"
                                                            data-days="{{ $plan->days }}" data-row-id="0">{{ $plan->plan_display }} </option>
                                                @endforeach
                                            </select>
                                            <div class="plan-price">
                                                {!! Form::hidden('plan[0][price]','', array('id' => 'price_0')) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group plan-start-date">
                                            {!! Form::text('plan[0][start_date]',$subscription->start_date->format('Y-m-d'),['class'=>'form-control datepicker-startdate childStartDate', 'id' => 'start_date_0', 'data-row-id' => '0','readonly']) !!}
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group plan-end-date">
                                            {!! Form::text('plan[0][end_date]',$subscription->end_date->format('Y-m-d'),['class'=>'form-control childEndDate', 'id' => 'end_date_0', 'readonly' => 'readonly','data-row-id' => '0']) !!}
                                        </div>
                                    </div>

                                </div> 
                            </div>

                        </div>


                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20"> Ingrese los detalles de la factura </div>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('invoice_number','Numero factura') !!}
                                        {!! Form::text('invoice_number',$subscription->invoice->invoice_number,['class'=>'form-control', 'id' => 'invoice_number','readonly']) !!}
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('subscription_amount','Tarifa de suscripción al gimnasio') !!}
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-usd" ></i></div>
                                            {!! Form::text('subscription_amount',$subscription->invoice->total,['class'=>'form-control', 'id' => 'subscription_amount','readonly' => 'readonly']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('taxes_amount',sprintf('Impuesto @ %s %%',Utilities::getSetting('taxes'))) !!}
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-usd" ></i></div>
                                            {!! Form::text('taxes_amount',$subscription->invoice->tax,['class'=>'form-control', 'id' => 'taxes_amount','readonly' => 'readonly']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('discount_percent','Descuento') !!}
                                        <?php
                                        $discounts = explode(",", str_replace(" ", "", (Utilities::getSetting('discounts'))));
                                        $discounts_list = array_combine($discounts, $discounts);
                                        ?>
                                        <select id="discount_percent" name="discount_percent" class="form-control selectpicker show-tick show-menu-arrow">
                                            <option value="0">Ninguno</option>
                                            @foreach($discounts_list as $list)
                                                <option value="{{ $list }}" {{ ($subscription->invoice->discount_percent == $list ? "selected" : "") }}>{{ $list.'%' }}</option>
                                            @endforeach
                                            <option value="custom" {{ ($subscription->invoice->discount_percent == "custom" ? "selected" : "") }}>Personalizado
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('discount_amount','Monto descuento') !!}
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-usd" ></i></div>
                                            {!! Form::text('discount_amount',$subscription->invoice->discount_amount,['class'=>'form-control', 'id' => 'discount_amount','readonly' => 'readonly']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('discount_note','Descuento nota') !!}
                                        {!! Form::text('discount_note',$subscription->invoice->discount_note,['class'=>'form-control', 'id' => 'discount_note']) !!}
                                    </div>
                                </div>
                            </div>

                        </div> 

                    </div> 
                </div> 
            </div> 


            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20">Ingrese los detalles del pago</div>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('previous_payment','Ya pagado') !!}
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-usd" ></i></div>
                                            {!! Form::text('previous_payment',($already_paid == null ? '0' : $already_paid),['class'=>'form-control', 'id' => 'previous_payment']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        {!! Form::label('payment_amount','Cantidad recibida') !!}
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-usd" ></i></div>
                                            {!! Form::text('payment_amount',null,['class'=>'form-control', 'id' => 'payment_amount', 'data-amounttotal' => '0']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        {!! Form::label('payment_amount_pending','Cantidad pendiente') !!}
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-usd" ></i></div>
                                            {!! Form::text('payment_amount_pending',null,['class'=>'form-control', 'id' => 'payment_amount_pending', 'readonly']) !!}
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('mode','Modo') !!}
                                        {!! Form::select('mode',array('1' => 'Efectivo', '0' => 'Consignacion'),1,['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'mode']) !!}
                                    </div>
                                </div>

                                <div id="chequeDetails">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            {!! Form::label('number','Consignacion No') !!}
                                            {!! Form::text('number',null,['class'=>'form-control', 'id' => 'number']) !!}
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            {!! Form::label('date','Fecha Consignacion') !!}
                                            {!! Form::text('date',null,['class'=>'form-control datepicker-default', 'id' => 'date']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div> 

                        </div> 

                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-sm-2 pull-right">
                    <div class="form-group">
                        {!! Form::submit('Change', ['class' => 'btn btn-primary pull-right']) !!}
                    </div>
                </div>
            </div>

            {!! Form::Close() !!}
        </div>
    </div>

@stop

@section('footer_scripts')
    <script src="{{ URL::asset('assets/js/subscriptionChange.js') }}" type="text/javascript"></script>
@stop

@section('footer_script_init')
    <script type="text/javascript">
        $(document).ready(function () {
            gymie.loaddatepickerstart();
            gymie.chequedetails();
            gymie.subscription();
            gymie.subscriptionChange();
        });
    </script>
@stop
