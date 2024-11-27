<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


<form action="{{ route('rubrica.store') }}" method="POST" enctype="multipart/form-data"> 
    @csrf
    <div class="d-flex justify-content-between align-items-center">
        <label class="titulo-rubrica" for="titulo">Título de la Rúbrica</label>
        <button  onclick="history.back()" type="button" class="btn btn-danger float-end">Atrás</button >
    </div>
    <input type="text" name="titulo" class="input-field form-control" placeholder="Título de la rúbrica" required>

    <div id="criterios">
        
        <label class="titulo-rubrica">Criterios</label>
        <button type="button" class="add-button" onclick="agregarCriterio()">+ Añadir un criterio</button>
    </div>

    <button type="submit" class="btn btn-success mt-3 submit-button">Guardar Rúbrica</button>
</form>


<script>
    let criterioIndex = 1;

    function agregarCriterio() {
    const criterioHtml = `
        <div class="criterio" id="criterio-${criterioIndex}">
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="titulo_criterio_${criterioIndex}">Título del Criterio</label>
                    <input type="text" class="form-control" id="titulo_criterio_${criterioIndex}" name="criterios[${criterioIndex}][titulo_criterio]" placeholder="Título del Criterio" required>
                    <div class="valid-feedback">Looks good!</div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="peso_${criterioIndex}">Peso</label>
                    <input type="number" class="form-control" id="peso_${criterioIndex}" name="criterios[${criterioIndex}][peso]" placeholder="Peso" required>
                    <div class="valid-feedback">Looks good!</div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="descripcion_${criterioIndex}">Descripción</label>
                    <input type="text" class="form-control" id="descripcion_${criterioIndex}" name="criterios[${criterioIndex}][descripcion]" placeholder="Descripción">
                </div>
            </div>
            <button class="btn btn-outline-danger mb-3" type="button" onclick="eliminarCriterio(${criterioIndex})">Eliminar</button>

            <div class="niveles" id="niveles-${criterioIndex}">
                <label class="titulo-rubrica">Niveles</label>
                <button type="button" onclick="agregarNivel(${criterioIndex})" class="btn btn-outline-success mb-3">+ Agregar Nivel</button>
                <div class="nivel">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="nombre_nivel_0_${criterioIndex}">Nombre del Nivel</label>
                            <input type="text" class="form-control" id="nombre_nivel_0_${criterioIndex}" name="criterios[${criterioIndex}][niveles][0][nombre_nivel]" placeholder="Nombre del Nivel" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="puntuacion_0_${criterioIndex}">Puntuación</label>
                            <input type="number" class="form-control" id="puntuacion_0_${criterioIndex}" name="criterios[${criterioIndex}][niveles][0][puntuacion]" placeholder="Puntuación" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="descripcion_nivel_0_${criterioIndex}">Descripción</label>
                            <input type="text" class="form-control" id="descripcion_nivel_0_${criterioIndex}" name="criterios[${criterioIndex}][niveles][0][descripcion]" placeholder="Descripción">
                        </div>
                    </div>
                    <button class="btn btn-outline-danger mb-3" type="button" onclick="eliminarNivel(this)">Eliminar Nivel</button>
                </div>
            </div>
        </div>`;
    document.getElementById('criterios').insertAdjacentHTML('beforeend', criterioHtml);
    criterioIndex++;
}

function agregarNivel(criterioId) {
    const nivelesContainer = document.getElementById(`niveles-${criterioId}`);
    const nivelCount = nivelesContainer.querySelectorAll('.nivel').length;
    const nivelHtml = `
        <div class="nivel">
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="nombre_nivel_${nivelCount}_${criterioId}">Nombre del Nivel</label>
                    <input type="text" class="form-control" id="nombre_nivel_${nivelCount}_${criterioId}" name="criterios[${criterioId}][niveles][${nivelCount}][nombre_nivel]" placeholder="Nombre del Nivel" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="puntuacion_${nivelCount}_${criterioId}">Puntuación</label>
                    <input type="number" class="form-control" id="puntuacion_${nivelCount}_${criterioId}" name="criterios[${criterioId}][niveles][${nivelCount}][puntuacion]" placeholder="Puntuación" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="descripcion_nivel_${nivelCount}_${criterioId}">Descripción</label>
                    <input type="text" class="form-control" id="descripcion_nivel_${nivelCount}_${criterioId}" name="criterios[${criterioId}][niveles][${nivelCount}][descripcion]" placeholder="Descripción">
                </div>
            </div>
            <button class="btn btn-outline-danger mb-3" type="button" onclick="eliminarNivel(this)">Eliminar Nivel</button>
        </div>`;
    nivelesContainer.insertAdjacentHTML('beforeend', nivelHtml);
}
    function eliminarCriterio(criterioId) {
        const criterio = document.getElementById(`criterio-${criterioId}`);
        criterio.remove();
    }

    function eliminarNivel(button) {
        const nivel = button.closest('.nivel');
        nivel.remove();
    }

</script>
<style>
     body {
        font-family: Arial, sans-serif,'Source Sans Pro';
        background-color: #f8f9fa;
    }

    form {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .titulo-rubrica {
        font-size: 1.2em;
        font-weight: bold;
        color: #4f46e5;
    }

    .input-field {
        display: block;
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: #f1f3f4;
        font-size: 1em;
        box-sizing: border-box;

    }
    .textarea-field {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
            resize: none;
            overflow: hidden;
        }
    .criterio {
        padding: 15px;
        margin: 15px 0;
        background-color: #f1f3f4;
        border-radius: 8px;
        border-left: 4px solid #4f46e5;
        position: relative;
    }

    .niveles {
        margin-top: 10px;
    }

    .nivel {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin-top: 10px;
        background-color: #f1f3f4;
        position: relative;
    }

    .add-button, .delete-button {
        color: #4f46e5;
        font-weight: bold;
        background: none;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        font-size: 0.9em;
    }

    .add-button:hover, .delete-button:hover {
        text-decoration: underline;
    }

    .submit-button {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #0f3669;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 1em;
        cursor: pointer;
        margin-top: 20px;
    }

    .submit-button:hover {
        background-color: #4f46e5;
    }

    .cancel-button {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #d9534f;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 1em;
        cursor: pointer;
        margin-top: 10px;
    }

    .cancel-button:hover {
        background-color: #c9302c;
    }

    .delete-button {
        position: absolute;
        top: 10px;
        right: 10px;
        color: #fff;
        background-color: #c9302c;
    }
</style>