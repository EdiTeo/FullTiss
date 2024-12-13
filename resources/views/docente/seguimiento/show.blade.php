@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Seguimiento</h1>

    <div class="card">
        <div class="card-header">
            <strong>Grupo:</strong> {{ $registro->grupo->nombre }}
        </div>
        <div class="card-body">
            <p><strong>Estudiante:</strong> {{ $registro->usuario->name }}</p>
            <p><strong>Fecha:</strong> {{ $registro->fecha }}</p>
            <p><strong>Presentado:</strong> {{ $registro->presentado }}</p>
            <p><strong>Pendiente:</strong> {{ $registro->pendiente }}</p>
        </div>
    </div>

    <a href="{{ route('docente.seguimientos') }}" class="btn btn-primary mt-3">Volver a Seguimientos</a>
</div>
@endsection
