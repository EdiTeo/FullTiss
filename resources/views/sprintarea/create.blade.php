@extends('adminlte::page')

@section('title', 'Crear Tarea')

@section('content_header')
    <h1>Crear Nueva Tarea</h1>
@stop

@section('content')
<div class="container">
    <form action="{{ route('sprintarea.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="sprint_id">Selecciona el Sprint</label>
            <select name="sprint_id" id="sprint_id" class="form-control" required>
                <option value="">-- Selecciona un Sprint --</option>
                @foreach($sprints as $sprint)
                    <option value="{{ $sprint->id }}">{{ $sprint->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="nombre">Nombre de la Tarea</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="prioridad">Prioridad</label>
            <select name="prioridad" id="prioridad" class="form-control" required>
                <option value="1">Alta</option>
                <option value="2">Media</option>
                <option value="3">Baja</option>
            </select>
        </div>

        <div class="form-group"><!--MODIFICAR ESTA SI PUEDES MOFICAR PARA QUE TOME ENCUENTA EL ESTADO Y NO POR DEFECTO-->
            <label for="estado">Estado</label>
            <select name="estado" id="estado" class="form-control" required>
                <option value="pendiente" {{ old('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="en_progreso" {{ old('estado') == 'en_progreso' ? 'selected' : '' }}>En Progreso</option>
                <option value="completada" {{ old('estado') == 'completada' ? 'selected' : '' }}>Completada</option>
            </select>
        </div>
        

        <div class="form-group">
            <label for="user_id">Estudiante</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach($grupo->users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <!-- Botón Guardar Tarea -->
            <button type="submit" class="btn btn-success">Guardar Tarea</button>
        
            <!-- Botón Cancelar -->
            <a href="javascript:history.back()" class="btn btn-danger">Cancelar</a>
        </div>
        
    </form>
</div>
@stop
