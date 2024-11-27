@extends('adminlte::page')

@section('title', 'Mostrar Sprint')

@section('content_header')
    <h1 class="m-0 text-dark">{{ $sprint->nombre ?? __('Mostrar') . " " . __('Sprint') }}</h1>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h1>Mostrar Sprint</h1>
                <a type="button" href="{{ route('sprints.index') }}" class="btn btn-primary">Volver</a>
            </div>
            <div class="card-body">
                <div class="mt-6 border-t border-gray-200">
                    <dl class="row">
                        <div class="col-md-6 mb-3">
                            <dt class="text-sm font-medium text-gray-700">Nombre</dt>
                            <dd class="text-sm text-gray-900">{{ $sprint->nombre }}</dd>
                        </div>
                        <div class="col-md-6 mb-3">
                            <dt class="text-sm font-medium text-gray-700">Fecha Inicio</dt>
                            <dd class="text-sm text-gray-900">{{ $sprint->fecha_inicio }}</dd>
                        </div>
                        <div class="col-md-6 mb-3">
                            <dt class="text-sm font-medium text-gray-700">Fecha Fin</dt>
                            <dd class="text-sm text-gray-900">{{ $sprint->fecha_fin }}</dd>
                        </div>
                        <div class="col-md-6 mb-3">
                            <dt class="text-sm font-medium text-gray-700">Grupo Id</dt>
                            <dd class="text-sm text-gray-900">{{ $sprint->grupo_id }}</dd>
                        </div>
                        <div class="col-md-6 mb-3">
                            <dt class="text-sm font-medium text-gray-700">User Id</dt>
                            <dd class="text-sm text-gray-900">{{ $sprint->user_id }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@stop
