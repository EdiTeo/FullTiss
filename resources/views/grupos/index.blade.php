@extends('adminlte::page')
@section('title', 'Mis Grupos')
@section('content_header')
    <h1>Grupos de Mi Clase</h1>
@stop
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Grupos de Mi Clase</h3>
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nombre Grupo</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($grupos as $index => $grupo)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $grupo->nombre }}</td>
                                <td>{{ $grupo->descripcion }}</td>
                                <td>
                                    <span class="{{ $grupo->estado ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $grupo->estado ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No hay grupos disponibles.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
@section('css')
    {{-- Add here extra stylesheets --}}
@stop
@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
