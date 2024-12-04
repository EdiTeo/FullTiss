@extends('adminlte::page')

@section('title', 'Editar seguimiento')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Seguimiento</h1>
@stop

@section('content')
<div class="container">
    <h1>Editar Seguimiento</h1>
    
    <form action="{{ route('seguimientos.update', $seguimientos->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha" class="form-control" value="{{ $seguimientos->fecha }}" required>
        </div>
        
        <div class="form-group">
            <label for="presentado">Presentado</label>
            <textarea id="presentado" name="presentado" class="form-control" rows="3" required>{{ $seguimientos->presentado }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="pendiente">Pendiente</label>
            <textarea id="pendiente" name="pendiente" class="form-control" rows="3" required>{{ $seguimientos->pendiente }}</textarea>
        </div>
        
        <button type="submit" class="btn btn-success">Guardar Cambios</button>
        <a href="{{ route('seguimientos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@stop
