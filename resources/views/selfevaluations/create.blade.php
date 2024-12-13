@extends('adminlte::page')

@section('title', 'Registrar Autoevaluación')

@section('content_header')
    <h1 class="m-0 text-dark">Registrar Autoevaluación</h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Registrar Autoevaluación</h3>
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
                <form action="{{ route('selfevaluations.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="evaluation_id" value="{{ $evaluation->id }}">
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                    <div class="form-group">
                        <label for="nota">Nota</label>
                        <input type="number" name="nota" id="nota" class="form-control" required min="0" max="100" {{ $selfevaluation->nota ? 'disabled' : '' }}>
                        <small class="form-text text-muted">El peso de esta autoevaluación es {{ $evaluation->peso }} puntos.</small>
                        @error('nota')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" {{ $selfevaluation->nota ? 'disabled' : '' }}>Registrar Autoevaluación</button>
                </form>
            </div>
        </div>
    </div>
@stop
