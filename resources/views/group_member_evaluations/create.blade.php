@extends('adminlte::page')

@section('title', 'Registrar Evaluación de Integrantes de Grupo')

@section('content_header')
    <h1 class="m-0 text-dark">Registrar Evaluación de Integrantes de Grupo</h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Registrar Evaluación</h3>
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
                <form action="{{ route('group_member_evaluations.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nota_{{ $groupMemberEvaluation->evaluatee->id }}">Nota para {{ $groupMemberEvaluation->evaluatee->name }}</label>
                        <input type="hidden" name="evaluations[0][evaluation_id]" value="{{ $groupMemberEvaluation->evaluation_id }}">
                        <input type="hidden" name="evaluations[0][evaluator_id]" value="{{ $groupMemberEvaluation->evaluator_id }}">
                        <input type="hidden" name="evaluations[0][evaluatee_id]" value="{{ $groupMemberEvaluation->evaluatee_id }}">
                        <input type="number" name="evaluations[0][nota]" id="nota_{{ $groupMemberEvaluation->evaluatee->id }}" class="form-control" required min="0" max="{{ $groupMemberEvaluation->evaluation->peso }}" value="{{ $groupMemberEvaluation->nota ?? '' }}">
                        <small class="form-text text-muted">El peso máximo de esta evaluación es {{ $groupMemberEvaluation->evaluation->peso }} puntos.</small>
                        @error('evaluations.0.nota')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar Evaluación</button>
                </form>
            </div>
        </div>
    </div>
@stop
