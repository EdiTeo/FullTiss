@extends('adminlte::page')

@section('title', 'Mostrar seguimiento')

@section('content_header')
    <h1 class="m-0 text-dark">Ver Seguimiento</h1>
@stop

@section('content')
<div class="container">
    <h1>Detalles del Seguimiento</h1>
    
    <div class="card">
        <div class="card-header">
            <h2>Seguimiento del {{ $seguimientos->fecha }}</h2>
        </div>
        <div class="card-body">
            <!-- Fecha -->
            <p><strong>Fecha:</strong> {{ $seguimientos->fecha }}</p>
            
            <!-- Presentado -->
            <p><strong>Presentado:</strong></p>
            <ul>
                @foreach (explode(' - ', $seguimientos->presentado) as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
            
            <!-- Pendiente -->
            <p><strong>Pendiente:</strong></p>
            <ul>
                @foreach (explode(' - ', $seguimientos->pendiente) as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
        
        <div class="card-footer">
            <a href="{{ route('seguimientos.edit', $seguimientos->id) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('seguimientos.destroy', $seguimientos->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
            <a href="{{ route('seguimientos.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@stop
