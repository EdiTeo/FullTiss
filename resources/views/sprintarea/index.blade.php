@extends('adminlte::page')

@section('title', 'Lista Sprints')

@section('content_header')
    <h1 class="m-0 text-dark text-center">Lista de ítems por Sprint</h1>
@stop

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <a href="{{ route('sprintarea.create') }}" class="btn btn-primary mb-2">Añadir Tarea</a>
        <a href="{{ route('product-backlog.index') }}" class="btn btn-danger mb-2">Volver</a>
    </div>

    @foreach($sprints as $sprint)
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-info text-white">
                <h3 class="card-title">{{ $sprint->nombre }}</h3>
            </div>
            <div class="card-body">
                @if($sprint->tareas->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Prioridad</th>
                                    <th>Estado</th>
                                    <th>Estudiante</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sprint->tareas as $tarea)
                                    <tr>
                                        <td>{{ $tarea->nombre }}</td>
                                        <td>{{ $tarea->descripcion }}</td>
                                        <td>
                                            @if($tarea->prioridad == 1)
                                                <span class="badge bg-danger">Alta</span>
                                            @elseif($tarea->prioridad == 2)
                                                <span class="badge bg-warning text-dark">Media</span>
                                            @else
                                                <span class="badge bg-success">Baja</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">{{ ucfirst($tarea->estado) }}</span>
                                        </td>
                                        <td>{{ $tarea->user->name ?? 'Sin asignar' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted">No hay tareas registradas para este sprint.</p>
                @endif
            </div>
        </div>
    @endforeach
</div>
@stop
