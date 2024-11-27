@extends('adminlte::page')

@section('title', 'Crear Entregable')

@section('content_header')
    <h1 class="text-xl font-semibold">Crear Entregable</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Añadir un nuevo Entregable</h3>
                        <a href="{{ route('entregables.index') }}" class="btn btn-danger float-end">Volver</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('entregables.store') }}" role="form" enctype="multipart/form-data">
                            @csrf
                            @include('entregable.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Aquí puedes añadir tus estilos personalizados --}}
@stop

@section('js')
    <script> console.log("Formulario de creación de entregable cargado"); </script>
@stop
