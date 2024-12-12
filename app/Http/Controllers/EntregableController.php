<?php

namespace App\Http\Controllers;

use App\Models\Entregable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\EntregableRequest;
use App\Models\Evaluation;
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
    
        // Filtrar los entregables por el docente autenticado y cargar la relación 'docente'
        $entregables = Entregable::where('docente_id', $docenteId)
            ->with('docente')
            ->paginate();
    
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
    
        // Calcular el peso restante considerando tanto los entregables como las evaluaciones
        $pesoTotalExistente = Entregable::where('docente_id', $docente->id)->sum('peso') +
                              Evaluation::where('docente_id', $docente->id)->sum('peso');
        $pesoMaximoPermitido = 100;
        $pesoRestante = $pesoMaximoPermitido - $pesoTotalExistente;
    
        return view('entregable.create', compact('entregable', 'docente', 'pesoRestante'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(EntregableRequest $request): RedirectResponse
    {
        $docenteId = Auth::id();
        $pesoRestante = 100 - Entregable::where('docente_id', $docenteId)->sum('peso');

        if ($request->input('peso') > $pesoRestante) {
            return back()->withErrors(['peso' => "El peso total no puede exceder 100. Peso restante: $pesoRestante."]);
        }

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
        $entregable = Entregable::findOrFail($id);
        $docente = Auth::user(); // Obtener el docente autenticado

       // Calcular el peso restante excluyendo el peso del entregable actual
       $pesoRestante = 100 - Entregable::where('docente_id', $docente->id)->where('id', '!=', $id)->sum('peso');

       return view('entregable.edit', compact('entregable', 'docente', 'pesoRestante'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EntregableRequest $request, Entregable $entregable): RedirectResponse
    {
        $docenteId = Auth::id();
        $pesoRestante = 100 - Entregable::where('docente_id', $docenteId)->where('id', '!=', $entregable->id)->sum('peso');

        if ($request->input('peso') > $pesoRestante) {
            return back()->withErrors(['peso' => "El peso total no puede exceder 100. Peso restante: $pesoRestante."]);
        }
        
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
