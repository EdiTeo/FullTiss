@extends('adminlte::page')

@section('title', 'Registrar Asistencia')

@section('content_header')
    <h1 class="m-0 text-dark">Registrar Asistencia para el Grupo: {{ $grupo->nombre }}</h1>
@stop

@section('content')
    <div class="container">
        <form action="{{ route('asistencias.guardar', $grupo->id) }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lista de Estudiantes</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Estudiante</th>
                                <th>Estado</th>
                                <th>Justificación (opcional)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estudiantes as $estudiante)
                                <tr>
                                    <td>{{ $estudiante->name }}</td>
                                    <td>
                                        <select name="asistencias[{{ $estudiante->id }}]" class="form-control" required>
                                            <option value="presente">Presente</option>
                                            <option value="retraso">Tarde</option>
                                            <option value="ausente_justificado">Ausente Justificado</option>
                                            <option value="ausente_no_justificado">Ausente No Justificado</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="justificaciones[{{ $estudiante->id }}]" class="form-control" placeholder="Justificación">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Guardar Asistencia</button>
                    <a href="{{ route('grupos.verCalificaciones', $grupo->id) }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
@stop
