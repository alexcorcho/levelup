@extends('app')

@section('content')
    <div class="rightside bg-grey-100">

        <!-- cabecera -->
        <div class="page-head bg-grey-100 padding-top-15 no-padding-bottom">
            @include('flash::message')
            <h1 class="page-title no-line-height">Categorías de gastos
                @permission(['manage-gymie','manage-expenseCategories','add-expenseCategory'])
                <a href="{{ action('ExpenseCategoriesController@create') }}" class="page-head-btn btn-sm btn-primary active" role="button">Agrgar</a>
                <small>Detalles de todas las categorías de gastos de gimnasio</small>
            </h1>
            @permission(['manage-gymie','pagehead-stats'])
            <h1 class="font-size-30 text-right color-blue-grey-600 animated fadeInDown total-count pull-right"><span data-toggle="counter" data-start="0"
                                                                                                                     data-from="0" data-to="{{ $count }}"
                                                                                                                     data-speed="600"
                                                                                                                     data-refresh-interval="10"></span>
                <small class="color-blue-grey-600 display-block margin-top-5 font-size-14">Total Categorias</small>
            </h1>
            @endpermission
            @endpermission
        </div>

        <div class="container-fluid">

            <div class="row"><!-- row -->
                <div class="col-lg-12"><!--  col -->
                    <div class="panel no-border">
                        <div class="panel-title bg-white no-border">
                        </div>

                        <div class="panel-body no-padding-top bg-white">
                            @if($expenseCategories->count() == 0)
                                <h4 class="text-center padding-top-15">¡Lo siento! No se encontrarón archivos</h4>
                            @else
                                <table id="expenseCategories" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Nombre de la Categoria</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Comportamiento</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($expenseCategories as $expenseCategory)
                                        <tr>
                                            <td class="text-center">{{ $expenseCategory->name}}</td>
                                            <td class="text-center"><span
                                                        class="{{ Utilities::getActiveInactive ($expenseCategory->status) }}">{{ Utilities::getStatusValue ($expenseCategory->status) }}</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">Comportamiento</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Desplegar</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li>
                                                            @permission(['manage-gymie','manage-expenseCategories','edit-expenseCategory'])
                                                            <a href="{{ action('ExpenseCategoriesController@edit',['id' => $expenseCategory->id]) }}">
                                                            Editar detalles
                                                            </a>
                                                            @endpermission
                                                        </li>
                                                        <li>
                                                            <?php
                                                            $dependency = ($expenseCategory->expenses->isEmpty() ? "false" : "true");
                                                            ?>
                                                            @permission(['manage-gymie','manage-expenseCategories','delete-expenseCategory'])
                                                            <a href="#"
                                                               class="delete-record"
                                                               data-dependency="{{ $dependency }}"
                                                               data-dependency-message="Tiene gastos asignados a esta categoría, elimínelos o asígnelos a una nueva categoría"
                                                               data-delete-url="{{ url('expenses/categories/'.$expenseCategory->id.'/archive') }}"
                                                               data-record-id="{{$expenseCategory->id}}">
                                                               Eliminar categoría
                                                            </a>
                                                            @endpermission
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>

                                    @endforeach

                                    </tbody>
                                </table>

                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="gymie_paging_info">
                                            Mostrando página {{ $expenseCategories->currentPage() }} of {{ $expenseCategories->lastPage() }}
                                        </div>
                                    </div>

                                    <div class="col-xs-6">
                                        <div class="gymie_paging pull-right">
                                            {!! str_replace('/?', '?', $expenseCategories->render()) !!}
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