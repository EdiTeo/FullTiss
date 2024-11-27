@extends('adminlte::page')
@section('title', 'Update Assignment')
@section('content_header')
    <h1>Update Assignment</h1>
@stop
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Update Assignment
                            <a href="{{ route('assignments.index') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('assignments.update', $assignment->id) }}" role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf
                            <div class="mb-4">
                                <label for="docente_id" class="form-label">Seleccionar Docente:</label>
                                <ul class="list-group">
                                    @foreach($docentes as $index => $docente)
                                        <li class="list-group-item">
                                            <input type="radio" id="docente_{{ $docente->id }}" name="docente_id" value="{{ $docente->id }}" {{ (old('docente_id') == $docente->id || (isset($assignment) && $assignment->docente_id == $docente->id)) ? 'checked' : '' }}>
                                            <label for="docente_{{ $docente->id }}">{{ $index + 1 }}. {{ $docente->name }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                                @if ($errors->has('docente_id'))
                                    <p class="text-danger mt-2">{{ $errors->first('docente_id') }}</p>
                                @endif
                            </div>
                            <div class="mb-4">
                                <label for="estudiante_id" class="form-label">Seleccionar Estudiantes:</label>
                                <ul class="list-group">
                                    @foreach($estudiantes as $index => $estudiante)
                                        <li class="list-group-item">
                                            <input type="checkbox" id="estudiante_{{ $estudiante->id }}" name="estudiante_ids[]" value="{{ $estudiante->id }}" {{ (is_array(old('estudiante_ids')) && in_array($estudiante->id, old('estudiante_ids'))) || (isset($estudiantesAsignados) && in_array($estudiante->id, $estudiantesAsignados)) ? 'checked' : '' }}>
                                            <label for="estudiante_{{ $estudiante->id }}">{{ $index + 1 }}. {{ $estudiante->name }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                                @if ($errors->has('estudiante_ids'))
                                    <p class="text-danger mt-2">{{ $errors->first('estudiante_ids') }}</p>
                                @endif
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop
@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
