@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Seguimiento</h1>

    <form action="{{ route('estudiante.seguimiento.store') }}" method="POST">
        @csrf
        <input type="hidden" name="grupo_id" value="{{ $grupo_id }}">

        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="presentado">Presentado</label>
            <textarea name="presentado" id="presentado" class="form-control" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="pendiente">Pendiente</label>
            <textarea name="pendiente" id="pendiente" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Guardar</button>
    </form>
</div>
@endsection
