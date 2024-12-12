@extends('adminlte::page')

@section('title', 'Compañeros de Clase')

@section('content_header')
    <h1>Compañeros de Clase</h1>
@stop

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Lista de Compañeros</h3>
                <form action="{{ route('grupos.create') }}" method="GET">
                    @if ($estudianteEnGrupo)
                        <button type="submit" class="mb-4 btn btn-success" disabled>
                            Crear Grupo
                        </button>
                        <div class="alert alert-warning">Ya perteneces a un grupo y no puedes crear otro.</div>
                    @else
                        <button type="submit" class="mb-4 btn btn-success">
                            Crear Grupo
                        </button>
                    @endif

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">N°</th>
                                <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Nombre</th>
                                <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($companeros as $index => $companero)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $companero->name }}</td>
                                    <td>
                                        <input type="checkbox" name="companeros[]" value="{{ $companero->id }}" id="companero_{{ $companero->id }}"
                                            @if(in_array($companero->id, $companerosEnGrupo)) checked disabled @endif>
                                        <label for="companero_{{ $companero->id }}" class="{{ in_array($companero->id, $companerosEnGrupo) ? 'text-gray-400' : '' }}">
                                            <!-- Aquí eliminamos el nombre -->
                                        </label>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <style>
        input[type="checkbox"]:disabled {
            opacity: 0.5; /* Opcional: hacer el checkbox un poco más transparente */
        }
    </style>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
