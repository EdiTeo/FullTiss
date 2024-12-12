@extends('adminlte::page')

@section('title', 'Tareas')

@section('content_header')
    <h1>{{ __('Tareas') }}</h1>
@stop

@section('content')
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Tareas') }}
    </h2>
</x-slot>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-0">{{ __('Lista de Tareas') }}</h4>
                    <p class="text-muted">Gestión de todas las tareas.</p>
                </div>
                <a href="{{ route('tareas.create') }}" class="btn btn-primary">Agregar Nueva Tarea</a>
            </div>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Entregable</th>
                            <th scope="col">Docente</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Peso</th>
                            <th scope="col">Fecha de Inicio</th>
                            <th scope="col">Fecha Límite</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tareas as $index => $tarea)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $tarea->entregable->nombre }}</td> <!-- Mostrar el nombre del entregable -->
                                <td>{{ $tarea->docente->name }}</td> <!-- Mostrar el nombre del docente -->
                                <td>{{ $tarea->nombre }}</td>
                                <td>{{ $tarea->descripcion }}</td>
                                <td>{{ $tarea->peso }}</td>
                                <td>{{ $tarea->fecha_inicio }}</td>
                                <td>{{ $tarea->fecha_limite }}</td>
                                <td>
                                    <a href="{{ route('tareas.show', $tarea->id) }}" class="btn btn-info btn-sm mr-2">{{ __('Ver') }}</a>
                                    <a href="{{ route('tareas.edit', $tarea->id) }}" class="btn btn-warning btn-sm mr-2">{{ __('Editar') }}</a>
                                    <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de que desea eliminar?')">{{ __('Eliminar') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                {!! $tareas->withQueryString()->links() !!}
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    {{-- Aquí se pueden añadir hojas de estilo adicionales --}}
@stop

@section('js')
    <script> console.log("Hola, estoy usando el paquete Laravel-AdminLTE"); </script>
@stop

