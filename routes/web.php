<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\EntregableController;
use App\Http\Controllers\EntregaController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SprintController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewcompController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/inicio', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/dashboard', function () {
        return redirect()->route('admin.index');
    })->name('dashboard');
    

    Route::resource('permissions', PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);

    Route::resource('roles', RoleController::class);
    Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole']);

    Route::resource('users', UserController::class);
    Route::get('users/{userId}/delete', [UserController::class, 'destroy']);



    Route::resource('assignments', AssignmentController::class);


    

    /*     Route::get('/ver-companeros', [UserController::class, 'verCompañeros'])->name('ver.compañeros'); */
    Route::middleware(['auth', 'role:estudiante'])->get('/dashboard/student', [ViewcompController::class, 'studentDashboard'])->name('student.dashboard');
    Route::middleware(['auth', 'role:docente'])->get('/dashboard/docente', [ViewcompController::class, 'docenteDashboard'])->name('docente.dashboard');





    Route::get('/grupos/create', [GrupoController::class, 'create'])->name('grupos.create');
    Route::post('/grupos', [GrupoController::class, 'store'])->name('grupos.store');
    Route::get('/grupos', [GrupoController::class, 'index'])->name('grupos.index');


    Route::get('/docente/grupos', [GrupoController::class, 'viewGroups'])->name('docente.grupos')->middleware('auth', 'role:docente');

    Route::patch('/grupos/{id}/update-status', [GrupoController::class, 'updateStatus'])->name('grupos.updateStatus');
    
    Route::resource('sprints', SprintController::class);

    Route::resource('entregables', EntregableController::class);
    Route::resource('tareas', TareaController::class);


        Route::get('/estudiante/entregables', [EstudianteController::class, 'entregables'])->name('estudiante.entregables');
        Route::get('/estudiante/entregables/{id}/tareas', [EstudianteController::class, 'tareas'])->name('estudiante.tareas');
    
 
        Route::resource('entregas', EntregaController::class);

// Rutas adicionales para mostrar detalles de la tarea y subir archivos
Route::get('/detalles-tarea/{id}', [TareaController::class, 'show'])->name('detalles-tarea');
Route::post('/subir-archivo/{id}', [TareaController::class, 'subirArchivo'])->name('subir-archivo');

});
