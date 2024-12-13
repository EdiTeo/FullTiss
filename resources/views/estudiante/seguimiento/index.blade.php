@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mis Seguimientos</h1>

    @if($registros->isEmpty())
        <p>No tienes seguimientos registrados.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Grupo</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registros as $registro)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $registro->grupo->nombre }}</td>
                    <td>{{ $registro->fecha }}</td>
                    <td>
                        <a href="{{ route('estudiante.seguimiento.edit', $registro->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('estudiante.seguimiento.destroy', $registro->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $registros->links() }}
    @endif
</div>
@endsection
