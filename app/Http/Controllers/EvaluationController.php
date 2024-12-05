<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Crossevaluation;
use App\Models\Entregable;
use App\Models\Evaluation;
use App\Models\GroupMemberEvaluation;
use App\Models\Grupo;
use App\Models\Selfevaluation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $evaluations = Evaluation::all(); 
        return view('evaluations.index', compact('evaluations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $docenteId = Auth::id(); // Obtener el ID del docente autenticado
    
        // Obtener los nombres de las evaluaciones ya creadas por el docente
        $evaluacionesExistentes = Evaluation::where('docente_id', $docenteId)->pluck('nombre')->toArray();
    
        // Todos los tipos de evaluaciones posibles
        $tiposEvaluaciones = [
            'Evaluación Cruzada',
            'Autoevaluación',
            'Evaluación de Integrantes de Grupo'
        ];
    
        // Filtrar los tipos de evaluaciones que ya han sido creadas
        $tiposDisponibles = array_diff($tiposEvaluaciones, $evaluacionesExistentes);
    
        // Calcular la suma de los pesos de las evaluaciones existentes
        $pesoTotalExistente = Entregable::where('docente_id', $docenteId)->sum('peso') +
                              Evaluation::where('docente_id', $docenteId)->sum('peso');
        $pesoMaximoPermitido = 100;
        $pesoRestante = $pesoMaximoPermitido - $pesoTotalExistente;
    
        return view('evaluations.create', compact('tiposDisponibles', 'pesoRestante'));
    }
    
    
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipo_evaluacion' => 'required|string',
            'descripcion' => 'nullable|string',
            'peso' => 'required|integer|min:0|max:100',
        ]);
    
        $docenteId = Auth::id();
        $pesoMaximoPermitido = 100; // Definimos una constante para el peso máximo permitido
    
        // Calcular la suma de los pesos de los entregables y evaluaciones existentes
        $pesoTotalExistente = Entregable::where('docente_id', $docenteId)->sum('peso') +
                              Evaluation::where('docente_id', $docenteId)->sum('peso');
        $pesoNuevo = $request->input('peso');
    
        // Validar que el peso total no exceda el máximo permitido
        if ($pesoTotalExistente + $pesoNuevo > $pesoMaximoPermitido) {
            return back()->withErrors(['peso' => 'El peso total de los entregables y evaluaciones no puede exceder de ' . $pesoMaximoPermitido . '.']);
        }
    
        // Crear la nueva evaluación
        $evaluation = Evaluation::create([
            'docente_id' => $docenteId,
            'nombre' => $request->input('tipo_evaluacion'),
            'descripcion' => $request->input('descripcion'),
            'peso' => $request->input('peso'),
        ]);
    
        // Asignar la evaluación cruzada a los grupos si corresponde
        if ($evaluation->nombre === 'Evaluación Cruzada') {
            $this->assignCrossEvaluationToGroups($evaluation);
        }
    
        // Asignar autoevaluación a los estudiantes si corresponde
        if ($evaluation->nombre === 'Autoevaluación') {
            $this->assignSelfEvaluationToStudents($evaluation);
        }
    
        // Asignar evaluaciones de integrantes de grupo si corresponde
        if ($evaluation->nombre === 'Evaluación de Integrantes de Grupo') {
            $this->assignGroupMemberEvaluations($evaluation);
        }
    
        return redirect()->route('evaluations.index')->with('success', 'Evaluación creada correctamente.');
    }
    
    protected function assignCrossEvaluationToGroups(Evaluation $evaluation)
    {
        $grupos = Grupo::all();
        foreach ($grupos as $grupo) {
            foreach ($grupos as $otroGrupo) {
                if ($grupo->id !== $otroGrupo->id) {
                    Crossevaluation::create([
                        'grupo_id' => $grupo->id,
                        'grupo_calificado_id' => $otroGrupo->id,
                        'evaluation_id' => $evaluation->id,
                    ]);
                }
            }
        }
    }
    
    protected function assignSelfEvaluationToStudents(Evaluation $evaluation)
    {
        $docente = Auth::user();
        $asignaciones = Assignment::where('docente_id', $docente->id)->with('estudiante')->get();
    
        foreach ($asignaciones as $asignacion) {
            $student = $asignacion->estudiante; // Obtener el estudiante desde la asignación
            if ($student) { // Verificar que el estudiante exista
                Selfevaluation::create([
                    'evaluation_id' => $evaluation->id,
                    'user_id' => $student->id,
                ]);
            }
        }
    }
    
    protected function assignGroupMemberEvaluations(Evaluation $evaluation)
    {
        $grupos = Grupo::all();
        foreach ($grupos as $grupo) {
            foreach ($grupo->users as $evaluator) {
                foreach ($grupo->users as $evaluatee) {
                    if ($evaluator->id !== $evaluatee->id) {
                        GroupMemberEvaluation::create([
                            'evaluator_id' => $evaluator->id,
                            'evaluatee_id' => $evaluatee->id,
                            'evaluation_id' => $evaluation->id,
                        ]);
                    }
                }
            }
        }
    }
    
    
    
    
    

    /**
     * Display the specified resource.
     */
    public function show(Evaluation $evaluation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evaluation $evaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluation $evaluation)
    {
        //
    }
}
