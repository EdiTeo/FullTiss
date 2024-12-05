@extends('adminlte::page')

@section('title', 'Promedios de Calificaciones')

@section('content_header')
    <h1 class="m-0 text-dark">Promedios de Calificaciones</h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Promedios de Calificaciones por Grupo</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nombre del Grupo</th>
                            <th>Promedio</th>
                            <th>Calificaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($promedios as $promedio)
                            <tr>
                                <td>{{ $promedio['grupo']->nombre }}</td>
                                <td>{{ round($promedio['promedio'], 2) }}</td>
                                <td>{{ implode(', ', $promedio['calificaciones']->toArray()) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
