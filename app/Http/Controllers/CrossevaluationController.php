<?php

namespace App\Http\Controllers;

use App\Models\Crossevaluation;
use App\Models\Entregable;
use App\Models\Evaluation;
use App\Models\Grupo;
use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CrossevaluationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
    
        // Cargar la relación y obtener el primer grupo del usuario
        $grupo = $user->grupo->first();
        if (!$grupo) {
            return redirect()->route('home')->withErrors(['error' => 'No perteneces a ningún grupo.']);
        }
    
        $docenteId = $grupo->docente_id; // Obtener el ID del docente del grupo del usuario
    
        // Obtener todos los grupos del docente excepto el propio grupo del usuario
        $otrosGrupos = Grupo::where('docente_id', $docenteId)
                            ->where('id', '!=', $grupo->id)
                            ->get();
    
        // Obtener las evaluaciones cruzadas para verificar si ya han sido calificadas
        $evaluacionesCruzadas = Crossevaluation::where('grupo_id', $grupo->id)->get();
    
        // Obtener la evaluación cruzada asociada (ajustar según tu lógica)
        $evaluation = Evaluation::where('nombre', 'Evaluación Cruzada')->first();
    
        return view('crossevaluations.index', compact('otrosGrupos', 'evaluacionesCruzadas', 'evaluation', 'grupo'));
    }
    
    
    
    
    
    
    
    
    public function create(Evaluation $evaluation, $grupo_calificado_id)
    {
        $user = Auth::user();
    
        // Asegurarnos de que la relación se carga correctamente
        $grupo = $user->grupo->first();
        if (!$grupo) {
            return redirect()->route('crossevaluations.index')->withErrors(['error' => 'No perteneces a ningún grupo.']);
        }
    
        $grupoCalificado = Grupo::findOrFail($grupo_calificado_id);
    
        return view('crossevaluations.create', compact('evaluation', 'grupo', 'grupoCalificado'));
    }
    
    
    
    
        public function store(Request $request)
        {
            $request->validate([
                'evaluation_id' => 'required|exists:evaluations,id',
                'grupo_id' => 'required|exists:grupos,id',
                'grupo_calificado_id' => 'required|exists:grupos,id|different:grupo_id',
                'nota' => 'required|integer|min:0|max:100',
            ]);
    
            $existe = Crossevaluation::where('grupo_id', $request->grupo_id)
                                     ->where('grupo_calificado_id', $request->grupo_calificado_id)
                                     ->where('evaluation_id', $request->evaluation_id)
                                     ->exists();
    
            if ($existe) {
                return back()->withErrors(['grupo_calificado_id' => 'Tu grupo ya ha calificado a este grupo para esta evaluación.']);
            }
    
            Crossevaluation::create([
                'grupo_id' => $request->grupo_id,
                'grupo_calificado_id' => $request->grupo_calificado_id,
                'evaluation_id' => $request->evaluation_id,
                'nota' => $request->input('nota'),
                'user_id' => Auth::id(),
            ]);
    
            return redirect()->route('crossevaluations.index')->with('success', 'Calificación registrada correctamente.');
        }

    

    

    /**
     * Display the specified resource.
     */
    public function show(Crossevaluation $crossevaluation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Crossevaluation $crossevaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Crossevaluation $crossevaluation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Crossevaluation $crossevaluation)
    {
        //
    }

    public function showAverages()
{
    $docenteId = Auth::id(); // Obtener el ID del docente autenticado

    // Obtener todas las evaluaciones cruzadas para los grupos del docente
    $evaluaciones = Crossevaluation::whereHas('grupo', function ($query) use ($docenteId) {
        $query->where('docente_id', $docenteId);
    })->get();

    // Agrupar las calificaciones por grupo calificado
    $promedios = $evaluaciones->groupBy('grupo_calificado_id')->map(function ($group) {
        return [
            'grupo' => Grupo::find($group->first()->grupo_calificado_id),
            'promedio' => $group->avg('nota'),
            'calificaciones' => $group->pluck('nota')
        ];
    });

    return view('crossevaluations.averages', compact('promedios'));
}

}
