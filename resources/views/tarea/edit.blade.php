@extends('adminlte::page')

@section('title', 'Editar Tarea y Rúbrica')

@section('content_header')
    <h1 class="text-xl font-semibold">Editar Tarea y Rúbrica</h1>
@stop

@section('content')
    <div class="container-fluid">
        <form method="POST" action="{{ route('tareas.update', $tarea->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <!-- Sección de Tarea -->
            <div class="form-group">
                <label for="nombre">Nombre de la Tarea</label>
                <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre', $tarea->nombre) }}">
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" class="form-control">{{ old('descripcion', $tarea->descripcion) }}</textarea>
            </div>

            <div class="form-group">
                <label for="peso">Peso</label>
                <input type="number" id="peso" name="peso" class="form-control" value="{{ old('peso', $tarea->peso) }}" step="0.01">
            </div>

            <div class="form-group">
                <label for="fecha_inicio">Fecha de Inicio</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio', $tarea->fecha_inicio) }}">
            </div>

            <div class="form-group">
                <label for="fecha_limite">Fecha Límite</label>
                <input type="date" id="fecha_limite" name="fecha_limite" class="form-control" value="{{ old('fecha_limite', $tarea->fecha_limite) }}">
            </div>

            <!-- Sección de Rúbrica y Criterios -->
            @foreach($tarea->rubricas as $rubrica)
                <div class="form-group">
                    <label for="rubrica-{{ $rubrica->id }}-titulo">Título de la Rúbrica</label>
                    <input type="text" id="rubrica-{{ $rubrica->id }}-titulo" name="rubricas[{{ $rubrica->id }}][titulo]" class="form-control" value="{{ old('rubricas.'.$rubrica->id.'.titulo', $rubrica->titulo) }}">
                </div>

                @foreach($rubrica->criterios as $criterio)
                    <div class="border rounded p-3 mb-2">
                        <div class="form-group">
                            <label for="criterio-{{ $criterio->id }}-titulo_criterio">Título del Criterio</label>
                            <input type="text" id="criterio-{{ $criterio->id }}-titulo_criterio" name="criterios[{{ $criterio->id }}][titulo_criterio]" class="form-control" value="{{ old('criterios.'.$criterio->id.'.titulo_criterio', $criterio->titulo_criterio) }}">
                        </div>

                        <div class="form-group">
                            <label for="criterio-{{ $criterio->id }}-peso">Peso del Criterio</label>
                            <input type="number" id="criterio-{{ $criterio->id }}-peso" name="criterios[{{ $criterio->id }}][peso]" class="form-control" value="{{ old('criterios.'.$criterio->id.'.peso', $criterio->peso) }}" step="0.01">
                        </div>

                        @foreach($criterio->niveles as $nivel)
                            <div class="form-group">
                                <label for="nivel-{{ $nivel->id }}-nombre_nivel">Nombre del Nivel</label>
                                <input type="text" id="nivel-{{ $nivel->id }}-nombre_nivel" name="niveles[{{ $nivel->id }}][nombre_nivel]" class="form-control" value="{{ old('niveles.'.$nivel->id.'.nombre_nivel', $nivel->nombre_nivel) }}">
                            </div>

                            <div class="form-group">
                                <label for="nivel-{{ $nivel->id }}-puntuacion">Puntuación</label>
                                <input type="number" id="nivel-{{ $nivel->id }}-puntuacion" name="niveles[{{ $nivel->id }}][puntuacion]" class="form-control" value="{{ old('niveles.'.$nivel->id.'.puntuacion', $nivel->puntuacion) }}" step="1">
                            </div>

                            <div class="form-group">
                                <label for="nivel-{{ $nivel->id }}-descripcion">Descripción del Nivel</label>
                                <textarea id="nivel-{{ $nivel->id }}-descripcion" name="niveles[{{ $nivel->id }}][descripcion]" class="form-control">{{ old('niveles.'.$nivel->id.'.descripcion', $nivel->descripcion) }}</textarea>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @endforeach

            <!-- Botón de Actualización -->
            <div class="mt-4">
                <button type="submit" class="btn btn-success">Guardar Cambios</button>
            </div>
        </form>
    </div>
@stop
