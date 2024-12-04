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
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Estudiante</th>
                            @foreach($entregables as $entregable)
                                <th>{{ $entregable->nombre }} ({{ $entregable->peso }})</th>
                            @endforeach
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
                                    <td>{{ $calificacion ? $calificacion->nota : 'N/A' }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>   
        </div>
         <!--LISTA DE ASISTENCIAS GRUPAL-->
         <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title">Lista de Asistencias</h3>
                <a href="{{ route('asistencias.registrar', $grupo->id) }}" class="btn btn-primary float-right">Registrar Asistencia</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Estudiante</th>
                            <th>Estado</th>
                            <th>Justificación</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($asistencias->isEmpty())
                            <tr>
                                <td colspan="4">No hay asistencias registradas</td>
                            </tr>
                        @else
                            @foreach($asistencias as $asistencia)
                                <tr>
                                    <td>{{ $asistencia->user->name }}</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $asistencia->estado)) }}</td>
                                    <td>{{ $asistencia->justificacion ?? 'N/A' }}</td>
                                    <td>{{ $asistencia->fecha }}</td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
        
        
        <!--===FIN==-->
    </div>
@stop
