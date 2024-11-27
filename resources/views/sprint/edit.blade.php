@extends('adminlte::page')

@section('title', 'Actualizar Sprint')

@section('content_header')
    <h1 class="m-0 text-dark">Actualizar Sprint</h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h1>Actualizar Sprint</h1>
                <a type="button" href="{{ route('sprints.index') }}" class="btn btn-primary">Volver</a>
            </div>
            <div class="card-body">
                <form action="{{ route('sprints.update', $sprint->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input id="nombre" name="nombre" type="text" class="form-control" value="{{ old('nombre', $sprint->nombre) }}" autocomplete="nombre" placeholder="Nombre">
                        @error('nombre')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                        <input id="fecha_inicio" name="fecha_inicio" type="date" class="form-control" value="{{ old('fecha_inicio', $sprint->fecha_inicio) }}" autocomplete="fecha_inicio" placeholder="Fecha Inicio">
                        @error('fecha_inicio')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="fecha_fin" class="form-label">Fecha Fin</label>
                        <input id="fecha_fin" name="fecha_fin" type="date" class="form-control" value="{{ old('fecha_fin', $sprint->fecha_fin) }}" autocomplete="fecha_fin" placeholder="Fecha Fin">
                        @error('fecha_fin')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="grupo_id" class="form-label">Grupo</label>
                        <input id="grupo_id" name="grupo_id" type="text" class="form-control" value="{{ $sprint->grupo->nombre }}" readonly>
                        @error('grupo_id')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Creador</label>
                        <input id="user_id" name="user_id" type="text" class="form-control" value="{{ $sprint->user->name }}" readonly>
                        @error('user_id')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Actualizar Sprint</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
