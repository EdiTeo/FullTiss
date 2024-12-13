@extends('adminlte::page')

@section('title', 'Registrar Evaluación Cruzada')

@section('content_header')
    <h1 class="m-0 text-dark">Registrar Evaluación Cruzada</h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Registrar Evaluación Cruzada</h3>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('crossevaluations.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="evaluation_id" value="{{ $evaluation->id }}">
                    <input type="hidden" name="grupo_id" value="{{ $grupo->id }}">
                    <input type="hidden" name="grupo_calificado_id" value="{{ $grupoCalificado->id }}">

                    <div class="form-group">
                        <label for="grupo_calificado">Grupo a Calificar</label>
                        <input type="text" id="grupo_calificado" class="form-control" value="{{ $grupoCalificado->nombre }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="nota">Nota</label>
                        <input type="number" name="nota" id="nota" class="form-control" required min="0" max="100">
                        <small class="form-text text-muted">El peso de esta evaluación es {{ $evaluation->peso }} puntos.</small>
                        @error('nota')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Registrar Evaluación</button>
                </form>
            </div>
        </div>
    </div>
@stop
