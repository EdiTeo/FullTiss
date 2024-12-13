@extends('adminlte::page')

@section('title', 'Registrar Asistencia')

@section('content_header')
    <h1 class="m-0 text-dark">Registrar Asistencia para el Grupo: {{ $grupo->nombre }}</h1>
@stop

@section('content')
    <div class="container">
        <form action="{{ route('asistencias.guardar', $grupo->id) }}" method="POST" id="grupo-form">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lista de Estudiantes</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Estudiante</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Justificación (opcional)</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estudiantes as $estudiante)
                                <tr>
                                    <td>{{ $estudiante->name }}</td>
                                    <td>
                                        <input type="date" name="fechas[{{ $estudiante->id }}]" class="form-control" required>
                                    </td>
                                    <td>
                                        <select name="asistencias[{{ $estudiante->id }}]" class="form-control" required>
                                            <option value="presente">Presente</option>
                                            <option value="retraso">Tarde</option>
                                            <option value="ausente_justificado">Ausente Justificado</option>
                                            <option value="ausente_no_justificado">Ausente No Justificado</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="justificaciones[{{ $estudiante->id }}]" class="form-control" placeholder="Justificación">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-azul-oscuro btn-sm" onclick="guardarAsistencia({{ $estudiante->id }})">Guardar Asistencia</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Guardar Asistencia Grupal</button>
                    <a href="{{ route('grupos.verCalificaciones', $grupo->id) }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
@stop

@section('css')
    <style>
        .btn-azul-oscuro {
            background-color: #1E90FF; /* Azul Oscuro */
            color: white;
        }
    </style>
@stop

@section('js')
    <script>
        function guardarAsistencia(estudianteId) {
            const form = document.createElement('form');
            form.action = '{{ route('asistencias.guardarIndividuo', [$grupo->id, '']) }}/' + estudianteId;
            form.method = 'POST';
            form.style.display = 'none';

            const csrfInput = document.createElement('input');
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);

            const fechaInput = document.createElement('input');
            fechaInput.name = 'fecha';
            fechaInput.value = document.querySelector(`input[name="fechas[${estudianteId}]"]`).value;
            form.appendChild(fechaInput);

            const estadoInput = document.createElement('input');
            estadoInput.name = 'estado';
            estadoInput.value = document.querySelector(`select[name="asistencias[${estudianteId}]"]`).value;
            form.appendChild(estadoInput);

            const justificacionInput = document.createElement('input');
            justificacionInput.name = 'justificacion';
            justificacionInput.value = document.querySelector(`input[name="justificaciones[${estudianteId}]"]`).value;
            form.appendChild(justificacionInput);

            document.body.appendChild(form);
            form.submit();
        }
    </script>
    <script> console.log("Formulario de Registro de Asistencia cargado en AdminLTE"); </script>
@stop
