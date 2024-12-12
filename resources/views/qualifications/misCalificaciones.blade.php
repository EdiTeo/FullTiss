@extends('adminlte::page')

@section('title', 'Mis Calificaciones')

@section('content_header')
    <h1 class="m-0 text-dark">Mis Calificaciones</h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Mis Calificaciones</h3>
            </div>
            <div class="card-body">
                <div style="overflow-x: auto;">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th colspan="2">Estudiante</th>
                                @foreach($calificacionesEntregables as $calificacion)
                                    <th>{{ $calificacion->entregable->nombre }} <br><small>(<strong>{{ round($calificacion->entregable->peso) }}</strong>)</small></th>
                                @endforeach
                                @foreach($selfevaluations as $selfevaluation)
                                    <th>{{ $selfevaluation->evaluation->nombre }} <br><small>(<strong>{{ round($selfevaluation->evaluation->peso) }}</strong>)</small></th>
                                @endforeach
                                @foreach($evaluacionesCruzadas as $evaluacion)
                                    <th>{{ $evaluacion->evaluation->nombre }} <br><small>(<strong>{{ round($evaluacion->evaluation->peso) }}</strong>)</small></th>
                                @endforeach
                                @foreach($evaluacionesGrupo as $evaluacion)
                                    <th>{{ $evaluacion->evaluation->nombre }} <br><small>(<strong>{{ round($evaluacion->evaluation->peso) }}</strong>)</small></th>
                                @endforeach
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2">{{ $user->name }}</td>
                                @foreach($calificacionesEntregables as $calificacion)
                                    <td>{{ round($calificacion->nota) }}</td>
                                @endforeach
                                @foreach($selfevaluations as $selfevaluation)
                                    <td>{{ round($selfevaluation->nota) }}</td>
                                @endforeach
                                @foreach($evaluacionesCruzadas as $evaluacion)
                                    <td>{{ round($evaluacion->nota) }}</td>
                                @endforeach
                                @foreach($evaluacionesGrupo as $evaluacion)
                                    <td>{{ round($evaluacion->nota) }}</td>
                                @endforeach
                                <td>{{ round($totalCalificaciones) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Comentarios de Docente</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Entregable</th>
                            <th>Comentario</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($calificacionesEntregables as $calificacion)
                            <tr>
                                <td>{{ $calificacion->entregable->nombre }}</td>
                                <td>{{ $calificacion->comentarios }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Agregar estilos personalizados aquí --}}
@stop

@section('js')
    <script> console.log("Formulario de Calificaciones cargado en AdminLTE"); </script>
@stop
