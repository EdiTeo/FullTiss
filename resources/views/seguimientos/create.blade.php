@extends('adminlte::page')

@section('title', 'Crear Seguimiento')

@section('content_header')
    <h1 class="m-0 text-dark">Crear Seguimiento</h1>
@stop

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3>Nuevo Seguimiento</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('seguimientos.store') }}" method="POST" id="seguimientoForm">
                @csrf

                <!-- Campo Fecha -->
                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha') }}" required>
                </div>

                <!-- Campo Presentado -->
                <div class="form-group">
                    <label for="presentado">Presentado</label>
                    <ul id="presentado-list" class="list-group mb-2">
                        <!-- Los elementos dinámicos se agregarán aquí -->
                    </ul>
                    <input type="hidden" name="presentado" id="presentado" value="{{ old('presentado') }}">
                    <div class="input-group">
                        <input type="text" id="new-presentado-item" class="form-control" placeholder="Agregar ítem...">
                        <button type="button" id="add-presentado" class="btn btn-primary">Agregar</button>
                    </div>
                </div>

                <!-- Campo Pendiente -->
                <div class="form-group">
                    <label for="pendiente">Pendiente</label>
                    <ul id="pendiente-list" class="list-group mb-2">
                        <!-- Los elementos dinámicos se agregarán aquí -->
                    </ul>
                    <input type="hidden" name="pendiente" id="pendiente" value="{{ old('pendiente') }}">
                    <div class="input-group">
                        <input type="text" id="new-pendiente-item" class="form-control" placeholder="Agregar ítem...">
                        <button type="button" id="add-pendiente" class="btn btn-primary">Agregar</button>
                    </div>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('seguimientos.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para mostrar alertas -->
<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alertModalLabel">Atención</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="alertModalBody">El ítem no puede estar vacío.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Entendido</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para campos vacíos -->
<div class="modal fade" id="emptyFieldsModal" tabindex="-1" role="dialog" aria-labelledby="emptyFieldsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="emptyFieldsModalLabel">Campos Vacíos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Debe agregar al menos un ítem en "Presentado" o "Pendiente" antes de guardar.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Entendido</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('seguimientoForm'); //Selecciona el formulario
        const presentadoList = document.getElementById('presentado-list');
        const pendienteList = document.getElementById('pendiente-list');
        const presentadoInput = document.getElementById('presentado');
        const pendienteInput = document.getElementById('pendiente');
        const newPresentadoItem = document.getElementById('new-presentado-item');
        const newPendienteItem = document.getElementById('new-pendiente-item');

        //Función para mostrar el modal
        function showEmptyFieldsModal() {
            $('#emptyFieldsModal').modal('show'); //Utiliza jQuery para activar el modal
        }

        //Función para agregar ítem a la lista
        function addItem(list, inputField, hiddenInput) {
            const itemText = inputField.value.trim();
            if (itemText === '') {
                $('#alertModal').modal('show'); //Muestra el modal de alerta si el campo está vacío
                return;
            }

            //Crear elemento de lista
            const li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between align-items-center';
            li.textContent = itemText;

            //Botón para eliminar ítem
            const removeBtn = document.createElement('button');
            removeBtn.textContent = 'Eliminar';
            removeBtn.className = 'btn btn-danger btn-sm ms-2';
            removeBtn.addEventListener('click', () => {
                li.remove();
                updateHiddenInput(list, hiddenInput);
            });

            li.appendChild(removeBtn);
            list.appendChild(li);

            //Actualizar el campo oculto
            updateHiddenInput(list, hiddenInput);
            inputField.value = ''; //Limpiar el campo de entrada
        }

        //Función para actualizar el campo oculto con los valores de la lista
        function updateHiddenInput(list, hiddenInput) {
            const items = Array.from(list.querySelectorAll('li')).map(item => item.firstChild.textContent.trim());
            hiddenInput.value = items.join(' - '); //Separador entre ítems
        }

        //Agregar ítems Presentado
        document.getElementById('add-presentado').addEventListener('click', () => {
            addItem(presentadoList, newPresentadoItem, presentadoInput);
        });

        //Agregar ítems Pendiente
        document.getElementById('add-pendiente').addEventListener('click', () => {
            addItem(pendienteList, newPendienteItem, pendienteInput);
        });

        //Validar formulario antes de enviar
        form.addEventListener('submit', (e) => {
            const presentadoItems = presentadoList.querySelectorAll('li').length;
            const pendienteItems = pendienteList.querySelectorAll('li').length;

            if (presentadoItems === 0 && pendienteItems === 0) {
                e.preventDefault(); //Evita el envío del formulario
                showEmptyFieldsModal(); //Muestra el modal de campos vacíos
            }
        });
    });
</script>

@stop
