<?php 
namespace App\Http\Controllers;

use App\Models\Seguimiento;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Grupo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SeguimientoController extends Controller
{
    /**
     * Mostrar los seguimientos del estudiante autenticado.
     */
    public function indexEstudiante(Request $request): View
    {
        $user = Auth::user();

        // Verificar si el usuario tiene grupos asociados
        if (!$user->grupos || $user->grupos->isEmpty()) {
            return redirect()->route('home')->with('warning', 'No tienes grupos asignados.');
        }

        // Obtener los IDs de los grupos
        $grupoIds = $user->grupos->pluck('id')->toArray();

        // Obtener los seguimientos relacionados
        $registros = Seguimiento::whereIn('grupo_id', $grupoIds)->paginate();

        return view('estudiante.seguimiento.index', compact('registros'))
            ->with('i', ($request->input('page', 1) - 1) * $registros->perPage());
    }

    /**
     * Mostrar los seguimientos asociados a los grupos del docente.
     */
    public function indexDocente(Request $request): View
    {
        $docente = Auth::user();

        // Obtener los seguimientos relacionados con los grupos del docente
        $registros = Seguimiento::with('user', 'grupo')
            ->whereHas('grupo', function ($query) use ($docente) {
                $query->where('docente_id', $docente->id);
            })
            ->paginate();

        return view('docente.seguimiento.index', compact('registros'))
            ->with('i', ($request->input('page', 1) - 1) * $registros->perPage());
    }

    /**
     * Crear un nuevo seguimiento.
     */
    public function create(Request $request): View|RedirectResponse
    {
        $grupo_id = $request->input('grupo_id');
        $user = Auth::user();

        // Verificar si ya existe un seguimiento para la misma fecha
        if ($this->hasDuplicateRecord($grupo_id, $request->input('fecha'))) {
            return Redirect::back()->with('warning', 'Ya existe un seguimiento para esta fecha.');
        }

        $seguimiento = new Seguimiento();

        return view('estudiante.seguimiento.create', compact('seguimiento', 'grupo_id', 'user'));
    }

    /**
     * Verifica si ya existe un seguimiento para la misma fecha y grupo.
     */
    public function hasDuplicateRecord($grupoId, $fecha): bool
    {
        return Seguimiento::where('grupo_id', $grupoId)
            ->where('fecha', $fecha)
            ->exists();
    }

    /**
     * Almacenar un seguimiento.
     */
    public function storeEstudiante(Request $request): RedirectResponse
    {
        $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
            'fecha' => 'required|date',
            'presentado' => 'required|string',
            'pendiente' => 'required|string',
        ]);

        $seguimiento = Seguimiento::create([
            'user_id' => Auth::id(),
            'grupo_id' => $request->input('grupo_id'),
            'fecha' => $request->input('fecha'),
            'presentado' => $request->input('presentado'),
            'pendiente' => $request->input('pendiente'),
        ]);

        return Redirect::route('estudiante.seguimiento.index')
            ->with('success', 'Seguimiento registrado exitosamente.');
    }

    /**
     * Mostrar un seguimiento específico al docente.
     */
    public function showRegistro($id): View
    {
        $registro = Seguimiento::where('id', $id)
            ->whereHas('grupo', function ($query) {
                $query->where('docente_id', Auth::id());
            })
            ->firstOrFail();

        return view('docente.seguimiento.show', compact('registro'));
    }

    /**
     * Editar un seguimiento.
     */
    public function edit($id): View
    {
        $seguimiento = Seguimiento::find($id);

        // Validar que el seguimiento pertenece al usuario o grupo autorizado
        if (!$seguimiento || $seguimiento->user_id !== Auth::id()) {
            abort(403, 'No estás autorizado para editar este seguimiento.');
        }

        return view('estudiante.seguimiento.edit', compact('seguimiento'));
    }

    /**
     * Actualizar un seguimiento.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'fecha' => 'required|date',
            'presentado' => 'required|string',
            'pendiente' => 'required|string',
        ]);

        $seguimiento = Seguimiento::find($id);

        if (!$seguimiento || $seguimiento->user_id !== Auth::id()) {
            abort(403, 'No estás autorizado para actualizar este seguimiento.');
        }

        $seguimiento->update($request->all());

        return Redirect::route('estudiante.seguimiento.index')
            ->with('success', 'Seguimiento actualizado exitosamente.');
    }

    /**
     * Eliminar un seguimiento.
     */
    public function destroy($id): RedirectResponse
    {
        $seguimiento = Seguimiento::find($id);

        if (!$seguimiento || $seguimiento->user_id !== Auth::id()) {
            abort(403, 'No estás autorizado para eliminar este seguimiento.');
        }

        $seguimiento->delete();

        return Redirect::route('estudiante.seguimiento.index')
            ->with('success', 'Seguimiento eliminado exitosamente.');
    }
}
