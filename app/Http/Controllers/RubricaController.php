<?php   



namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Rubrica;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TareaRequest;
use App\Http\Requests\RubricaRequest;
use App\Models\Entregable;
use App\Models\Grupo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\RubricaCriterio;
use App\Models\RubricaNivel;
class RubricaController extends Controller
{
           
    public function store(RubricaRequest  $request): RedirectResponse
    {
        
        // Crear la rúbrica
        $rubrica = Rubrica::create([
            'titulo' => $request->input('titulo'),
           // 'tarea_id' => $request->input('tarea_id') // Opcional si quieres asociarla a una tarea
        ]);

        // Recorrer los criterios para guardarlos
        foreach ($request->input('criterios', []) as $criterioData) {
            // Crear cada criterio asociado a la rúbrica
            $criterio = RubricaCriterio::create([
                'rubrica_id' => $rubrica->id,
                'titulo_criterio' => $criterioData['titulo_criterio'],
                'peso' => $criterioData['peso'],
                'descripcion' => $criterioData['descripcion'] ?? null
            ]);

            // Recorrer los niveles dentro de cada criterio
            foreach ($criterioData['niveles'] as $nivelData) {
                RubricaNivel::create([
                    'criterio_id' => $criterio->id,
                    'nombre_nivel' => $nivelData['nombre_nivel'],
                    'puntuacion' => $nivelData['puntuacion'],
                    'descripcion' => $nivelData['descripcion'] ?? null
                ]);
            }
        }

        return redirect()->route('tareas.create', ['ultimaRubricaId' => $rubrica->id])
            ->with('success', 'Rúbrica creada y lista para asignar a la tarea.');
    }
    
}