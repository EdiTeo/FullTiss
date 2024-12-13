@extends('adminlte::page')

@section('title', 'Mis Evaluaciones de Integrantes de Grupo')

@section('content_header')
    <h1 class="m-0 text-dark">Mis Evaluaciones de Integrantes de Grupo</h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de Evaluaciones</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Integrante Evaluado</th>
                            <th>Nota</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($evaluations as $evaluation)
                            <tr>
                                <td>{{ $evaluation->evaluatee->name }}</td>
                                <td>{{ $evaluation->nota ?? 'No evaluado' }}</td>
                                <td>
                                    @if ($evaluation->nota)
                                        <button class="btn btn-secondary" disabled>Calificado</button>
                                    @else
                                        <a href="{{ route('group_member_evaluations.create', ['evaluation' => $evaluation->evaluation->id, 'evaluatee' => $evaluation->evaluatee->id]) }}" class="btn btn-primary">Calificar</a>
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
