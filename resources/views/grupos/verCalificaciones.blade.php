@extends('adminlte::page')

@section('title', 'Calificaciones del Grupo')

@section('content_header')
    <h1 class="m-0 text-dark">Calificaciones del Grupo: {{ $grupo->nombre }}</h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de Calificaciones</h3>
            </div>
            <div class="card-body">
                <div style="overflow-x: auto;">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Estudiante</th>
                                @foreach($entregables as $entregable)
                                    <th>{{ $entregable->nombre }} <br><small>(<strong>{{ round($entregable->peso) }}</strong>)</small></th>
                                @endforeach
                                <th>Autoevaluaciones <br><small>(<strong>{{ round($selfevaluations->first()->evaluation->peso ?? 'N/A') }}</strong>)</small></th>
                                <th>Evaluaciones Cruzadas <br><small>(<strong>{{ round($evaluacionesCruzadas->first()->evaluation->peso ?? 'N/A') }}</strong>)</small></th>
                                <th>Evaluaciones de Grupo <br><small>(<strong>{{ round($groupMemberEvaluations->first()->evaluation->peso ?? 'N/A') }}</strong>)</small></th>
                                <th>Total</th> <!-- Columna adicional para el total -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grupo->users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    @foreach($entregables as $entregable)
                                        @php
                                            $calificacion = $calificaciones->where('user_id', $user->id)->where('entregable_id', $entregable->id)->first();
                                        @endphp
                                        <td>
                                            @if ($calificacion)
                                                {{ round($calificacion->nota) }} <br>
                                                <small style="white-space: nowrap;">{{ $calificacion->fecha_calificacion }}</small>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    @endforeach
                                    @php
                                        $selfevaluation = $selfevaluations->where('user_id', $user->id)->first();
                                    @endphp
                                    <td>
                                        @if ($selfevaluation)
                                            {{ round($selfevaluation->nota) }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $promedioEvaluacionesCruzadas }}</td> <!-- Mostrar el promedio de las evaluaciones cruzadas -->
                                    <td>{{ $promediosEvaluacionesGrupo[$user->id] ?? 'N/A' }}</td> <!-- Mostrar el promedio de las evaluaciones de grupo -->
                                    <td>{{ $totales[$user->id] ?? 0 }}</td> <!-- Mostrar el total redondeado -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
