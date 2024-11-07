@extends('adminlte::page')

@section('title', 'Estudiantes Asignados')

@section('content_header')
    <h1 class="m-0 text-dark">Estudiantes Asignados</h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de Estudiantes</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estudiantes as $index => $estudiante)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $estudiante->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
