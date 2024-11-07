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
                    <a href="{{ route('tareas.index') }}" class="btn btn-primary btn-sm">Volver</a>
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
        </div>
    </div>
@stop
