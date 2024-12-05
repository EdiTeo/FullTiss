<div class="mb-4">

    <!-- Campo de solo lectura para mostrar el nombre del docente -->
    <div class="mb-3">
        <label for="docente_nombre" class="form-label">Docente</label>
        <input type="text" id="docente_nombre" class="form-control bg-light text-muted" value="{{ $docente->name }}" readonly>
    </div>
    
    <!-- Campo oculto para enviar el docente_id -->
    <input type="hidden" name="docente_id" value="{{ $docente->id }}">

    <!-- Mostrar el peso restante -->
    <div class="mb-3">
        <label for="peso_restante" class="form-label">Peso Restante</label>
        <input type="text" id="peso_restante" class="form-control bg-light text-muted" value="{{ $pesoRestante }}" readonly>
    </div>

    <!-- Campos para crear el entregable -->
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $entregable?->nombre) }}" autocomplete="nombre" placeholder="Nombre">
        @error('nombre')
            <span class="text-danger small mt-2">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ old('descripcion', $entregable?->descripcion) }}" autocomplete="descripcion" placeholder="Descripción">
        @error('descripcion')
            <span class="text-danger small mt-2">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="peso" class="form-label">Peso</label>
        <input type="number" name="peso" id="peso" class="form-control" value="{{ old('peso', $entregable?->peso) }}" autocomplete="peso" placeholder="Peso" max="{{ $pesoRestante }}">
        @error('peso')
            <span class="text-danger small mt-2">{{ $message }}</span>
        @enderror
    </div>

    <div class="d-flex justify-content-end mt-4">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
    
</div>
