@extends('adminlte::page')

@section('title', 'Grupos de Estudiantes')

@section('content_header')
    <h1 class="m-0 text-dark">Grupos de Estudiantes</h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de Grupos</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Grupo</th>
                            <th>Integrantes</th>
                            <th>Estado</th>
                           <!--<th>Archivos</th>--> 
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($grupos as $grupo)
                            <tr>
                                <td>{{ $grupo->nombre }}</td>
                                <td>
                                    <ol>
                                        @foreach ($grupo->users->sortBy('name') as $user) {{-- Ordenar por nombre --}}
                                            <li>{{ $user->name }}</li>
                                        @endforeach
                                    </ol>
                                </td>
                                <td>
                                    <span class="{{ $grupo->estado ? 'text-success' : 'text-danger' }}">
                                        {{ $grupo->estado ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                  <!---
                             <td>
                                    @if($grupo->solvencia_tecnica)
                                        <a href="{{ asset('storage/' . $grupo->solvencia_tecnica) }}" target="_blank" class="text-primary">Descargar Solvencia Técnica</a><br>
                                    @endif
                                    @if($grupo->boleta_garantia)
                                        <a href="{{ asset('storage/' . $grupo->boleta_garantia) }}" target="_blank" class="text-primary">Descargar Boleta de Garantía</a>
                                    @endif
                                </td>
                            
                            -->
                                <td>
                                    <form action="{{ route('grupos.updateStatus', $grupo->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-danger btn-sm">Cambiar Estado</button>
                                        <a href="{{ route('grupos.verEntregas', $grupo->id) }}" class="btn btn-secondary btn-sm">Ver entregas</a>
                                        <!-- Botón de Seguimiento de Calificaciones -->
                                        <a href="{{ route('grupos.verCalificaciones', $grupo->id) }}" class="btn btn-info btn-sm">Ver Planilla</a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop


