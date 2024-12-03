@extends('adminlte::page')

@section('title', 'Editar Tarea')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Tarea</h1>
@stop

@section('content')
<div class="container">
    <h2>Editar Tarea</h2>
    
    <!-- Formulario de edición -->
    <form action="{{ route('sprintarea.update', $tareas->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="nombre">Nombre de la Tarea</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $tareas->nombre }}" required>
        </div>
        
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" class="form-control" rows="3">{{ $tareas->descripcion }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="prioridad">Prioridad</label>
            <select id="prioridad" name="prioridad" class="form-control" required>
                <option value="1" {{ $tareas->prioridad == 1 ? 'selected' : '' }}>Alta</option>
                <option value="2" {{ $tareas->prioridad == 2 ? 'selected' : '' }}>Media</option>
                <option value="3" {{ $tareas->prioridad == 3 ? 'selected' : '' }}>Baja</option>
            </select>
        </div>

        <div class="form-group">
            <label for="user_id">Asignar a</label>
            <select id="user_id" name="user_id" class="form-control">
                <option value="">Sin Asignar</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}" {{ $tareas->user_id == $usuario->id ? 'selected' : '' }}>
                        {{ $usuario->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-success">Actualizar Tarea</button>
        <a href="{{ route('sprintarea.index', ['id' => $tareas->sprint->id]) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@stop
