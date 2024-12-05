<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Crossevaluation;
use App\Models\GroupMemberEvaluation;
use App\Models\Grupo;
use App\Models\Qualification;

use App\Models\Selfevaluation;

use App\Models\Asistencia;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estudianteId = Auth::id();
        $docenteId = DB::table('grupo_user')
            ->where('user_id', $estudianteId)
            ->join('grupos', 'grupo_user.grupo_id', '=', 'grupos.id')
            ->pluck('grupos.docente_id')
            ->first();
    
        if (!$docenteId) {
            return view('grupos.index', ['grupos' => collect()])->with('error', 'No tienes un docente asignado.');
        }
    
        $grupos = Grupo::where('docente_id', $docenteId)->get();
    
        return view('grupos.index', compact('grupos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
    // Obtener IDs de compañeros seleccionados
    $companerosIds = $request->input('companeros', []);

    // Obtener los compañeros por sus IDs
    $companeros = User::whereIn('id', $companerosIds)->get();

    return view('grupos.create', compact('companeros'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'required|unique:grupos,nombre',
            'descripcion' => 'nullable|string',
            'estudiantes' => 'required|array',
           // 'solvencia_tecnica' => 'required|file|mimes:pdf|max:2048',
           // 'boleta_garantia' => 'required|file|mimes:pdf|max:2048',
        ]);
    
        // Almacenar los archivos
       // $solvenciaPath = $request->file('solvencia_tecnica')->store('solvencias', 'public');
       // $boletaPath = $request->file('boleta_garantia')->store('boletas', 'public');
    
        // Obtener el ID del estudiante que está creando el grupo
        $estudianteId = Auth::id();
    
        // Obtener el docente_id asociado al estudiante
        $docenteId = Assignment::where('estudiante_id', $estudianteId)->value('docente_id');
    
        // Verificar que se haya encontrado un docente
        if (!$docenteId) {
            return redirect()->route('grupos.index')->with('error', 'No se pudo encontrar el docente asociado al estudiante.');
        }
    
        // Crear el grupo
        $grupo = Grupo::create([
            'docente_id' => $docenteId, // Asignar el docente correspondiente al estudiante
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
           // 'solvencia_tecnica' => $solvenciaPath,
          //  'boleta_garantia' => $boletaPath,
            'estado' => false, // Estado inicial
        ]);
    
        // Asociar estudiantes al grupo
        foreach ($request->estudiantes as $estudianteId) {
            $grupo->users()->attach($estudianteId, ['rol' => 'Rol en Scrum']); // Ajusta el rol según sea necesario
        }
    
        return redirect()->route('grupos.index')->with('success', 'Grupo creado exitosamente.');
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $grupo = Grupo::findOrFail($id);
    
        // Suponiendo que tienes el ID del estudiante, por ejemplo, el ID del estudiante autenticado
        $estudianteId = Auth::id();
    
        // Verifica si el estudiante pertenece al grupo
        $estudianteEnGrupo = Grupo::whereExists(function ($query) use ($estudianteId, $grupo) {
            $query->select(DB::raw(1))
                ->from('users')
                ->join('grupo_user', 'users.id', '=', 'grupo_user.user_id')
                ->where('grupo_user.grupo_id', $grupo->id) // Especifica el ID del grupo actual
                ->where('users.id', $estudianteId); // Verifica el ID del estudiante
        })->exists();
    
        return view('grupos.show', compact('grupo', 'estudianteEnGrupo'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    // Habilitar un grupo
/* public function habilitar($id)
{
    $grupo = Grupo::findOrFail($id);
    $grupo->estado = true;
    $grupo->save();

    return redirect()->route('grupos.index')->with('success', 'Grupo habilitado exitosamente.');
}
 */

 public function viewGroups(): View
 {
     // Obtener el id del docente autenticado
     $docenteId = Auth::id();
 
     // Obtener los grupos que pertenecen al docente autenticado con los usuarios asociados
     $grupos = Grupo::with('users')->where('docente_id', $docenteId)->get();
 
     return view('docente.grupos', compact('grupos'));
 }
 
 

/* public function updateStatus(Request $request, $id)
{
    $grupo = Grupo::findOrFail($id);
    // Cambiar el estado del grupo: si es true lo cambia a false y viceversa
    $grupo->estado = !$grupo->estado; // Cambiar estado
    $grupo->save();

    return redirect()->route('docente.grupos')->with('success', 'Estado del grupo actualizado.');
} */




public function updateStatus($id)
{
    $grupo = Grupo::findOrFail($id);
    $grupo->estado = !$grupo->estado;
    $grupo->save();

    // Verificar si el permiso existe y crearlo si no
    if (!Permission::where('name', 'view-proyecto')->exists()) {
        Permission::create(['name' => 'view-proyecto', 'guard_name' => 'web']);
    }

    // Asignar o revocar el permiso a los usuarios del grupo
    if ($grupo->estado == true) {
        foreach ($grupo->users as $user) {
            $user->givePermissionTo('view-proyecto');
        }
    } else {
        foreach ($grupo->users as $user) {
            $user->revokePermissionTo('view-proyecto');
        }
    }

    $estadoMensaje = $grupo->estado ? 'activo' : 'inactivo';
    return redirect()->route('docente.grupos')->with('success', "Estado del grupo actualizado a $estadoMensaje.");
}



public function verEntregas($id): View
{
    $grupo = Grupo::with(['entregas.tarea', 'entregas.user'])->findOrFail($id);
    return view('docente.verEntregas', compact('grupo'));
}


 
public function verCalificaciones($grupoId)
{
    $grupo = Grupo::findOrFail($grupoId);

    // Obtener los entregables únicos asociados al grupo
    $entregables = $grupo->entregas->map(function ($entrega) {
        return $entrega->tarea->entregable;
    })->unique('id');

    // Obtener las calificaciones asociadas a las entregas del grupo
    $calificaciones = Qualification::whereIn('entrega_id', $grupo->entregas->pluck('id'))->get();

    // Obtener las evaluaciones cruzadas asociadas al grupo
    $evaluacionesCruzadas = Crossevaluation::where('grupo_calificado_id', $grupoId)->get();

    // Obtener las autoevaluaciones asociadas a los estudiantes del grupo
    $selfevaluations = Selfevaluation::whereIn('user_id', $grupo->users->pluck('id'))->get();

    // Obtener las evaluaciones de integrantes de grupo
    $groupMemberEvaluations = GroupMemberEvaluation::whereIn('evaluatee_id', $grupo->users->pluck('id'))->get();

    // Calcular el promedio de las notas de las evaluaciones cruzadas
    $promedioEvaluacionesCruzadas = round($evaluacionesCruzadas->avg('nota'));

    // Calcular el promedio de las evaluaciones de integrantes de grupo por estudiante
    $promediosEvaluacionesGrupo = $groupMemberEvaluations->groupBy('evaluatee_id')->map(function ($evaluations) {
        return round($evaluations->avg('nota'));
    });

    // Calcular el total de las notas por estudiante (entregables, evaluaciones cruzadas, autoevaluaciones y evaluaciones de grupo)
    $totales = collect($grupo->users)->mapWithKeys(function ($user) use ($calificaciones, $promedioEvaluacionesCruzadas, $selfevaluations, $promediosEvaluacionesGrupo) {
        $notaEntregables = round($calificaciones->where('user_id', $user->id)->sum('nota'));
        $notaAutoevaluacion = round($selfevaluations->where('user_id', $user->id)->sum('nota'));
        $notaEvaluacionesGrupo = $promediosEvaluacionesGrupo[$user->id] ?? 0;
        $notaTotal = $notaEntregables + $promedioEvaluacionesCruzadas + $notaAutoevaluacion + $notaEvaluacionesGrupo;
        return [$user->id => round($notaTotal)];
    });
   $asistencias = Asistencia::where('grupo_id', $grupoId)->get();

    return view('grupos.verCalificaciones', compact('grupo', 'entregables', 'calificaciones', 'evaluacionesCruzadas', 'selfevaluations', 'groupMemberEvaluations', 'totales', 'promedioEvaluacionesCruzadas', 'promediosEvaluacionesGrupo',, 'asistencias'));
}




public function verTodasLasEvaluaciones($grupoId)
{
    $grupo = Grupo::findOrFail($grupoId);

    // Obtener los datos necesarios para las evaluaciones
    $evaluacionesCruzadas = Crossevaluation::where('grupo_calificado_id', $grupoId)->get();
    $promedioEvaluacionesCruzadas = round($evaluacionesCruzadas->avg('nota'));
    $selfevaluations = Selfevaluation::whereIn('user_id', $grupo->users->pluck('id'))->get();
    $groupMemberEvaluations = GroupMemberEvaluation::whereIn('evaluatee_id', $grupo->users->pluck('id'))->get();
    $promediosEvaluacionesGrupo = $groupMemberEvaluations->groupBy('evaluatee_id')->map(function ($evaluations) {
        return round($evaluations->avg('nota'));
    });

    return view('grupos.verTodasLasEvaluaciones', compact('grupo', 'evaluacionesCruzadas', 'promedioEvaluacionesCruzadas', 'selfevaluations', 'groupMemberEvaluations', 'promediosEvaluacionesGrupo'));
}











}
