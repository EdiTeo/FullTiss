@extends('adminlte::page')

@section('title', 'Crear Grupo')

@section('content_header')
    <h1>Crear Grupo</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Crear Grupo') }}
                            <a href="{{ route('student.dashboard') }}" class="btn btn-danger float-end">Volver</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('grupos.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre del Grupo</label>
                                <input type="text" name="nombre" required class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea name="descripcion" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="estudiantes" class="form-label">Integrantes Seleccionados</label>
                                <div>
                                    @foreach ($companeros as $companero)
                                        <div class="form-check">
                                            <input type="checkbox" name="estudiantes[]" value="{{ $companero->id }}" id="estudiante_{{ $companero->id }}" class="form-check-input" checked>
                                            <label for="estudiante_{{ $companero->id }}" class="form-check-label">{{ $companero->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!--
                            <div class="mb-3">
                                <label for="solvencia_tecnica" class="form-label">Solvencia Técnica (PDF)</label>
                                <input type="file" name="solvencia_tecnica" required class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="boleta_garantia" class="form-label">Boleta de Garantía (PDF)</label>
                                <input type="file" name="boleta_garantia" required class="form-control">
                            </div>
                            -->
                            <button type="submit" class="btn btn-primary mt-3">
                                Crear Grupo
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Agregar estilos personalizados aquí --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Formulario de Crear Grupo cargado en AdminLTE"); </script>
@stop
