@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <!-- cabecera -->
        <div class="page-head bg-grey-100 padding-top-15 no-padding-bottom">
            @include('flash::message')
            <h1 class="page-title no-line-height">Gastos
                @permission(['manage-gymie','manage-expenses','add-expense'])
                <a href="{{ action('ExpensesController@create') }}" class="page-head-btn btn-sm btn-primary active" role="button">Agregar</a>
                <small>Details of all gym expenses</small>
            </h1>
            @permission(['manage-gymie','pagehead-stats'])
            <h1 class="font-size-30 text-right color-blue-grey-600 animated fadeInDown total-count pull-right"><span data-toggle="counter" data-start="0"
                                                                                                                     data-from="0" data-to="{{ $count }}"
                                                                                                                     data-speed="600"
                                                                                                                     data-refresh-interval="10"></span>
                <small class="color-blue-grey-600 display-block margin-top-5 font-size-14">Gasto total</small>
            </h1>
            @endpermission
            @endpermission
        </div>

        <div class="container-fluid">
            <div class="row"><!-- row -->
                <div class="col-lg-12"><!-- col -->
                    <div class="panel no-border ">
                        <div class="panel-title bg-blue-grey-50">
                            <!-- <div class="panel-head font-size-15"> -->

                            <div class="row">
                                <div class="col-sm-12 no-padding">
                                    {!! Form::Open(['method' => 'GET']) !!}

                                    <div class="col-sm-3">

                                        {!! Form::label('expense-daterangepicker','Rango de fechas') !!}

                                        <div id="expense-daterangepicker"
                                             class="gymie-daterangepicker btn bg-grey-50 daterange-padding no-border color-grey-600 hidden-xs no-shadow">
                                            <i class="ion-calendar margin-right-10"></i>
                                            <span>{{$drp_placeholder}}</span>
                                            <i class="ion-ios-arrow-down margin-left-5"></i>
                                        </div>

                                        {!! Form::text('drp_start',null,['class'=>'hidden', 'id' => 'drp_start']) !!}
                                        {!! Form::text('drp_end',null,['class'=>'hidden', 'id' => 'drp_end']) !!}
                                    </div>

                                    <div class="col-sm-2">
                                        <?php $expenseCategories = App\ExpenseCategory::where('status', '=', '1')->get(); ?>
                                        {!! Form::label('category_id','Category') !!}

                                        <?php
                                        $client_catid = isset($_GET['category_id']) ? $_GET['category_id'] : '0';
                                        ?>

                                        <select id="category_id" name="category_id" class="form-control selectpicker show-tick show-menu-arrow">
                                            <option value="0" <?php echo $client_catid == 0 ? 'selected="selected" ' : '' ?>>Todo</option>
                                            @foreach($expenseCategories as $expenseCategory)
                                                <option value="{{ $expenseCategory->id }}" <?php echo $client_catid == $expenseCategory->id ? 'selected="selected" ' : '' ?>>{{ $expenseCategory->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-2">
                                        {!! Form::label('sort_field','Ordenar por') !!}
                                        {!! Form::select('sort_field',array('created_at' => 'Fecha','name' => 'Nombre','amount' => 'Monto','due_date' => 'Fecha de vencimiento','category_name' => 'Categoria'),old('sort_field'),['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'sort_field']) !!}
                                    </div>

                                    <div class="col-sm-2">
                                        {!! Form::label('sort_direction','Orden') !!}
                                        {!! Form::select('sort_direction',array('desc' => 'Descendente','asc' => 'Ascendente'),old('sort_direction'),['class' => 'form-control selectpicker show-tick show-menu-arrow', 'id' => 'sort_direction']) !!}</span>
                                    </div>

                                    <div class="col-xs-2">
                                        {!! Form::label('search','Palabra clave') !!}
                                        <input value="{{ old('search') }}" name="search" id="search" type="text" class="form-control padding-right-35"
                                               placeholder="Buscar...">
                                    </div>

                                    <div class="col-xs-1">
                                        {!! Form::label('&nbsp;') !!} <br/>
                                        <button type="submit" class="btn btn-primary active no-border">Buscar</button>
                                    </div>

                                    {!! Form::Close() !!}
                                </div>
                            </div>

                           
                        </div>
                        <div class="panel-body bg-white">
                            @if($expenseCategories->count() == 0)
                                <h4 class="text-center padding-top-15">¡Lo siento! No se encontrarón archivos</h4>
                            @else
                                <table id="expenses" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Nombre del gasto</th>
                                        <th class="text-center">Categoría de gastos</th>
                                        <th class="text-center">Monto</th>
                                        <th class="text-center">Repetir</th>
                                        <th class="text-center">Fecha de pagoe</th>
                                        <th class="text-center">On</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Comportamiento</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($expenses as $expense)
                                        <tr>
                                            <td class="text-center">{{ $expense->name }}</td>
                                            <td class="text-center">{{ $expense->category->name }}</td>
                                            <td class="text-center"><i class="fa fa-usd" ></i> {{ $expense->amount }}</td>
                                            <td class="text-center">{{ Utilities::expenseRepeatIntervel ($expense->repeat) }}</td>
                                            <td class="text-center">{{ $expense->due_date->format('Y-m-d') }}</td>
                                            <td class="text-center">{{ $expense->created_at->toDayDateTimeString() }}</td>
                                            <td class="text-center"><span
                                                        class="{{ Utilities::getPaidUnpaid ($expense->paid) }}">{{ Utilities::getInvoiceStatus ($expense->paid) }}
                                            </td>
                                            <td class="text-center">
                                                @permission(['manage-gymie','manage-expenses','edit-expense'])
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">Comportamiento</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Despligue</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li>
                                                            @if($expense->paid == 0)
                                                                <a href="{{ action('ExpensesController@paid',['id' => $expense->id]) }}">                                                                
                                                                Marcar como pagado
                                                                </a>
                                                            @endif
                                                        </li>
                                                        @permission(['manage-gymie','manage-expenses','edit-expense'])
                                                        <li>
                                                            <a href="{{ action('ExpensesController@edit',['id' => $expense->id]) }}">
                                                                Editar
                                                            </a>
                                                        </li>
                                                        @endpermission
                                                        @permission(['manage-gymie','manage-expenses','delete-expense'])
                                                        <li>
                                                            <a href="#" class="delete-record" data-delete-url="{{ url('expenses/'.$expense->id.'/delete') }}"
                                                               data-record-id="{{$expense->id}}">
                                                               
                                                            Eliminar gastos                     
                                                            </a>
                                                        </li>
                                                        @endpermission
                                                    </ul>
                                                </div>
                                                @endpermission
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="gymie_paging_info">
                                            Mostrando página {{ $expenses->currentPage() }} of {{ $expenses->lastPage() }}
                                        </div>
                                    </div>

                                    <div class="col-xs-6">
                                        <div class="gymie_paging pull-right">
                                            {!! str_replace('/?', '?', $expenses->appends(Input::Only('search'))->render()) !!}
                                        </div>
                                    </div>
                                </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer_script_init')
    <script type="text/javascript">
        $(document).ready(function () {
            gymie.deleterecord();
        });
    </script>
@stop 