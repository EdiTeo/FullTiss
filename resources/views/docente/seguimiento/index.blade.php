@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Seguimientos de mis Grupos</h1>

    @if($registros->isEmpty())
        <p>No hay seguimientos registrados.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Grupo</th>
                    <th>Estudiante</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registros as $registro)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $registro->grupo->nombre }}</td>
                    <td>{{ $registro->usuario->name }}</td>
                    <td>{{ $registro->fecha }}</td>
                    <td>
                        <a href="{{ route('docente.seguimiento.show', $registro->id) }}" class="btn btn-info">Ver</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $registros->links() }}
    @endif
</div>
@endsection
