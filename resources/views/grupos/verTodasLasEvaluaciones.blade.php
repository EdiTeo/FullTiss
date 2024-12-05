@extends('adminlte::page')

@section('title', 'Todas las Evaluaciones del Grupo')

@section('content_header')
    <h1 class="m-0 text-dark">Todas las Evaluaciones del Grupo: {{ $grupo->nombre }}</h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Evaluaciones Cruzadas</h3>
            </div>
            <div class="card-body">
                <div style="overflow-x: auto;">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Estudiante</th>
                                <th>Promedio Evaluaciones Cruzadas <br><small>(<strong>{{ round($evaluacionesCruzadas->first()->evaluation->peso ?? 'N/A') }}</strong>)</small></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grupo->users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $promedioEvaluacionesCruzadas }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title">Autoevaluaciones</h3>
            </div>
            <div class="card-body">
                <div style="overflow-x: auto;">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Estudiante</th>
                                <th>Autoevaluación <br><small>(<strong>{{ round($selfevaluations->first()->evaluation->peso ?? 'N/A') }}</strong>)</small></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grupo->users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        @php
                                            $selfevaluation = $selfevaluations->where('user_id', $user->id)->first();
                                        @endphp
                                        @if ($selfevaluation)
                                            {{ round($selfevaluation->nota) }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title">Evaluaciones de Integrantes de Grupo</h3>
            </div>
            <div class="card-body">
                <div style="overflow-x: auto;">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Estudiante</th>
                                <th>Promedio Evaluaciones de Grupo <br><small>(<strong>{{ round($groupMemberEvaluations->first()->evaluation->peso ?? 'N/A') }}</strong>)</small></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grupo->users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $promediosEvaluacionesGrupo[$user->id] ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
