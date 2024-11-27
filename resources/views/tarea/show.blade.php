@extends('adminlte::page')

@section('title', 'Detalles de la Tarea')

@section('content_header')
    <h1 class="text-xl font-semibold">Detalles de la Tarea</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $tarea->nombre ?? __('Mostrar') . " " . __('Tarea') }}</h3>
                <div class="card-tools">
                    <!--PARA QUE SE RESPETE LOS ROLES TODO CORRECTO-->
                    @if(auth()->user()->hasRole('docente'))
                        <a href="{{ route('tareas.index') }}" class="btn btn-primary btn-sm">Volver</a>
                    @else
                        <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm">Volver</a>
                    @endif
                </div>
                
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Entregable Id</dt>
                    <dd class="col-sm-9">{{ $tarea->entregable_id }}</dd>
                    
                    <dt class="col-sm-3">Docente Id</dt>
                    <dd class="col-sm-9">{{ $tarea->docente_id }}</dd>
                    
                    <dt class="col-sm-3">Nombre</dt>
                    <dd class="col-sm-9">{{ $tarea->nombre }}</dd>
                    
                    <dt class="col-sm-3">Descripción</dt>
                    <dd class="col-sm-9">{{ $tarea->descripcion }}</dd>
                    
                    <dt class="col-sm-3">Peso</dt>
                    <dd class="col-sm-9">{{ $tarea->peso }}</dd>
                    
                    <dt class="col-sm-3">Fecha Inicio</dt>
                    <dd class="col-sm-9">{{ $tarea->fecha_inicio }}</dd>
                    
                    <dt class="col-sm-3">Fecha Límite</dt>
                    <dd class="col-sm-9">{{ $tarea->fecha_limite }}</dd>
                </dl>
            </div>
            <h3 class="font-semibold text-lg mb-2">Rúbrica de Evaluación</h3>
                <ul class="list-group">
                    @forelse($tarea->rubricas as $rubrica)
                        <li class="list-group-item">
                            <strong>Nombre:</strong> {{ $rubrica->titulo }}<br>
                            <strong>Descripción:</strong> {{ $rubrica->descripcion ?? 'Sin descripción' }}<br>
                            <strong>Peso:</strong> {{ $rubrica->peso ?? 'No especificado' }}<br>

                            <strong>Criterios:</strong>
                            <ul>
                                @foreach($rubrica->criterios as $criterio)
                                    <li>
                                        <strong>Título del Criterio:</strong> {{ $criterio->titulo_criterio }}<br>
                                        <strong>Peso:</strong> {{ $criterio->peso }}<br>
                                        <strong>Descripción:</strong> {{ $criterio->descripcion }}<br>

                                        <strong>Niveles:</strong>
                                        <ul>
                                            @foreach($criterio->niveles as $nivel)
                                                <li>
                                                    <strong>Nombre del Nivel:</strong> {{ $nivel->nombre_nivel }}<br>
                                                    <strong>Puntuación:</strong> {{ $nivel->puntuacion }}<br>
                                                    <strong>Descripción:</strong> {{ $nivel->descripcion }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @empty
                        <li class="list-group-item">No hay rúbricas asociadas a esta tarea.</li>
                    @endforelse
                </ul>

        </div>
    </div>
@stop
