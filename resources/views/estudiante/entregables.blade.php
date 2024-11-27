@extends('adminlte::page')

@section('title', 'Entregables')

@section('content_header')
    <h1 class="text-xl font-semibold">Entregables</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            @foreach ($entregables as $entregable)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $entregable->nombre }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>Asignación de tareas y detalles del entregable.</p>
                            <a href="{{ route('estudiante.tareas', $entregable->id) }}" class="btn btn-warning">
                                Ver tareas
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop
