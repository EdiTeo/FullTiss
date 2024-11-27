@extends('adminlte::page')

@section('title', 'Gestión de Permisos')

@section('content_header')
    <h1>Gestión de Permisos</h1>
@stop

@section('content')
    <div class="container mt-5">
        <a href="{{ url('roles') }}" class="btn btn-primary mx-1">Roles</a>
        <a href="{{ url('permissions') }}" class="btn btn-info mx-1">Permisos</a>
        <a href="{{ url('users') }}" class="btn btn-warning mx-1">Usuarios</a>
    </div>

    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Permisos
                            {{-- @can('create permission') --}}
                            <a href="{{ url('permissions/create') }}" class="btn btn-primary float-end">Añadir Permiso</a>
                            {{-- @endcan --}}
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th width="40%">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        {{-- @can('update permission') --}}
                                        <a href="{{ url('permissions/'.$permission->id.'/edit') }}" class="btn btn-success">Editar</a>
                                        {{-- @endcan --}}

                                        {{-- @can('delete permission') --}}
                                        <a href="{{ url('permissions/'.$permission->id.'/delete') }}" class="btn btn-danger mx-2">Eliminar</a>
                                        {{-- @endcan --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Añade aquí hojas de estilo adicionales --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Panel de gestión de permisos cargado con Laravel-AdminLTE."); </script>
@stop
