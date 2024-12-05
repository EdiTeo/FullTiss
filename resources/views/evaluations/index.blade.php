@extends('adminlte::page')

@section('title', 'Lista de Evaluaciones')

@section('content_header')
    <h1 class="m-0 text-dark">Lista de Evaluaciones</h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Evaluaciones Registradas</h3>
                <a href="{{ route('evaluations.create') }}" class="btn btn-primary">Crear Nueva Evaluación</a>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Peso</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($evaluations as $evaluation)
                            <tr>
                                <td>{{ $evaluation->nombre }}</td>
                                <td>{{ $evaluation->descripcion }}</td>
                                <td>{{ $evaluation->peso }}</td>
                                <td>
                                    <!-- Aquí puedes agregar enlaces para editar o eliminar -->
                                    <a href="{{ route('evaluations.edit', $evaluation->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('evaluations.destroy', $evaluation->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
