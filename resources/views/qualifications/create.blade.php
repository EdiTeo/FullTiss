@extends('adminlte::page')

@section('title', 'Calificar Entregable')

@section('content_header')
    <h1 class="m-0 text-dark">Calificar Entregable</h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Calificar Entregable</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('qualifications.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="entrega_id" value="{{ $entrega->id }}">
                    <input type="hidden" name="entregable_id" value="{{ $entregable->id }}">

                    <div class="form-group">
                        <label for="entregable_nombre">Entregable</label>
                        <input type="text" id="entregable_nombre" class="form-control" value="{{ $entregable->nombre }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="user_id">Estudiante</label>
                        <select name="user_id" id="user_id" class="form-control" required>
                            @foreach ($grupo->users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nota">Nota</label>
                        <input type="number" name="nota" id="nota" class="form-control" required min="0" max="{{ $entregable->peso }}">
                        @error('nota')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        <small id="pesoNotaHelp" class="form-text text-muted">La nota debe ser menor o igual a {{ $entregable->peso }}.</small>
                    </div>

                    <div class="form-group">
                        <label for="fecha_calificacion">Fecha de Calificación</label>
                        <input type="date" name="fecha_calificacion" id="fecha_calificacion" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="comentarios">Comentarios</label>
                        <textarea name="comentarios" id="comentarios" class="form-control" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar Calificación</button>
                </form>
            </div>
        </div>
    </div>
@stop

