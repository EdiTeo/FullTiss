@extends('adminlte::page')

@section('title', 'Mostrar Entregable')

@section('content_header')
    <h1>{{ $entregable->name ?? 'Mostrar Entregable' }}</h1>
@stop

@section('content')
    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-gray-900">Mostrar Entregable
                                <a type="button" href="{{ route('entregables.index') }}" class="btn btn-danger float-end">Volver</a>
                            </h1>
                            <p class="mt-2 text-sm text-gray-700">Detalles del entregable.</p>
                        </div>
                        
                    </div>

                    <div class="card">
                        <div class="card-body">
                             
                            
                            <dl class="row">
                                <dt class="col-sm-3">Docente Id</dt>
                                <dd class="col-sm-9">{{ $entregable->docente_id }}</dd>
                    
                                <dt class="col-sm-3">Nombre</dt>
                                <dd class="col-sm-9">{{ $entregable->nombre }}</dd>
                    
                                <dt class="col-sm-3">Descripción</dt>
                                <dd class="col-sm-9">{{ $entregable->descripcion }}</dd>
                    
                                <dt class="col-sm-3">Peso</dt>
                                <dd class="col-sm-9">{{ $entregable->peso }}</dd>
                            </dl>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Añadir aquí estilos personalizados --}}
@stop

@section('js')
    <script> console.log("Mostrando detalles del entregable"); </script>
@stop
