@extends('adminlte::page')

@section('title', 'Crear Evaluación')

@section('content_header')
    <h1 class="m-0 text-dark">Crear Evaluación</h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nueva Evaluación</h3>
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
                <form action="{{ route('evaluations.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="tipo_evaluacion">Tipo de Evaluación</label>
                        <select name="tipo_evaluacion" id="tipo_evaluacion" class="form-control" required>
                            @foreach ($tiposDisponibles as $tipo)
                                <option value="{{ $tipo }}">{{ $tipo }}</option>
                            @endforeach
                        </select>
                        @error('tipo_evaluacion')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
                        @error('descripcion')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="peso">Peso</label>
                        <input type="number" name="peso" id="peso" class="form-control" required min="0" max="{{ $pesoRestante }}">
                        <small class="form-text text-muted">Aún te queda {{ $pesoRestante }} puntos para distribuir</small>
                        @error('peso')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Crear Evaluación</button>
                </form>
            </div>
        </div>
    </div>
@stop
