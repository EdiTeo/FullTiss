<?php

namespace App\Http\Controllers;

use App\Models\Entregable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\EntregableRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class EntregableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        // Obtener el id del docente autenticado
        $docenteId = Auth::id();
    
        // Filtrar los entregables por el docente autenticado
        $entregables = Entregable::where('docente_id', $docenteId)->paginate();
    
        return view('entregable.index', compact('entregables'))
            ->with('i', ($request->input('page', 1) - 1) * $entregables->perPage());
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $docente = Auth::user();
        $entregable = new Entregable();

        return view('entregable.create', compact('entregable', 'docente'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EntregableRequest $request): RedirectResponse
    {
        Entregable::create($request->validated());

        return Redirect::route('entregables.index')
            ->with('success', 'Entregable created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $entregable = Entregable::find($id);

        return view('entregable.show', compact('entregable'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $entregable = Entregable::find($id);

        return view('entregable.edit', compact('entregable'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EntregableRequest $request, Entregable $entregable): RedirectResponse
    {
        $entregable->update($request->validated());

        return Redirect::route('entregables.index')
            ->with('success', 'Entregable updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Entregable::find($id)->delete();

        return Redirect::route('entregables.index')
            ->with('success', 'Entregable deleted successfully');
    }
}
