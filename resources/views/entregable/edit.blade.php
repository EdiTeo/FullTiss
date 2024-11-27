@extends('adminlte::page')

@section('title', 'Actualizar Entregable')

@section('content_header')
    <h1>Actualizar Entregable</h1>
@stop

@section('content')
    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-gray-900">Actualizar Entregable
                                <a type="button" href="{{ route('entregables.index') }}" class="btn btn-danger float-end">Volver</a>
                            </h1>
                           
                            <p class="mt-2 text-sm text-gray-700">Actualizar el entregable existente.</p>
                        </div>
                    </div>

                    <div class="flow-root">
                        <div class="mt-8 overflow-x-auto">
                            <div class="max-w-xl py-2 align-middle">
                                <form method="POST" action="{{ route('entregables.update', $entregable->id) }}" role="form" enctype="multipart/form-data">
                                    {{ method_field('PATCH') }}
                                    @csrf
                                    @include('entregable.form')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Añadir aquí hojas de estilo adicionales --}}
@stop

@section('js')
    <script> console.log("Actualizando Entregable en Laravel-AdminLTE"); </script>
@stop
