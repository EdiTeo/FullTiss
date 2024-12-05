@extends('adminlte::page')

@section('title', 'Product Backlog')

@section('content_header')
    <h1 class="m-0 text-dark">Product Backlog</h1>
@stop

@section('content')
<div class="container">
    <!-- Card para las tareas -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Lista de ítems</h3>
            <div>
                <!-- Botón para ver sprints -->
                <a href="{{ route('sprints.index') }}" class="btn btn-success" style="margin-right: 60px;">
                    <i class="fas fa-eye"></i> Ver Sprints
                </a>
                <!-- Botón para crear nueva tarea -->
                <a href="{{ route('sprintarea.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Crear Nueva Tarea
                </a>
                <a href="{{ route('sprintarea.index')}}" class="btn btn-info" style="margin-left: 60px;">
                    <i class="fas fa-tasks"></i> Tareas por Sprint
                </a>
                
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Prioridad</th>
                      <!-- <th>Sprint</th>-->  
                        <th>Asignado a</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tareas as $tarea)
                        <tr> 
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tarea->nombre }}</td>
                            <td>{{ $tarea->prioridad }}</td>
                            {{-- <td>{{ $tarea->sprint->nombre ?? 'No asignado' }}</td> --}}
                            <td>{{ $tarea->user->name ?? 'Sin asignar' }}</td>
                            <td>
                                <!-- Botón para editar -->
                                <a href="{{ route('sprintarea.edit', $tarea->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <!-- Botón para eliminar -->
                                <form action="{{ route('sprintarea.destroy', $tarea->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>                                
                                <!-- Botón para asignar a sprint CORREGIR ESTO Y ESTADOS  -->
                                {{-- <a href="{{ route('sprints.assign', $tarea->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-tasks"></i> Asignar a Sprint
                                </a> --}}
                            </td>
                        </tr>
                    @empty
                        <!-- Fila vacía si no hay tareas -->
                        <tr>
                            <td colspan="6" class="text-center">No hay tareas disponibles</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
