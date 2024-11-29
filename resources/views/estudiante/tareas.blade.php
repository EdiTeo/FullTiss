@extends('adminlte::page')

@section('title', 'Tareas del Entregable')

@section('content_header')
    <h1 class="text-xl font-semibold">Tareas del Entregable</h1>
@stop

@section('content')
    <div class="container-fluid">
        <!-- Tarjetas de grupos -->
        <div class="row">
            @foreach($gruposActivos as $grupo)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $grupo->nombre }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Lista de tareas en tarjetas -->
                            <h4 class="card-title">Tareas Asignadas:</h4>
                            <div class="list-group">
                                @forelse ($grupo->tareas as $tarea)
                                <div class="list-group-item">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $tarea->nombre }}</h5>
                                    </div>
                                    <p class="mb-1">{{ $tarea->descripcion }}</p>
                                    <a href="{{ route('detalles-tarea', ['id' => $tarea->id]) }}" class="btn btn-primary btn-sm">Ver Detalles</a>
                                    @php
                                        $grupo = \App\Models\Grupo::whereHas('usuarios', function ($query) {
                                            $query->where('user_id', auth()->id());
                                        })->first();

                                        $yaEntregado = $grupo && \App\Models\Entrega::where('grupo_id', $grupo->id)
                                                                                    ->where('tarea_id', $tarea->id)
                                                                                    ->exists();
                                    @endphp
                                    @if(!$yaEntregado)
                                        <a href="{{ route('entregas.create', ['tarea_id' => $tarea->id]) }}" class="btn btn-warning btn-sm">Entregar Tarea</a>
                                    @else
                                        <button class="btn btn-success btn-sm" disabled>Tarea Entregada</button>
                                    @endif
                                </div>
                            @empty
                                <p class="text-muted">No hay tareas asignadas a este grupo para este entregable.</p>
                            @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop
