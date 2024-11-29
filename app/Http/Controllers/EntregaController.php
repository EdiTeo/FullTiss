<?php

namespace App\Http\Controllers;

use App\Models\Entrega;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\EntregaRequest;
use App\Models\Grupo;
use App\Models\Tarea;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class EntregaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $user = Auth::user();

        $grupoIds = $user->grupo->pluck('id')->toArray();

        $entregas = Entrega::whereIn('grupo_id', $grupoIds)->paginate();


        return view('entrega.index', compact('entregas'))
            ->with('i', ($request->input('page', 1) - 1) * $entregas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View|RedirectResponse
    {
        $tarea_id = $request->input('tarea_id');
        $user = Auth::user(); // Obtener el usuario autenticado
        if ($this->hasSubmittedTask($tarea_id)) {
            return Redirect::back()->with('warning', 'Ya has entregado esta tarea.');
        }
        $entrega = new Entrega();
         
        $tarea = Tarea::find($tarea_id); //Obtener la información de la tarea
    
        // Buscar el grupo al que pertenece el usuario
        $grupo = Grupo::whereHas('usuarios', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->first();
        
        return view('entrega.create', compact('entrega', 'tarea', 'user', 'grupo'));
    }
    /**
     * Verifica que un estudiante solo entregue una tarea y no varias veces la misma tarea
     */
    public function hasSubmittedTask($tareaId): bool
    {
        $user = Auth::user();

        //Obtener el grupo del usuario autenticado
        $grupo = Grupo::whereHas('usuarios', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->first();

        //Si el usuario no pertenece a un grupo, permitir la entrega
        if (!$grupo) {
            return false;
        }

        //Verificar si el grupo ya entregó esta tarea
        return Entrega::where('grupo_id', $grupo->id)
                    ->where('tarea_id', $tareaId)
                    ->exists();
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(EntregaRequest $request): RedirectResponse
    {
        $validated = $request->validated();
    
        // Manejar la subida del archivo
        if ($request->hasFile('archivo')) {
            $archivoPath = $request->file('archivo')->store('archivos', 'public'); // Guardar el archivo en el directorio 'archivos' en el storage público
            $validated['archivo'] = $archivoPath; // Actualizar el campo 'archivo' con la ruta del archivo almacenado
        }
    
        Entrega::create($validated);
    
        return Redirect::route('entregas.index')
            ->with('success', 'Entrega created successfully.');
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $entrega = Entrega::find($id);

        return view('entrega.show', compact('entrega'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $entrega = Entrega::find($id);
        $user = Auth::user(); // Obtener el usuario autenticado
        $tarea = $entrega->tarea; // Obtener la tarea relacionada con la entrega
        $grupo = $entrega->grupo; // Obtener el grupo relacionado con la entrega
    
        return view('entrega.edit', compact('entrega', 'tarea', 'user', 'grupo'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(EntregaRequest $request, $id): RedirectResponse
    {
        $entrega = Entrega::find($id);
        $entrega->update($request->validated());
    
        return Redirect::route('entregas.index')
            ->with('success', 'Entrega updated successfully.');
    }
    

    public function destroy($id): RedirectResponse
    {
        Entrega::find($id)->delete();

        return Redirect::route('entregas.index')
            ->with('success', 'Entrega deleted successfully');
    }
}
