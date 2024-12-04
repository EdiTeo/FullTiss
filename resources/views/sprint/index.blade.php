@extends('adminlte::page')

@section('title', 'Sprints')

@section('content_header')
    <h1 class="m-0 text-dark">Sprints</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Lista de Sprints</h3>
            <a href="{{ route('sprints.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Crear Nuevo Sprint
            </a>
            <a href="{{ route('product-backlog.index') }}" class="btn btn-danger float-end">Volver</a>
        </div>
        <div class="card-body">
            @if($sprints->isEmpty())
                <div class="alert alert-warning" role="alert">
                    No hay sprints registrados. <a href="{{ route('sprints.create') }}" class="alert-link">Crea uno ahora</a>.
                </div>
            @else
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha de Fin</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sprints as $sprint)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sprint->nombre }}</td>
                                <td>{{ $sprint->fecha_inicio }}</td>
                                <td>{{ $sprint->fecha_fin}}</td>
                                <td>
                                    <a href="{{ route('sprints.show', $sprint) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                    <a href="{{ route('sprints.edit', $sprint) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('sprints.destroy', $sprint) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            @endif
        </div>
    </div>
</div>
@stop
