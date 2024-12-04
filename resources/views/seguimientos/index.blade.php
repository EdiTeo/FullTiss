@extends('adminlte::page')

@section('title', 'Seguimientos')

@section('content_header')
    <h1 class="m-0 text-dark">Seguimientos Semanales</h1>
@stop
<!--TERMINE SEGUIMIENTO PARA GRUPOS-->
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Resumen de Seguimientos</h2>
        <a href="{{ route('seguimientos.create') }}" class="btn btn-primary">Añadir Seguimiento</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($seguimientos->isEmpty())
        <div class="alert alert-info">No hay seguimientos registrados.</div>
    @else
        <div class="row">
            @foreach ($seguimientos as $seguimiento)
                <div class="col-md-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5>Fecha: {{ $seguimiento->fecha }}</h5>
                        </div>
                        <div class="card-body">
                            <h6><strong>Presentado:</strong></h6>
                            <p>{{ Str::limit($seguimiento->presentado, 50) }}</p>
                            <h6><strong>Pendiente:</strong></h6>
                            <p>{{ Str::limit($seguimiento->pendiente, 50) }}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('seguimientos.show', $seguimiento->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('seguimientos.edit', $seguimiento->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('seguimientos.destroy', $seguimiento->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@stop
