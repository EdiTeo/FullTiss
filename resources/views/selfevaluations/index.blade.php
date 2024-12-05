@extends('adminlte::page')

@section('title', 'Mis Autoevaluaciones')

@section('content_header')
    <h1 class="m-0 text-dark">Mis Autoevaluaciones</h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de Autoevaluaciones</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Evaluación</th>
                            <th>Descripción</th>
                            <th>Peso</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($selfevaluations as $selfevaluation)
                            <tr>
                                <td>{{ $selfevaluation->evaluation->nombre }}</td>
                                <td>{{ $selfevaluation->evaluation->descripcion }}</td>
                                <td>{{ $selfevaluation->evaluation->peso }}</td>
                                <td>
                                    @if ($selfevaluation->nota)
                                        <button class="btn btn-secondary" disabled>Evaluado</button>
                                    @else
                                        <a href="{{ route('selfevaluations.create', $selfevaluation->evaluation->id) }}" class="btn btn-primary">Calificarse</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
