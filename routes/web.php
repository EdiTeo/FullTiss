<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\CrossevaluationController;
use App\Http\Controllers\EntregableController;
use App\Http\Controllers\EntregaController;
use App\Http\Controllers\RubricaController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\GroupMemberEvaluationController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SprintController;
use App\Http\Controllers\SprintareaController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\ProductBacklogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewcompController;
use App\Http\Controllers\AsistenciaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\SelfevaluationController;

Route::get('/', function () {
    return redirect()->route('login');
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

Route::get('/product-backlog', [ProductBacklogController::class, 'index'])->name('product-backlog.index');

Route::resource('sprintarea', SprintareaController::class)
    ->except(['show'])
    ->names([
        'index' => 'sprintarea.index',
        'create' => 'sprintarea.create',
        'store' => 'sprintarea.store',
        'edit' => 'sprintarea.edit',
        
        'destroy' => 'sprintarea.destroy',
    ]);
    Route::get('/sprints/assign', [SprintController::class, 'assign'])->name('sprints.assign');
    Route::delete('/sprintarea/{id}', [SprintareaController::class, 'destroy'])->name('sprintarea.destroy');
    Route::put('/sprintarea/{id}', [SprintAreaController::class, 'update'])->name('sprintarea.update');


    Route::resource('entregables', EntregableController::class);
    Route::resource('tareas', TareaController::class);


        Route::get('/estudiante/entregables', [EstudianteController::class, 'entregables'])->name('estudiante.entregables');
        Route::get('/estudiante/entregables/{id}/tareas', [EstudianteController::class, 'tareas'])->name('estudiante.tareas');
    
 
        Route::resource('entregas', EntregaController::class);

// Rutas adicionales para mostrar detalles de la tarea y subir archivos
Route::get('/detalles-tarea/{id}', [TareaController::class, 'show'])->name('detalles-tarea');
Route::post('/subir-archivo/{id}', [TareaController::class, 'subirArchivo'])->name('subir-archivo');
Route::post('/tareas', [TareaController::class, 'store'])->name('tarea.store');
Route::post('/rubricas', [RubricaController::class, 'store'])->name('rubrica.store');
//Route::get('/tarea/crearubrica', [TareaController::class, 'crearRubrica'])->name('tarea.crearubrica');
//Route::get('/tarea/crearubrica/{tareaId}', [TareaController::class, 'crearRubrica'])->name('tarea.crearubrica');
Route::get('/tarea/crear-rubrica', [TareaController::class, 'crearRubrica'])->name('tarea.crearubrica');



Route::get('grupos/{id}/entregas', [GrupoController::class, 'verEntregas'])->name('grupos.verEntregas');

Route::resource('qualifications', QualificationController::class);


Route::get('grupos/{grupo}/calificaciones', [GrupoController::class, 'verCalificaciones'])->name('grupos.verCalificaciones');





// Definir las rutas para index, create y store
Route::resource('crossevaluations', CrossevaluationController::class)->only(['index', 'store']);

// Definir una ruta específica para create con los parámetros necesarios
Route::get('crossevaluations/create/{evaluation}/{grupo_calificado_id}', [CrossevaluationController::class, 'create'])->name('crossevaluations.create');

// Definir una ruta para mostrar los promedios de calificaciones
Route::get('crossevaluations/averages', [CrossevaluationController::class, 'showAverages'])->name('crossevaluations.averages');


Route::resource('evaluations', EvaluationController::class);



    Route::get('selfevaluations/create/{evaluation}', [SelfevaluationController::class, 'create'])->name('selfevaluations.create');
    Route::post('selfevaluations', [SelfevaluationController::class, 'store'])->name('selfevaluations.store');
    Route::get('selfevaluations', [SelfevaluationController::class, 'index'])->name('selfevaluations.index');

        Route::get('group_member_evaluations/create/{evaluation}/{evaluatee}', [GroupMemberEvaluationController::class, 'create'])->name('group_member_evaluations.create');
        Route::post('group_member_evaluations', [GroupMemberEvaluationController::class, 'store'])->name('group_member_evaluations.store');
        Route::get('group_member_evaluations', [GroupMemberEvaluationController::class, 'index'])->name('group_member_evaluations.index');
 


    Route::get('grupos/{grupo}/evaluaciones', [GrupoController::class, 'verTodasLasEvaluaciones'])->name('grupos.verTodasLasEvaluaciones');

        Route::get('mis-calificaciones', [QualificationController::class, 'verMisCalificaciones'])->name('qualifications.mis');
    
        Route::post('asistencias/guardar/{grupoId}/{userId}', [AsistenciaController::class, 'registrarAsistenciaIndividual'])->name('asistencias.guardarIndividuo');

});
 //SOLO PARA EL SEGUIMIENTO O MODULO REQUERIMIENTO 8 C*
//Route::delete('permissions/{permissionId}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
//Route::post('/seguimientos/{sprintId}', [SeguimientoController::class, 'store'])->name('seguimientos.store');
Route::delete('/seguimientos/{id}', [SeguimientoController::class, 'destroy'])->name('seguimientos.destroy');

//Route::get('/seguimientos/create', [SeguimientoController::class, 'create'])->name('seguimientos.create');
Route::resource('seguimientos', SeguimientoController::class);
Route::post('/seguimientos', [SeguimientoController::class, 'store'])->name('seguimientos.store');
Route::get('/seguimientos/{seguimientos}/edit', [SeguimientoController::class, 'edit'])->name('seguimientos.edit');
Route::put('/seguimientos/{seguimiento}', [SeguimientoController::class, 'update'])->name('seguimientos.update');

///para la Asistencia::
Route::get('/grupos/{grupoId}/asistencias/registrar', [AsistenciaController::class, 'formRegistrarAsistencia'])->name('asistencias.registrar');
Route::post('/grupos/{grupoId}/asistencias', [AsistenciaController::class, 'registrarAsistencia'])->name('asistencias.guardar');
Route::get('/grupos/{grupoId}/asistencias', [AsistenciaController::class, 'listaAsistencia'])->name('asistencias.lista');
Route::get('grupos/{grupoId}/calificaciones', [AsistenciaController::class, 'listaAsistencia'])->name('grupos.verCalificaciones');
