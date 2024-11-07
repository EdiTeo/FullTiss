<div class="space-y-6">

    <!-- Campo de solo lectura para mostrar el nombre del docente -->
    <div>
        <label for="docente_nombre" class="block text-sm font-medium text-gray-700">Docente</label>
        <input type="text" id="docente_nombre" class="mt-1 block w-full bg-gray-100 text-gray-500 cursor-not-allowed" value="{{ $docente->name }}" readonly>
    </div>
    

    <!-- Campo oculto para enviar el docente_id -->
    <input type="hidden" name="docente_id" value="{{ $docente->id }}">

    <!-- Campos para crear el entregable -->
    <div>
        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="mt-1 block w-full" value="{{ old('nombre', $entregable?->nombre) }}" autocomplete="nombre" placeholder="Nombre">
        @error('nombre')
            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
        <input type="text" name="descripcion" id="descripcion" class="mt-1 block w-full" value="{{ old('descripcion', $entregable?->descripcion) }}" autocomplete="descripcion" placeholder="Descripción">
        @error('descripcion')
            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="peso" class="block text-sm font-medium text-gray-700">Peso</label>
        <input type="text" name="peso" id="peso" class="mt-1 block w-full" value="{{ old('peso', $entregable?->peso) }}" autocomplete="peso" placeholder="Peso">
        @error('peso')
            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
        @enderror
    </div>

    <div class="flex items-center gap-4">
        <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">Submit</button>
    </div>
    
</div>
