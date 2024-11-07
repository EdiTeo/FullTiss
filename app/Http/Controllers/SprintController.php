<?php

namespace App\Http\Controllers;

use App\Models\Sprint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\SprintRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SprintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index(Request $request): View
    {
        $user = Auth::user();
        $grupoId = $user->grupo->first()->id; // Obtener el id del primer grupo del usuario
    
        // Filtrar los sprints solo para el grupo del usuario autenticado
        $sprints = Sprint::where('grupo_id', $grupoId)->paginate();
    
        return view('sprint.index', compact('sprints'))
            ->with('i', ($request->input('page', 1) - 1) * $sprints->perPage());
    }
    
    /**
     * Show the form for creating a new resource.
     */

    
        
     public function create(): View
     {
         $user = Auth::user();
         $grupo = $user->grupo->first();
     
         if (!$grupo) {
             return redirect()->route('sprints.index')->with('error', 'El usuario no tiene un grupo asignado.');
         }
     
         $userName = $user->name;
         $grupoName = $grupo->nombre;
     
         return view('sprint.create', compact('grupoName', 'userName'));
     }
     
     
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(SprintRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $grupoId = $user->grupo->first()->id; // Obtener el id del primer grupo del usuario
    
        Sprint::create([
            'nombre' => $request->nombre,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'grupo_id' => $grupoId, // Asignar grupo_id automáticamente
            'user_id' => $user->id, // Asignar user_id automáticamente
        ]);
    
        return Redirect::route('sprints.index')
            ->with('success', 'Sprint creado exitosamente.');
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $sprint = Sprint::find($id);

        return view('sprint.show', compact('sprint'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $user = Auth::user();
        $sprint = Sprint::find($id);
    
        if (!$sprint || $sprint->grupo_id !== $user->grupo->first()->id) {
            return redirect()->route('sprints.index')->with('error', 'No tienes permiso para editar este sprint.');
        }
    
        return view('sprint.edit', compact('sprint'));
    }
    
     

    /**
     * Update the specified resource in storage.
     */
    public function update(SprintRequest $request, $id): RedirectResponse
    {
        $user = Auth::user();
        $sprint = Sprint::find($id);
    
        if (!$sprint || $sprint->grupo_id !== $user->grupo->first()->id) {
            return redirect()->route('sprints.index')->with('error', 'No tienes permiso para actualizar este sprint.');
        }
    
        $sprint->update([
            'nombre' => $request->nombre,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin
        ]);
    
        return Redirect::route('sprints.index')
            ->with('success', 'Sprint actualizado exitosamente.');
    }
    
    
    public function destroy($id): RedirectResponse
    {
        Sprint::find($id)->delete();

        return Redirect::route('sprints.index')
            ->with('success', 'Sprint deleted successfully');
    }
}
