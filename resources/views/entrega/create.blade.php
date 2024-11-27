@extends('adminlte::page')

@section('title', 'Crear Entrega')

@section('content_header')
    <h1 class="text-xl font-semibold">Crear Entrega</h1>
@stop

@section('content')
    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-gray-900">Crear Entrega</h1>
                            <p class="mt-2 text-sm text-gray-700">Añadir una nueva entrega.</p>
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <a type="button" href="{{ route('entregas.index') }}" class="btn btn-danger">Volver</a>
                        </div>
                    </div>

                    <div class="flow-root">
                        <div class="mt-8 overflow-x-auto">
                            <div class="max-w-xl py-2 align-middle">
                                <form method="POST" action="{{ route('entregas.store') }}" role="form" enctype="multipart/form-data">
                                    @csrf

                                    @include('entrega.form')
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
    {{-- Aquí puedes añadir tus estilos personalizados --}}
@stop

@section('js')
    <script> console.log("Formulario de creación de entrega cargado"); </script>
@stop
