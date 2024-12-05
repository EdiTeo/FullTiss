@extends('adminlte::page')

@section('title', 'Entregas del Grupo')

@section('content_header')
    <h1 class="m-0 text-dark">Entregas del Grupo: {{ $grupo->nombre }}</h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Lista de Entregas</h3>
                 <!-- Botón Cancelar -->
                 <a href="{{ route('docente.grupos') }}" class="btn btn-danger ms-auto" style="margin-left: 400px;">Atrás</a>

            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nombre de la Tarea</th>
                            <th>Estudiante</th>
                            <th>Archivo</th>
                            <th>Fecha de Entrega</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($grupo->entregas as $entrega)
                            <tr>
                                <td>{{ $entrega->tarea->nombre }}</td>
                                <td>{{ $entrega->user->name }}</td>
                                <td><a href="{{ Storage::url($entrega->archivo) }}" target="_blank">Ver Archivo</a></td>
                                <td>{{ $entrega->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('qualifications.create', ['entrega_id' => $entrega->id]) }}" class="btn btn-success btn-sm">Calificar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
