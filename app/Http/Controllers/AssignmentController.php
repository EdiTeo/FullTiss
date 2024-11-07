<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AssignmentRequest;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $assignments = Assignment::with(['docente', 'estudiante'])->paginate();
        return view('assignment.index', compact('assignments'))
            ->with('i', ($request->input('page', 1) - 1) * $assignments->perPage());
    }
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $assignment = new Assignment(); 
        $docentes = User::role('docente')->get(['id', 'name']); 
        $estudiantes = User::role('estudiante')->whereDoesntHave('assignment')->get(['id', 'name']); 
        return view('assignment.create', compact('assignment', 'docentes', 'estudiantes'));
       /* $assignment = new Assignment();
        $docentes = User::pluck('name', 'id');
        return view('assignment.create', compact('assignment')); */
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'docente_id' => 'required|exists:users,id',
            'estudiante_ids' => 'required|array',
            'estudiante_ids.*' => 'exists:users,id'
        ]);
    
        foreach ($request->estudiante_ids as $estudiante_id) {
            Assignment::create([
                'docente_id' => $request->docente_id,
                'estudiante_id' => $estudiante_id
            ]);
        }
    
        return redirect()->route('assignments.index')->with('success', 'Asignaciones creadas correctamente.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $assignment = Assignment::find($id);

        return view('assignment.show', compact('assignment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $assignment = Assignment::with('estudiante')->find($id);
        $docentes = User::role('docente')->get(['id', 'name']);
        
        // Obtener estudiantes asignados al docente
        $estudiantesAsignados = Assignment::where('docente_id', $assignment->docente_id)->pluck('estudiante_id')->toArray();
        
        // Obtener todos los estudiantes y marcar los asignados como seleccionados
        $estudiantes = User::role('estudiante')->get(['id', 'name']);
        
        return view('assignment.edit', compact('assignment', 'docentes', 'estudiantes', 'estudiantesAsignados'));
    }
    
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assignment $assignment): RedirectResponse
    {
        $request->validate([
            'docente_id' => 'required|exists:users,id',
            'estudiante_ids' => 'required|array',
            'estudiante_ids.*' => 'exists:users,id'
        ]);
    
        // Eliminar asignaciones actuales de los estudiantes seleccionados
        Assignment::whereIn('estudiante_id', $request->estudiante_ids)->delete();
    
        // Luego, crear la nueva asignación para el docente seleccionado
        $assignment->update([
            'docente_id' => $request->docente_id,
        ]);
    
        foreach ($request->estudiante_ids as $estudiante_id) {
            Assignment::create([
                'docente_id' => $request->docente_id,
                'estudiante_id' => $estudiante_id
            ]);
        }
    
        return Redirect::route('assignments.index')->with('success', 'Assignment updated successfully');
    }
    
    

    public function destroy($id): RedirectResponse
    {
        Assignment::find($id)->delete();

        return Redirect::route('assignments.index')
            ->with('success', 'Assignment deleted successfully');
    }
}
