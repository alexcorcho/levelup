<?php

namespace App\Http\Controllers;

use Auth;
use App\Plan;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Mostrar una lista del recurso.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $plans = Plan::excludeArchive()->search('"'.$request->input('search').'"')->paginate(10);
        $count = $plans->total();

        return view('plans.index', compact('plans', 'count'));
    }

    /**
     * Mostrar el recurso especificado.
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {
        $plan = Plan::findOrFail($id);

        return view('plans.show', compact('plan'));
    }

    /**
     * Mostrar el formulario para crear un nuevo recurso.
     *
     * @return Response
     */
    public function create()
    {
        return view('plans.create');
    }

    /**
     * Almacene un recurso recién creado
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //Modelo de validación
        $this->validate($request, ['plan_code' => 'unique:mst_plans,plan_code',
                                   'plan_name' => 'unique:mst_plans,plan_name', ]);

        $plan = new Plan($request->all());

        $plan->createdBy()->associate(Auth::user());
        $plan->updatedBy()->associate(Auth::user());

        $plan->save();

        flash()->success('El plan fue creado exitosamente');

        return redirect('plans');
    }

    public function edit($id)
    {
        $plan = Plan::findOrFail($id);

        return view('plans.edit', compact('plan'));
    }

    public function update($id, Request $request)
    {
        $plan = Plan::findOrFail($id);

        $plan->update($request->all());
        $plan->updatedBy()->associate(Auth::user());
        $plan->save();
        flash()->success('Los detalles del plan se actualizaron correctamente');

        return redirect('plans/all');
    }

    public function archive($id)
    {
        Plan::destroy($id);

        return redirect('plans/all');
    }
}
