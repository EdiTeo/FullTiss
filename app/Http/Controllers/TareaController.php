<?php

namespace App\Http\Controllers;
use App\Models\Rubrica;
use App\Models\Tarea;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TareaRequest;
use App\Models\Entregable;
use App\Models\Grupo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\RubricaCriterio;
use App\Models\RubricaNivel;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $docente = Auth::user();
        // Cargar las relaciones 'docente' y 'entregable'
        $tareas = Tarea::where('docente_id', $docente->id)
            ->with(['docente', 'entregable'])
            ->paginate();

        return view('tarea.index', compact('tareas'))
            ->with('i', ($request->input('page', 1) - 1) * $tareas->perPage());
    }


    




    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
        {
            $docente = Auth::user();
            $entregables = Entregable::where('docente_id', $docente->id)->get();
            $tarea = new Tarea();
            $ultimaRubricaId = $request->get('ultimaRubricaId'); // Captura la rúbrica recién creada
            $rubricas = Rubrica::whereNull('tarea_id')->get(); // Rúbricas sin asignar

            return view('tarea.create', compact('tarea', 'docente', 'entregables', 'rubricas', 'ultimaRubricaId'));
        }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(TareaRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['docente_id'] = Auth::id();
    
        // Crear la tarea
        $tarea = Tarea::create($data);
    
        // Asignar la rúbrica seleccionada a la tarea
        if ($request->filled('rubrica_id')) {
            $rubrica = Rubrica::find($request->rubrica_id);
            $rubrica->tarea_id = $tarea->id;
            $rubrica->save();
        }
    
        // Asignar tarea a los grupos activos del docente
        $docenteId = Auth::id();
        $gruposActivos = Grupo::where('docente_id', $docenteId)
                    ->where('estado', true)
                    ->get();

        $tarea->grupos()->attach($gruposActivos->pluck('id'));
    
        return Redirect::route('tareas.index')
                            ->with('success', 'Tarea creada exitosamente.');
    }
    
    
    

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $tarea = Tarea::with('rubricas.criterios.niveles')->findOrFail($id);//modificando with('rubricas')->

        return view('tarea.show', compact('tarea'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarea $tarea): View
    {
        $docente = Auth::user();
        $entregables = Entregable::where('docente_id', $docente->id)->get();
        $rubricas = $tarea->rubricas;
        $rubricaAsignada = $tarea->rubricas->first();

        return view('tarea.edit', compact('tarea', 'docente', 'entregables', 'rubricas', 'rubricaAsignada'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->update($request->only(['nombre', 'descripcion', 'peso', 'fecha_inicio', 'fecha_limite']));

        // Actualización de rúbricas, criterios y niveles (si es necesario)
        foreach ($request->input('rubricas', []) as $rubricaId => $rubricaData) {
            $rubrica = Rubrica::findOrFail($rubricaId);
            $rubrica->update(['titulo' => $rubricaData['titulo']]);

            foreach ($request->input('criterios', []) as $criterioId => $criterioData) {
                $criterio = RubricaCriterio::findOrFail($criterioId);
                $criterio->update(['titulo_criterio' => $criterioData['titulo_criterio'], 'peso' => $criterioData['peso']]);

                foreach ($request->input('niveles', []) as $nivelId => $nivelData) {
                    $nivel = RubricaNivel::findOrFail($nivelId);
                    $nivel->update(['nombre_nivel' => $nivelData['nombre_nivel'], 'puntuacion' => $nivelData['puntuacion'], 'descripcion' => $nivelData['descripcion']]);
                }
            }
        }

        // Reasignar tarea a los grupos activos
        $docenteId = Auth::id();
        $gruposActivos = Grupo::where('docente_id', $docenteId)
                               ->where('estado', true)
                               ->get();
        $tarea->grupos()->sync($gruposActivos->pluck('id'));
        
        return redirect()->route('tareas.show', $tarea->id)->with('success', 'Tarea actualizada exitosamente.');
    }

    
    

    public function destroy($id): RedirectResponse
    {
        Tarea::find($id)->delete();

        return Redirect::route('tareas.index')
            ->with('success', 'Tarea deleted successfully');
    }
    public function crearRubrica()
    {
        $tarea = new Tarea();
        return view('tarea.crearubrica');
    }


}