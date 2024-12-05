@extends('adminlte::page')

@section('title', 'Editar Tarea')

@section('content_header')
    <h1>Editar Tarea</h1>
@stop

@section('content')
<div class="container">
    <form action="{{ route('sprintarea.update', $tarea->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="sprint_id">Selecciona el Sprint</label>
            <select name="sprint_id" id="sprint_id" class="form-control" required>
                <option value="">-- Selecciona un Sprint --</option>
                @foreach($sprints as $sprint)
                    <option value="{{ $sprint->id }}" 
                        {{ $sprint->id == $tarea->sprint_id ? 'selected' : '' }}>
                        {{ $sprint->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        

        <div class="form-group">
            <label for="nombre">Nombre de la Tarea</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $tarea->nombre) }}" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion', $tarea->descripcion) }}</textarea>
        </div>

        <div class="form-group">
            <label for="prioridad">Prioridad</label>
            <select name="prioridad" id="prioridad" class="form-control" required>
                <option value="1" {{ old('prioridad', $tarea->prioridad) == 1 ? 'selected' : '' }}>Alta</option>
                <option value="2" {{ old('prioridad', $tarea->prioridad) == 2 ? 'selected' : '' }}>Media</option>
                <option value="3" {{ old('prioridad', $tarea->prioridad) == 3 ? 'selected' : '' }}>Baja</option>
            </select>
        </div>

        <div class="form-group">
            <label for="estado">Estado</label>
            <select name="estado" id="estado" class="form-control" required>
                <option value="pendiente" {{ $tarea->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="en_progreso" {{ $tarea->estado == 'en_progreso' ? 'selected' : '' }}>En Progreso</option>
                <option value="completado" {{ $tarea->estado == 'completado' ? 'selected' : '' }}>Completado</option>
                        </select>
        </div>

        <div class="form-group">
            <label for="user_id">Estudiante</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach($usuarios as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $tarea->user_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <!-- Botón Guardar Cambios -->
            <button type="submit" class="btn btn-success" >Guardar Cambios</button>
        
            <!-- Botón Cancelar -->
            <a href="javascript:history.back()" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
</div>
@stop
