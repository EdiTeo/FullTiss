<?php

namespace App\Http\Controllers;

use App\Models\Seguimiento;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
class SeguimientoController extends Controller
{
    //Mostrar todos los seguimientos de un sprint
    public function index(Request $request): View
    {
        $user = Auth::user();
        $grupoId = $user->grupo->first()->id; //Obtener el id del primer grupo del usuario
          //  $seguimientos = Seguimiento::orderBy('fecha', 'desc')->get();
            $seguimientos = Seguimiento::where('grupo_id', $grupoId)->paginate(); 
        return view('seguimientos.index', compact('seguimientos'))
            ->with('i', ($request->input('page', 1) - 1) * $seguimientos->perPage());
       
    }

    //Formulario para crear un nuevo seguimiento
    public function create() : view
    {
        $user = Auth::user();
        $grupo = $user->grupo->first();
        $userName = $user->name;
        $grupoName = $grupo->nombre;
        return view('seguimientos.create', compact('grupoName', 'userName'));
    }

    //GUARDAR EL SEGUIMIENTO
    public function store(Request $request): RedirectResponse
        {
            $user = Auth::user();
           $grupoId = $user->grupo->first()->id; //Obtener el id del primer grupo del usuario
    
            $request->validate([
                'presentado' => 'required|string',
                'pendiente' => 'required|string',
                'fecha' => 'required|date',
            ]);

            Seguimiento::create([
               'grupo_id' => $grupoId, //Asignar grupo_id automáticamente
               'user_id' => $user->id, //Asignar user_id automáticamente
                'user_id' => Auth::id(),
                'presentado' => $request->presentado,
                'pendiente' => $request->pendiente,
                'fecha' => $request->fecha,
            ]);
            
            return Redirect::route('seguimientos.index')
                            ->with('success', 'Seguimiento registrado con éxito.');
        }


    //VER DETALLES DE UN SEGUIMIENTO
    public function show($id): View
    {
        $seguimientos = Seguimiento::find($id);
        return view('seguimientos.show', compact('seguimientos'));
    }

    //EDITAR SEGUIMIENTO
    public function  edit($id): View
    {
        $user = Auth::user();
        $seguimientos = Seguimiento::find($id);
        if (!$seguimientos || $seguimientos->grupo_id !== $user->grupo->first()->id) {
            return redirect()->route('seguimiento.index')->with('error', 'No tienes permiso para editar este seguimiento.');
        }
        return view('seguimientos.edit', compact('seguimientos'));
        
    }
    
    //ACTUALIZAR SEGUIMIENTO
    public function update(Request $request, Seguimiento $seguimiento): RedirectResponse
    {
        $user = Auth::user();

        // Verifica si el seguimiento pertenece al grupo del usuario
        if ($seguimiento->grupo_id !== $user->grupo->first()->id) {
            return redirect()->route('seguimientos.index')->with('error', 'No tienes permiso para actualizar este seguimiento.');
        }

        // Validar los datos
        $request->validate([
            'presentado' => 'required|string',
            'pendiente' => 'required|string',
            'fecha' => 'required|date',
        ]);

        // Actualizar el seguimiento
        $seguimiento->update([
            'presentado' => $request->presentado,
            'pendiente' => $request->pendiente,
            'fecha' => $request->fecha,
        ]);

        return Redirect::route('seguimientos.index')->with('success', 'Seguimiento actualizado con éxito.');
    }


    //ELIMINAR SEGUIMIENTO
    public function destroy($id): RedirectResponse
    {
        Seguimiento::find($id)->delete();
        return Redirect::route('seguimientos.index')->with('success', 'Seguimiento eliminado con éxito.');
    }
}
