@extends('adminlte::page')

@section('title', 'Entregables')

@section('content_header')
    <h1>Entregables</h1>
@stop

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Entregables') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">{{ __('Entregables') }}</h4>
                        <p class="text-muted">Lista de todos los entregables {{ __('Entregables') }}.</p>
                    </div>
                    <a href="{{ route('entregables.create') }}" class="btn btn-primary">Agregar Nuevo</a>
                </div>
            </div>
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-gray">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Docente</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Peso</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($entregables as $entregable)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $entregable->docente->name }}</td> <!-- Aquí se muestra el nombre del docente -->
                                    <td>{{ $entregable->nombre }}</td>
                                    <td>{{ $entregable->descripcion }}</td>
                                    <td>{{ $entregable->peso }}</td>
                                    <td>
                                        <a href="{{ route('entregables.show', $entregable->id) }}" class="btn btn-info btn-sm mr-2">{{ __('Mostrar') }}</a>
                                        <a href="{{ route('entregables.edit', $entregable->id) }}" class="btn btn-warning btn-sm mr-2">{{ __('Editar') }}</a>
                                        <form action="{{ route('entregables.destroy', $entregable->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar?')">{{ __('Eliminar') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    {!! $entregables->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Puedes añadir estilos personalizados aquí --}}
@stop

@section('js')
    <script> console.log("Usando el paquete Laravel-AdminLTE"); </script>
@stop
