@extends('adminlte::page')

@section('title', 'Evaluaciones Cruzadas')

@section('content_header')
    <h1 class="m-0 text-dark">Evaluaciones Cruzadas</h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Grupos a Calificar</h3>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nombre del Grupo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($otrosGrupos as $grupoCalificar)
                            <tr>
                                <td>{{ $grupoCalificar->nombre }}</td>
                                <td>
                                    @php
                                        $calificado = $evaluacionesCruzadas->where('grupo_calificado_id', $grupoCalificar->id)->isNotEmpty();
                                    @endphp
                                    @if ($calificado)
                                        <button class="btn btn-sm btn-secondary" disabled>Calificado</button>
                                    @else
                                        <a href="{{ route('crossevaluations.create', ['evaluation' => $evaluation->id, 'grupo_calificado_id' => $grupoCalificar->id]) }}" class="btn btn-sm btn-primary">Calificar</a>
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
