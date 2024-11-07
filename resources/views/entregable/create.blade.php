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
                    <div class="card-header">
                        <h3 class="card-title">Añadir un nuevo Entregable</h3>
                        <div class="card-tools">
                            <a type="button" href="{{ route('entregables.index') }}" class="btn btn-primary btn-sm">Volver</a>
                        </div>
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
