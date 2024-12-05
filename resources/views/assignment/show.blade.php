@extends('adminlte::page')
@section('title', 'Ver asignaciones')
@section('content_header')
    <h1>Ver asignaciones</h1>
@stop
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Ver asignaciones
                            <a href="{{ route('assignments.index') }}" class="btn btn-danger float-end">Atrás</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="mt-6 border-t border-gray-100">
                            <dl class="divide-y divide-gray-100">
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Docente</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $assignment->docente->name }}</dd>
                                </div>
                                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Estudiante</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $assignment->estudiante->name }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop
@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
