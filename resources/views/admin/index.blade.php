@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>
        @if($user->hasRole('docente'))
            Dashboard Docentes
        @elseif($user->hasRole('estudiante'))
            Dashboard Estudiantes
        @elseif($user->hasRole('super-admin'))
            Dashboard Administrador
        @else
            Dashboard
        @endif
    </h1>
@stop

@section('content')
    @if($user->hasRole('docente'))
        <div class="docente-section">
            <h2>Bienvenidos al Dashboard de Docentes</h2>
            <p>Aquí podrás:</p>
            <ul>
                <li>Ver y gestionar a tus estudiantes.</li>
                <li>Ver los grupos de los estudiantes.</li>
                <li>Crear y gestionar entregables con peso de nota.</li>
                <li>Asignar tareas a los entregables con rúbricas.</li>
                <li>Crear evaluaciones.</li>
                <li>Calificar a los grupos según las tareas entregadas.</li>
                <li>Acceder a una planilla de grupo para revisar las notas de los integrantes.</li>
            </ul>
        </div>
    @elseif($user->hasRole('estudiante'))
        <div class="estudiante-section">
            <h2>Bienvenidos al Dashboard de Estudiantes</h2>
            <p>En esta sección, podrás:</p>
            <ul>
                <li>Ver tus calificaciones y comentarios de los docentes.</li>
                <li>Ver a tus compañeros de materia.</li>
                <li>Crear y gestionar grupos de trabajo.</li>
                <li>Planificar y gestionar tareas asignadas según los entregables.</li>
                <li>Realizar seguimientos semanales de tu progreso.</li>
                <li>Participar en evaluaciones y autoevaluaciones.</li>
            </ul>
        </div>
    @elseif($user->hasRole('super-admin'))
        <div class="admin-section">
            <h2>Bienvenidos al Dashboard de Administrador</h2>
            <p>Desde aquí podrás:</p>
            <ul>
                <li>Gestionar roles, permisos y usuarios.</li>
                <li>Crear y gestionar perfiles de docentes y estudiantes.</li>
                <li>Asignar estudiantes a los docentes.</li>
                <li>Supervisar el uso de la plataforma.</li>
            </ul>
        </div>
    @else
        <p>Bienvenidos a ADMINLTE</p>
    @endif
@stop

@section('css')
    <style>
        .docente-section, .estudiante-section, .admin-section {
            background-color: #f4f6f9;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .docente-section h2, .estudiante-section h2, .admin-section h2 {
            margin-top: 0;
        }
        .docente-section ul, .estudiante-section ul, .admin-section ul {
            list-style-type: disc;
            padding-left: 20px;
        }
        .docente-section li, .estudiante-section li, .admin-section li {
            margin-bottom: 5px;
        }
    </style>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
