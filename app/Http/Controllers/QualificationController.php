<?php

namespace App\Http\Controllers;

use App\Models\Crossevaluation;
use App\Models\Entrega;
use App\Models\Entregable;
use App\Models\GroupMemberEvaluation;
use App\Models\Qualification;
use App\Models\Selfevaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
        // Buscar la entrega por su ID
        $entrega = Entrega::findOrFail($request->input('entrega_id')); 
        $grupo = $entrega->grupo; 
        $entregable = $entrega->tarea->entregable; // Obtener el entregable asociado a la tarea de la entrega
    
        // Asegurarse de cargar las tareas del entregable
        $entregable->load('tareas');
    
        // Obtener los IDs de las tareas asociadas a este entregable
        $tareasIds = $entregable->tareas->pluck('id');
    
        // Obtener los estudiantes que ya han sido calificados para cualquiera de las tareas de este entregable
        $estudiantesCalificados = Qualification::whereIn('entrega_id', function ($query) use ($tareasIds) {
            $query->select('id')
                  ->from('entregas')
                  ->whereIn('tarea_id', $tareasIds);
        })->pluck('user_id');
    
        // Filtrar estudiantes que aún no han sido calificados para este entregable
        $estudiantes = $grupo->users->whereNotIn('id', $estudiantesCalificados->toArray());
    
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
        ]);
    
        // Obtener el peso del entregable
        $entregable = Entregable::findOrFail($request->input('entregable_id'));
        $pesoMaximo = $entregable->peso;
    
        // Validar que la nota no sea mayor al peso del entregable
        if ($request->input('nota') > $pesoMaximo) {
            return back()->withErrors(['nota' => "La nota no puede ser mayor que el peso del entregable, que es $pesoMaximo."]);
        }
    
        // Datos a guardar
        $data = [
            'entrega_id' => $request->input('entrega_id'),
            'user_id' => $request->input('user_id'),
            'entregable_id' => $request->input('entregable_id'),
            'nota' => $request->input('nota'),
            'comentarios' => $request->input('comentarios'),
            'fecha_calificacion' => now()->toDateString(),
        ];
    
        // Crear o actualizar la calificación
        Qualification::updateOrCreate(
            [
                'entrega_id' => $data['entrega_id'],
                'user_id' => $data['user_id'],
                'entregable_id' => $data['entregable_id'],
            ],
            $data
        );
    
        // Obtener el ID del grupo desde la entrega asociada
        $entrega = Entrega::findOrFail($request->input('entrega_id'));
        $grupoId = $entrega->grupo_id;
    
        return redirect()->route('grupos.verEntregas', ['id' => $grupoId])->with('success', 'Calificación registrada correctamente.');
        }
    
    
    
        


        public function verMisCalificaciones(): View
        {
            $user = Auth::user();
        
            // Obtener el grupo al que pertenece el estudiante
            $grupo = $user->grupo;
        
            // Obtener las entregas del estudiante
            $calificacionesEntregables = Qualification::where('user_id', $user->id)
                                                      ->with('entregable')
                                                      ->get();
        
            // Obtener las autoevaluaciones del estudiante
            $selfevaluations = Selfevaluation::where('user_id', $user->id)
                                             ->with('evaluation')
                                             ->get();
        
            // Obtener las evaluaciones cruzadas del estudiante
            $evaluacionesCruzadas = Crossevaluation::where('user_id', $user->id)
                                                   ->with('evaluation')
                                                   ->get();
        
            // Obtener las evaluaciones de grupo del estudiante
            $evaluacionesGrupo = GroupMemberEvaluation::where('evaluatee_id', $user->id)
                                                      ->with('evaluation')
                                                      ->get();
        
            // Calcular el total de las calificaciones
            $totalCalificaciones = $calificacionesEntregables->sum('nota') +
                                   $selfevaluations->sum('nota') +
                                   $evaluacionesCruzadas->avg('nota') +
                                   $evaluacionesGrupo->avg('nota');
        
            return view('qualifications.misCalificaciones', compact('user', 'grupo', 'calificacionesEntregables', 'selfevaluations', 'evaluacionesCruzadas', 'evaluacionesGrupo', 'totalCalificaciones'));
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
