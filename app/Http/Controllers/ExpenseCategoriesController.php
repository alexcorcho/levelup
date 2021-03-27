<?php

namespace App\Http\Controllers;

use Auth;
use App\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     *Mostrar una lista del recurso.
     *
     * @return Response
     */
    public function index()
    {
        $expenseCategories = ExpenseCategory::paginate(10);
        $count = $expenseCategories->total();

        return view('expenseCategories.index', compact('expenseCategories', 'count'));
    }

    /**
     * Mostrar el recurso especificado.
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);

        return view('expenseCategories.show', compact('expenseCategory'));
    }

    /**
     *Mostrar el formulario para crear un nuevo recurso.
     *
     * @return Response
     */
    public function create()
    {
        return view('expenseCategories.create');
    }

    /**
     *Almacene un recurso recién creado 
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'unique:mst_expenses_categories,name']);

        $expenseCategory = new ExpenseCategory($request->all());

        $expenseCategory->createdBy()->associate(Auth::user());
        $expenseCategory->updatedBy()->associate(Auth::user());

        $expenseCategory->save();
        flash()->success('La categoría de gastos se agregó correctamente');

        return redirect('expenses/categories');
    }

    public function edit($id)
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);

        return view('expenseCategories.edit', compact('expenseCategory'));
    }

    public function update($id, Request $request)
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);

        $expenseCategory->update($request->all());

        $expenseCategory->updatedBy()->associate(Auth::user());

        $expenseCategory->save();
        flash()->success('La categoría se actualizó correctamente');

        return redirect('expenses/categories');
    }

    public function archive($id, Request $request)
    {
        ExpenseCategory::destroy($id);

        return redirect('expenses/categories');
    }
}
