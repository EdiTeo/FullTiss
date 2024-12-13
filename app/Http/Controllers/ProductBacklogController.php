<?php

namespace App\Http\Controllers;


use App\Models\Sprint;
use App\Models\Sprintarea;
use Illuminate\Http\RedirectResponse;
//use Illuminate\Http\SprintareaRequest;
use App\Http\Controllers\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProductBacklogController extends Controller
{
    public function index(): View
    {
        //VERIFICAR QUE ESTE AUTENTIFICADO
        $user = Auth::user();
        $grupoId = $user->grupo->first()->id; //Obtener el id del primer grupo del usuario

        //Filtrar las tareas solo para los sprints del grupo del usuario autenticado
        $tareas = Sprintarea::whereHas('sprint', function ($query) use ($grupoId) {
            $query->where('grupo_id', $grupoId);
        })->get();

        return view('product-backlog.index', compact('tareas')); // Cambia a la ruta real de tu vista
    }
}