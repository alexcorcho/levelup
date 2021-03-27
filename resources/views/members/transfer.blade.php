@extends('app')

@section('content')

    <?php
    use Carbon\Carbon;
    ?>
    <div class="rightside bg-grey-100">
        <div class="container-fluid">
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

            {!! Form::Open(['url' => 'members','id'=>'membersform','files'=>'true']) !!}
            {!! Form::hidden('transfer_id',$enquiry->id) !!}
            {!! Form::hidden('memberCounter',$memberCounter) !!}
            {!! Form::hidden('invoiceCounter',$invoiceCounter) !!}
        <!-- Member Details -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20">Ingrese los detalles del miembro</div>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('name','Name',['class'=>'control-label']) !!}
                                        {!! Form::text('name',$enquiry->name,['class'=>'form-control', 'id' => 'name']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('photo','Foto') !!}
                                        {!! Form::file('photo',['class'=>'form-control', 'id' => 'photo']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('DOB','Cumpleaños') !!}
                                        {!! Form::text('DOB',$enquiry->DOB,['class'=>'form-control datepicker', 'id' => 'DOB']) !!}
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
                                        {!! Form::label('contact','Contacto') !!}
                                        {!! Form::text('contact',$enquiry->contact,['class'=>'form-control', 'id' => 'contact']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('email','Correo Elctronico') !!}
                                        {!! Form::text('email',$enquiry->email,['class'=>'form-control', 'id' => 'email']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('emergency_contact','Contacto de emergencia) !!}
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
                                        {!! Form::label('proof_name','Nombre de prueba') !!}
                                        {!! Form::text('proof_name',null,['class'=>'form-control', 'id' => 'proof_name']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('proof_photo','Foto prueba') !!}
                                        {!! Form::file('proof_photo',['class'=>'form-control', 'id' => 'proof_photo']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('member_code','Codigo miembro') !!}
                                        {!! Form::text('member_code',$member_code,['class'=>'form-control', 'id' => 'member_code', ($member_number_mode == \constNumberingMode::Auto ? 'readonly' : '')]) !!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    {!! Form::label('status','EStado') !!}
                                    <!--0 para inactivo , 1 para activo-->
                                        {!! Form::select('status',array('1' => 'Activo', '0' => 'Inactivo'),null,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'status']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('pin_code','Docuemnto',['class'=>'control-label']) !!}
                                        {!! Form::text('pin_code',$enquiry->pin_code,['class'=>'form-control', 'id' => 'pin_code']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('occupation','Profesión') !!}
                                        {!! Form::select('occupation',array('0' => 'Estudiante', '1' => 'Ama de casa','2' => 'Independiente','3' => 'Profesional','4' => 'Empleado','5' => 'Otros'),null,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'occupation']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('aim','¿Por qué planeas unirte?',['class'=>'control-label']) !!}
                                        {!! Form::select('aim',array('0' => 'Fitness', '1' => 'Competencia', '2' => 'Culturismo', '3' => 'Bajar de peso', '4' => 'Aumento de peso', '5' => 'Otros'),$enquiry->aim,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'aim']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('source','¿Cómo llegaste a conocernos?',['class'=>'control-label']) !!}
                                        {!! Form::select('source',array('0' => 'Promocion', '1' => 'Voz a Voz', '2' => 'Redes',  '3' => 'Otros'),$enquiry->source,['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'source']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        {!! Form::label('address','Direccion') !!}
                                        {!! Form::textarea('address',$enquiry->address,['class'=>'form-control', 'id' => 'address']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- detalle suscripcion -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20"> Ingrese los detalles de la suscripción </div>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-5">
                                    {!! Form::label('plan_0','Plan') !!}
                                </div>

                                <div class="col-sm-3">
                                    {!! Form::label('start_date_0','
Fecha de inicio') !!}
                                </div>

                                <div class="col-sm-3">
                                    {!! Form::label('end_date_0','Fecha de finalización') !!}
                                </div>

                                <div class="col-sm-1">
                                    <label>&nbsp;</label><br/>
                                </div>
                            </div> <!-- / Row -->
                            <div id="servicesContainer">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group plan-id">
                                            <?php $plans = App\Plan::where('status', '=', '1')->get(); ?>

                                            <select id="plan_0" name="plan[0][id]" class="form-control selectpicker show-tick show-menu-arrow childPlan"
                                                    data-live-search="true" data-row-id="0">
                                                @foreach($plans as $plan)
                                                    <option value="{{ $plan->id }}" data-price="{{ $plan->amount }}" data-days="{{ $plan->days }}"
                                                            data-row-id="0">{{ $plan->plan_display }} </option>
                                                @endforeach
                                            </select>
                                            <div class="plan-price">
                                                {!! Form::hidden('plan[0][price]','', array('id' => 'price_0')) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group plan-start-date">
                                            {!! Form::text('plan[0][start_date]',Carbon::today()->format('Y-m-d'),['class'=>'form-control datepicker-startdate childStartDate', 'id' => 'start_date_0', 'data-row-id' => '0']) !!}
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group plan-end-date">
                                            {!! Form::text('plan[0][end_date]',null,['class'=>'form-control childEndDate', 'id' => 'end_date_0', 'readonly' => 'readonly','data-row-id' => '0']) !!}
                                        </div>
                                    </div>

                                    <div class="col-sm-1">
                                        <div class="form-group">
                            <span class="btn btn-sm btn-danger pull-right hide remove-service">
                              <i class="fa fa-times"></i>
                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2 pull-right">
                                    <div class="form-group">
                                        <span class="btn btn-sm btn-primary pull-right" id="addSubscription">Agregar</span>
                                    </div>
                                </div>
                            </div>

                        </div> 

                    </div> 
                </div> 
            </div>

            <!-- detalles factura-->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20"> Ingrese los detalles de la factura </div>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {!! Form::label('invoice_number','Numero factura') !!}
                                        {!! Form::text('invoice_number',$invoice_number,['class'=>'form-control', 'id' => 'invoice_number', ($invoice_number_mode == \constNumberingMode::Auto ? 'readonly' : '')]) !!}
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {!! Form::label('admission_amount','Admisión') !!}
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-usd" ></i></div>
                                            {!! Form::text('admission_amount',Utilities::getSetting('admission_fee'),['class'=>'form-control', 'id' => 'admission_amount']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {!! Form::label('subscription_amount','Tarifa de suscripción al gimnasio') !!}
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-usd" ></i></div>
                                            {!! Form::text('subscription_amount',null,['class'=>'form-control', 'id' => 'subscription_amount','readonly' => 'readonly']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {!! Form::label('taxes_amount',sprintf('Impuesto @ %s %%',Utilities::getSetting('taxes'))) !!}
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-usd" ></i></div>
                                            {!! Form::text('taxes_amount',0,['class'=>'form-control', 'id' => 'taxes_amount','readonly' => 'readonly']) !!}
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
                                                <option value="{{ $list }}">{{ $list.'%' }}</option>
                                            @endforeach
                                            <option value="custom">Personalizado</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('discount_amount','Importe de descuento') !!}
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-usd" ></i></div>
                                            {!! Form::text('discount_amount',null,['class'=>'form-control', 'id' => 'discount_amount','readonly' => 'readonly']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('discount_note','Nota de descuento') !!}
                                        {!! Form::text('discount_note',null,['class'=>'form-control', 'id' => 'discount_note']) !!}
                                    </div>
                                </div>
                            </div>

                        </div> 

                    </div> 
                </div> 
            </div> 

            <!-- detalle de pagos -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20">Ingrese los detalles del pago</div>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {!! Form::label('payment_amount','Cantidad recibida') !!}
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-usd" ></i></div>
                                            {!! Form::text('payment_amount',null,['class'=>'form-control', 'id' => 'payment_amount', 'data-amounttotal' => '0']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {!! Form::label('payment_amount_pending','Monto pendiente') !!}
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-usd" ></i></div>
                                            {!! Form::text('payment_amount_pending',null,['class'=>'form-control', 'id' => 'payment_amount_pending', 'readonly']) !!}
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('mode','Modo') !!}
                                        {!! Form::select('mode',array('1' => 'Efectivo', '0' => 'Consignacion'),1,['class'=>'form-control selectpicker show-tick', 'id' => 'mode']) !!}
                                    </div>
                                </div>
                            </div> <!-- /Row -->
                            <div class="row" id="chequeDetails">
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

            <!-- boton enviar -->
            <div class="row">
                <div class="col-sm-2 pull-right">
                    <div class="form-group">
                        {!! Form::submit('Create', ['class' => 'btn btn-primary pull-right']) !!}
                    </div>
                </div>
            </div>

            {!! Form::Close() !!}

        </div> 
    </div> 

@stop
@section('footer_scripts')
    <script src="{{ URL::asset('assets/js/member.js') }}" type="text/javascript"></script>
@stop
@section('footer_script_init')
    <script type="text/javascript">
        $(document).ready(function () {
            gymie.loaddatepickerstart();
            gymie.chequedetails();
            gymie.subscription();
        });
    </script>
@stop
