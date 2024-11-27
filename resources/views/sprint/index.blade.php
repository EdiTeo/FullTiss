@extends('adminlte::page')

@section('title', 'Sprints')

@section('content_header')
    <h1 class="m-0 text-dark">Sprints</h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h1>Sprints</h1>
                <a type="button" href="{{ route('sprints.create') }}" class="btn btn-primary">Add new</a>
            </div>
            <div class="card-body">
                @if ($sprints->count())
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nombre</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Grupo Id</th>
                                <th>User Id</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sprints as $sprint)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $sprint->nombre }}</td>
                                    <td>{{ $sprint->fecha_inicio }}</td>
                                    <td>{{ $sprint->fecha_fin }}</td>
                                    <td>{{ $sprint->grupo_id }}</td>
                                    <td>{{ $sprint->user_id }}</td>
                                    <td>
                                        <form action="{{ route('sprints.destroy', $sprint->id) }}" method="POST">
                                            <a href="{{ route('sprints.show', $sprint->id) }}" class="btn btn-info btn-sm">Show</a>
                                            <a href="{{ route('sprints.edit', $sprint->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {!! $sprints->withQueryString()->links() !!}
                    </div>
                @else
                    <p>No hay sprints disponibles para tu grupo.</p>
                @endif
            </div>
        </div>
    </div>
@stop
