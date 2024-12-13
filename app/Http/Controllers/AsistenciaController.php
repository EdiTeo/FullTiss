<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Grupo;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function listaAsistencia($grupoId)
    {
        $grupo = Grupo::with('users')->findOrFail($grupoId);
    
        // Obtener asistencias relacionadas con el grupo
        $asistencias = Asistencia::where('grupo_id', $grupoId)
                                 ->with('user') // Incluye los datos del usuario
                                 ->orderBy('fecha', 'desc')
                                 ->get();
    
        return view('grupos.verCalificaciones', [
            'grupo' => $grupo,
            'asistencias' => $asistencias,
        ]);
    }
    
    public function formRegistrarAsistencia($grupoId)
    {
        $grupo = Grupo::findOrFail($grupoId);
        $estudiantes = $grupo->users; // Obtén los estudiantes del grupo
        
        return view('asistencias.registrar', [
            'grupo' => $grupo,
            'estudiantes' => $estudiantes,
        ]);
    }

    public function registrarAsistencia(Request $request, $grupoId)
    {
        $grupo = Grupo::findOrFail($grupoId);
        $request->validate([
            'fechas' => 'required|array',
            'fechas.*' => 'required|date',
            'asistencias' => 'required|array',
            'asistencias.*' => 'required|in:presente,retraso,ausente_justificado,ausente_no_justificado',
            'justificaciones' => 'nullable|array',
            'justificaciones.*' => 'nullable|string|max:255',
        ]);
    
        foreach ($request->asistencias as $userId => $estado) {
            Asistencia::updateOrCreate(
                [
                    'user_id' => $userId,
                    'grupo_id' => $grupoId,
                    'fecha' => $request->fechas[$userId],
                ],
                [
                    'estado' => $estado,
                    'justificacion' => $request->justificaciones[$userId] ?? null,
                ]
            );
        }
    
        return redirect()->route('grupos.verCalificaciones', $grupoId)->with('success', 'Asistencia registrada correctamente.');
    }
    
    public function registrarAsistenciaIndividual(Request $request, $grupoId, $userId)
    {
        $grupo = Grupo::findOrFail($grupoId);
        $request->validate([
            'fecha' => 'required|date',
            'estado' => 'required|in:presente,retraso,ausente_justificado,ausente_no_justificado',
            'justificacion' => 'nullable|string|max:255',
        ]);
    
        Asistencia::updateOrCreate(
            [
                'user_id' => $userId,
                'grupo_id' => $grupoId,
                'fecha' => $request->fecha,
            ],
            [
                'estado' => $request->estado,
                'justificacion' => $request->justificacion,
            ]
        );
    
        return redirect()->route('grupos.verCalificaciones', $grupoId)->with('success', 'Asistencia registrada correctamente.');
    }
    


}
