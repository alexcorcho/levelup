<?php

namespace App\Http\Controllers;

use Auth;
use App\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* Mostrar una lista del recurso.
    *
    * @return Response
    */
    public function index(Request $request)
    {
        $expenses = Expense::indexQuery($request->category_id, $request->sort_field, $request->sort_direction, $request->drp_start, $request->drp_end)->search('"'.$request->input('search').'"')->paginate(10);
        $expenseTotal = Expense::indexQuery($request->category_id, $request->sort_field, $request->sort_direction, $request->drp_start, $request->drp_end)->search('"'.$request->input('search').'"')->get();
        $count = $expenseTotal->sum('amount');

        if (! $request->has('drp_start') or ! $request->has('drp_end')) {
            $drp_placeholder = 'Seleccionar  rango de fechas';
        } else {
            $drp_placeholder = $request->drp_start.' - '.$request->drp_end;
        }

        $request->flash();

        return view('expenses.index', compact('expenses', 'count', 'drp_placeholder'));
    }

    /**
     *Mostrar el recurso especificado.
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {
        $expense = Expense::findOrFail($id);

        return view('expenses.show', compact('expense'));
    }

    /**
     * Mostrar el formulario para crear un nuevo recurso
     *
     * @return Response
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     *Almacene un recurso recién creado
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $expenseData = ['name' => $request->name,
                             'category_id' => $request->category_id,
                             'due_date' => $request->due_date,
                             'repeat' => $request->repeat,
                             'note' => $request->note,
                             'amount' => $request->amount, ];

        $expense = new Expense($expenseData);
        $expense->createdBy()->associate(Auth::user());
        $expense->updatedBy()->associate(Auth::user());
        $expense->save();

        if ($request->due_date <= Carbon::today()->format('Y-m-d')) {
            $expense->paid = \constPaymentStatus::Paid;
        } else {
            $expense->paid = \constPaymentStatus::Unpaid;
        }

        $expense->createdBy()->associate(Auth::user());

        $expense->save();
        flash()->success('El gasto se agregó con éxito');

        return redirect('expenses/all');
    }

    public function edit($id)
    {
        $expense = Expense::findOrFail($id);

        return view('expenses.edit', compact('expense'));
    }

    public function update($id, Request $request)
    {
        $expense = Expense::findOrFail($id);

        $expense->update($request->all());

        if ($request->due_date == Carbon::today()) {
            $expense->paid = \constPaymentStatus::Paid;
        } elseif ($request->due_date != Carbon::today() && $expense->paid == \constPaymentStatus::Paid) {
            $expense->paid = \constPaymentStatus::Paid;
        } else {
            $expense->paid = \constPaymentStatus::Unpaid;
        }

        $expense->updatedBy()->associate(Auth::user());

        $expense->save();
        flash()->success('El gasto se actualizó correctamente');

        return redirect('expenses/all');
    }

    public function paid($id, Request $request)
    {
        Expense::where('id', '=', $id)->update(['paid' => \constPaymentStatus::Paid]);

        flash()->success('El gasto fue pagado exitosamente');

        return redirect('expenses/all');
    }

    public function delete($id)
    {
        Expense::destroy($id);

        return redirect('expenses/all');
    }
}
