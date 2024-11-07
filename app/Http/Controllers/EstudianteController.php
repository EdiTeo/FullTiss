<?php

namespace App\Http\Controllers;

use App\Models\Entregable;
use App\Models\Grupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class EstudianteController extends Controller
{
    //
 
    public function entregables(): View
    {
        $estudianteId = Auth::id();
        $docenteId = DB::table('grupo_user')
            ->where('user_id', $estudianteId)
            ->join('grupos', 'grupo_user.grupo_id', '=', 'grupos.id')
            ->pluck('grupos.docente_id')
            ->first();
    
        if (!$docenteId) {
            return view('estudiante.entregables', ['entregables' => collect()])->with('error', 'No tienes un docente asignado.');
        }
    
        $entregables = Entregable::where('docente_id', $docenteId)->get();
    
        return view('estudiante.entregables', compact('entregables'));
    }

    public function tareas($entregableId): View
{
    $estudianteId = Auth::id();
    $gruposActivos = Grupo::whereHas('users', function ($query) use ($estudianteId) {
        $query->where('user_id', $estudianteId);
    })->where('estado', true)
      ->with(['tareas' => function ($query) use ($entregableId) {
          $query->where('entregable_id', $entregableId);
      }])
      ->get();

    return view('estudiante.tareas', compact('gruposActivos'));
}

    
    
}
