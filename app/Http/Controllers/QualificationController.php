<?php

namespace App\Http\Controllers;

use App\Models\Entrega;
use App\Models\Entregable;
use App\Models\Qualification;
use Illuminate\Http\Request;

class QualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $entrega = Entrega::findOrFail($request->input('entrega_id')); 
        $grupo = $entrega->grupo; 
        $entregable = $entrega->tarea->entregable; // Obtener el entregable asociado a la tarea de la entrega
    
        // Asegurarse de cargar las tareas del entregable
        $entregable->load('tareas');
    
        // Obtener las tareas asociadas a este entregable
        $tareas = $entregable->tareas->pluck('id');
    
        // Obtener los estudiantes que ya han sido calificados para cualquiera de las tareas de este entregable
        $estudiantesCalificados = Qualification::whereIn('entrega_id', $tareas)
                                               ->where('entregable_id', $entregable->id)
                                               ->pluck('user_id');
    
        // Filtrar estudiantes que aún no han sido calificados para este entregable
        $estudiantes = $grupo->users->whereNotIn('id', $estudiantesCalificados);
    
        return view('qualifications.create', compact('entrega', 'grupo', 'entregable', 'estudiantes'));
    }
    
    
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'entrega_id' => 'required|exists:entregas,id',
            'user_id' => 'required|exists:users,id',
            'entregable_id' => 'required|exists:entregables,id',
            'nota' => 'required|integer|min:0|max:100',
            'comentarios' => 'nullable|string',
            'fecha_calificacion' => 'required|date',
        ]);
    
        // Obtener el peso del entregable
        $entregable = Entregable::findOrFail($request->input('entregable_id'));
        $pesoMaximo = $entregable->peso;
    
        // Validar que la nota no sea mayor al peso del entregable
        if ($request->input('nota') > $pesoMaximo) {
            return back()->withErrors(['nota' => "La nota no puede ser mayor que el peso del entregable, que es $pesoMaximo."]);
        }
    
        // Crear la calificación
        $qualification = Qualification::create($request->all());
    
        // Obtener el ID del grupo desde la entrega asociada
        $entrega = Entrega::findOrFail($request->input('entrega_id'));
        $grupoId = $entrega->grupo_id;
    
        return redirect()->route('grupos.verEntregas', ['id' => $grupoId])->with('success', 'Calificación guardada correctamente.');
    }
    
    
    

    /**
     * Display the specified resource.
     */
    public function show(Qualification $qualification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Qualification $qualification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Qualification $qualification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Qualification $qualification)
    {
        //
    }
}
