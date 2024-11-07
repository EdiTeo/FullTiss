<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Grupo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ViewcompController extends Controller
{
    //
// Función para el dashboard del estudiante
    public function studentDashboard(): View
    {
        $estudiante = Auth::user();
        $docenteId = Assignment::where('estudiante_id', $estudiante->id)->value('docente_id');
    
        // Obtener todos los compañeros de clase
        $companeros = User::whereHas('assignment', function ($query) use ($docenteId) {
        $query->where('docente_id', $docenteId);
    })
        ->where('id', '!=', $estudiante->id) // Excluir al usuario autenticado
        ->get(['id', 'name']);

        // Agregar el usuario autenticado a la lista de compañeros
        $companeros->prepend($estudiante); // Agregar al usuario autenticado al inicio de la colección

        // Obtener los IDs de los estudiantes que ya están en grupos
        $companerosEnGrupo = Grupo::with('users')->get()->flatMap(function ($grupo) {
        return $grupo->users->pluck('id');
    })->toArray();

    return view('estudiante.dashboard', compact('companeros', 'companerosEnGrupo'));
}

        
        
    
        // Función para el dashboard del docente
        public function docenteDashboard(): View
        {
            $docente = Auth::user();
            $estudiantes = User::whereHas('assignment', function ($query) use ($docente) {
                $query->where('docente_id', $docente->id);
            })->get(['id', 'name']);
    
            return view('docente.dashboard', compact('estudiantes'));
        }
}
