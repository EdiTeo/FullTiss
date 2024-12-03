<?php

namespace App\Http\Controllers;

use App\Models\Sprint;
use App\Models\Sprintarea;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SprintareaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

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
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:500',
            'prioridad' => 'required|integer|min:1|max:3',
            'sprint_id' => 'required|exists:sprints,id',
        ]);

        // Verificar que el sprint pertenece al grupo del usuario
        $sprint = Sprint::where('id', $validated['sprint_id'])
            ->where('grupo_id', $user->grupo->first()->id)
            ->firstOrFail();

        Sprintarea::create([
            'nombre' => $validated['nombre'],
            'descripcion' => $validated['descripcion'],
            'prioridad' => $validated['prioridad'],
            'estado' => 'pendiente', // Estado inicial por defecto
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

        // Validar que la tarea pertenece al grupo del usuario
        if ($tarea->sprint->grupo_id !== $user->grupo->first()->id) {
            return Redirect::route('sprintarea.index')
                ->with('error', 'No tienes permiso para editar esta tarea.');
        }

        //Obtener los usuarios del grupo asociado al sprint
        $usuarios = $tarea->sprint->grupo->usuarios;

        return view('sprintarea.edit', compact('tarea', 'usuarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SprintareaRequest $request, $id): RedirectResponse
    {
        $user = Auth::user();
        $tarea = Sprintarea::findOrFail($id);

        // Validar que la tarea pertenece al grupo del usuario
        if ($tarea->sprint->grupo_id !== $user->grupo->first()->id) {
            return Redirect::route('sprintarea.index')
                ->with('error', 'No tienes permiso para actualizar esta tarea.');
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:500',
            'prioridad' => 'required|integer|min:1|max:3',
            'estado' => 'required|in:pendiente,en_progreso,completada',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $tarea->update($validated);

        return Redirect::route('sprintarea.index')
            ->with('success', 'Tarea actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $user = Auth::user();
        $tarea = Sprintarea::findOrFail($id);

        // Validar que la tarea pertenece al grupo del usuario
        if ($tarea->sprint->grupo_id !== $user->grupo->first()->id) {
            return Redirect::route('sprintarea.index')
                ->with('error', 'No tienes permiso para eliminar esta tarea.');
        }

        $tarea->delete();

        return Redirect::route('sprintarea.index')
            ->with('success', 'Tarea eliminada exitosamente.');
    }
}
