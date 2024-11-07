<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TareaRequest;
use App\Models\Entregable;
use App\Models\Grupo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $docente = Auth::user();
        $tareas = Tarea::where('docente_id', $docente->id)->paginate();

        return view('tarea.index', compact('tareas'))
            ->with('i', ($request->input('page', 1) - 1) * $tareas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $docente = Auth::user();
        $entregables = Entregable::where('docente_id', $docente->id)->get();
        $tarea = new Tarea();
    
        return view('tarea.create', compact('tarea', 'docente', 'entregables'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(TareaRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['docente_id'] = Auth::id(); // Asegurarse de asignar el docente_id del docente autenticado
        
        // Crear la tarea
        $tarea = Tarea::create($data);
    
        // Obtener todos los grupos activos del docente autenticado
        $docenteId = Auth::id();
        $gruposActivos = Grupo::where('docente_id', $docenteId)
                              ->where('estado', true)
                              ->get();
    
        // Asignar la tarea a los grupos activos del docente autenticado
        $tarea->grupos()->attach($gruposActivos->pluck('id'));
    
        return Redirect::route('tareas.index')
                       ->with('success', 'Tarea creada exitosamente.');
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $tarea = Tarea::find($id);

        return view('tarea.show', compact('tarea'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarea $tarea): View
    {
        $docente = Auth::user();
        $entregables = Entregable::where('docente_id', $docente->id)->get();
    
        return view('tarea.edit', compact('tarea', 'docente', 'entregables'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(TareaRequest $request, Tarea $tarea): RedirectResponse
    {
        $data = $request->validated();
        $data['docente_id'] = $tarea->docente_id; // Mantener el docente_id original
    
        $tarea->update($data);
    

        // Obtener todos los grupos activos del docente autenticado 
        $docenteId = Auth::id();
        $gruposActivos = Grupo::where('docente_id', $docenteId)
        ->where('estado', true)
        ->get();

        // Reasignar la tarea a los grupos activos del docente autenticado 
        $tarea->grupos()->sync($gruposActivos->pluck('id'));

        return Redirect::route('tareas.index')
            ->with('success', 'Tarea actualizada exitosamente');
    }
    

    public function destroy($id): RedirectResponse
    {
        Tarea::find($id)->delete();

        return Redirect::route('tareas.index')
            ->with('success', 'Tarea deleted successfully');
    }
}
