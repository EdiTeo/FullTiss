<?php

namespace App\Http\Controllers;

use App\Models\Entrega;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\EntregaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class EntregaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $entregas = Entrega::paginate();

        return view('entrega.index', compact('entregas'))
            ->with('i', ($request->input('page', 1) - 1) * $entregas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $tarea_id = $request->input('tarea_id');
        $entrega = new Entrega();
    
        return view('entrega.create', compact('entrega', 'tarea_id'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(EntregaRequest $request): RedirectResponse
    {
        Entrega::create($request->validated());

        return Redirect::route('entregas.index')
            ->with('success', 'Entrega created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $entrega = Entrega::find($id);

        return view('entrega.show', compact('entrega'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $entrega = Entrega::find($id);

        return view('entrega.edit', compact('entrega'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EntregaRequest $request, Entrega $entrega): RedirectResponse
    {
        $entrega->update($request->validated());

        return Redirect::route('entregas.index')
            ->with('success', 'Entrega updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Entrega::find($id)->delete();

        return Redirect::route('entregas.index')
            ->with('success', 'Entrega deleted successfully');
    }
}
