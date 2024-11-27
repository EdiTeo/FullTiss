@extends('adminlte::page')

@section('title', 'Entregas')

@section('content_header')
    <h1 class="text-xl font-semibold">Entregas</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Listado de Entregas</h3>
                        <div class="card-tools">
                            <a type="button" href="{{ route('entregas.create') }}" class="btn btn-primary btn-sm">Añadir Nuevo</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tarea Id</th>
                                    <th>Grupo Id</th>
                                    <th>User Id</th>
                                    <th>Archivo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($entregas as $entrega)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $entrega->tarea_id }}</td>
                                        <td>{{ $entrega->grupo_id }}</td>
                                        <td>{{ $entrega->user_id }}</td>
                                        <td>{{ $entrega->archivo }}</td>
                                        <td>
                                            <a href="{{ route('entregas.show', $entrega->id) }}" class="btn btn-info btn-sm">Mostrar</a>
                                            <a href="{{ route('entregas.edit', $entrega->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                            <form action="{{ route('entregas.destroy', $entrega->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta entrega?');">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mt-3">
                            {!! $entregas->withQueryString()->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
