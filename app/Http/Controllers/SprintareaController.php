<?php

namespace App\Http\Controllers;

use App\Models\Sprint;
use App\Models\Sprintarea;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SprintareaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\Request;
class SprintareaController extends Controller
{ 
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $user = Auth::user();

        //Obtener el grupo del usuario autenticado
        $grupo = $user->grupo->first();
    
        //Cargar solo los sprints del grupo del usuario con sus tareas relacionadas, okey
        $sprints = Sprint::with('tareas')->where('grupo_id', $grupo->id)->get();
    
        return view('sprintarea.index', compact('sprints'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $user = Auth::user();
        $grupo = $user->grupo->first(); //Obtener el grupo del usuario autenticado

        //Filtrar los sprints pertenecientes al grupo del usuario
        $sprints = Sprint::where('grupo_id', $grupo->id)->get();

        return view('sprintarea.create', compact('sprints', 'grupo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SprintareaRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $validated = $request->validate([
            'sprint_id' => 'required|exists:sprints,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'prioridad' => 'required|integer',
            'estado' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        // Verificar que el sprint pertenece al grupo del usuario
        $sprint = Sprint::where('id', $validated['sprint_id'])
            ->where('grupo_id', $user->grupo->first()->id)
            ->firstOrFail();

        Sprintarea::create([
            'nombre' => $validated['nombre'],
            'descripcion' => $validated['descripcion'],
            'prioridad' => $validated['prioridad'],
            'estado' => $validated['estado'],// Estado inicial por defecto
            'sprint_id' => $sprint->id,
            'user_id' => $user->id, // Asignar la tarea al usuario actual
        ]);

        return Redirect::route('sprintarea.index', ['id' => $sprint->id])
            ->with('success', 'Tarea creada exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $user = Auth::user();
        $tarea = Sprintarea::findOrFail($id);
    
        //Validar que la tarea pertenece al grupo al que pertenece el estudiante
        if ($tarea->sprint->grupo_id !== $user->grupo->first()->id) {
            return Redirect::route('sprintarea.index')
                ->with('error', 'No tienes permiso para editar esta tarea.');
        }
    
        //Verificar si el grupo y los sprints existen
        if (!$tarea->sprint->grupo) {
            return Redirect::route('sprintarea.index')
                ->with('error', 'El grupo del sprint no existe.');
        }
    
        //Obtener los sprints del grupo del usuario
        $sprints = $tarea->sprint->grupo->sprints; 
    
        //Si no hay sprints disponibles, redirigir con un error
        if ($sprints->isEmpty()) {
            return Redirect::route('sprintarea.index')
                ->with('error', 'No hay sprints disponibles para este grupo.');
        }
        
        //Obtener los usuarios del grupo asociado al sprint
        $usuarios = $tarea->sprint->grupo->usuarios;
    
        return view('sprintarea.edit', compact('tarea', 'usuarios', 'sprints'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'prioridad' => 'required|integer|min:1|max:3',
        'estado' => 'required|in:pendiente,en_progreso,completado',
            'user_id' => 'nullable|exists:users,id',
            'sprint_id' => 'required|exists:sprints,id',
        ]);

        $tarea = Sprintarea::findOrFail($id);

        //Log para verificar los datos
    // \Log::info('Datos enviados para la actualización:', $request->all());
        $tarea->nombre = $request->nombre;
        $tarea->descripcion = $request->descripcion;
        $tarea->prioridad = $request->prioridad;
        $tarea->estado = $request->estado;
        $tarea->user_id = $request->user_id;
        $tarea->sprint_id = $request->sprint_id;
        $tarea->save();
        $tarea->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'prioridad' => $request->prioridad,
            'estado' => $request->estado, 
            'user_id' => $request->user_id,
            'sprint_id' => $request->sprint_id,
        ]);

        return redirect()->route('sprintarea.index', ['id' => $tarea->sprint_id])
            ->with('success', 'Tarea actualizada correctamente');

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $user = Auth::user();
        $tarea = Sprintarea::findOrFail($id);

        //Validar que la tarea pertenece al grupo del usuario
        if ($tarea->sprint->grupo_id !== $user->grupo->first()->id) {
            return Redirect::route('sprintarea.index')
                ->with('error', 'No tienes permiso para eliminar esta tarea.');
        }

        $tarea->delete();

        return Redirect::route('product-backlog.index')
            ->with('success', 'Tarea eliminada exitosamente.');
    }
}
