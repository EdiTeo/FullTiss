<div class="space-y-6">
    <!-- Campo para el Id del entregable -->
    <div x-data="{ selected: {{ old('entregable_id', $tarea?->entregable_id ?? 'null') }} }">
        <label class="block text-sm font-medium text-gray-700 mb-4">Selecciona un Entregable</label>
        
        <div class="grid grid-cols-2 gap-4">
            @foreach ($entregables as $entregable)
                <div 
                    @click="selected = {{ $entregable->id }}" 
                    :class="selected === {{ $entregable->id }} ? 'bg-blue-500 text-white border-blue-700' : 'bg-gray-100 text-gray-800 border-gray-300'" 
                    class="p-4 rounded-lg cursor-pointer border shadow-sm transition duration-300 ease-in-out transform hover:scale-105"
                >
                    <input type="radio" name="entregable_id" value="{{ $entregable->id }}" 
                           x-model="selected" 
                           class="hidden" />
                    <p class="font-semibold">{{ $entregable->nombre }}</p>
                    <p class="text-sm mt-1">{{ $entregable->descripcion }}</p>
                </div>
            @endforeach
        </div>
    
        @error('entregable_id')
            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
        @enderror
    </div>
    
    <!-- Campo de solo lectura para mostrar el nombre del docente -->
    <div>
        <label for="docente_nombre" class="block text-sm font-medium text-gray-700">Docente</label>
        <input type="text" id="docente_nombre" class="mt-1 block w-full bg-gray-100 text-gray-500 cursor-not-allowed" value="{{ $docente->name }}" readonly>
    </div>

    <!-- Campo oculto para enviar el docente_id -->
    <input type="hidden" name="docente_id" value="{{ $docente->id }}">

    <!-- Campo para el nombre -->
    <div>
        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
        <input type="text" id="nombre" name="nombre" class="mt-1 block w-full" value="{{ old('nombre', $tarea?->nombre) }}" autocomplete="nombre" placeholder="Nombre">
        @error('nombre')
            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
        @enderror
    </div>

    <!-- Campo para la descripción -->
    <div>
        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
        <input type="text" id="descripcion" name="descripcion" class="mt-1 block w-full" value="{{ old('descripcion', $tarea?->descripcion) }}" autocomplete="descripcion" placeholder="Descripción">
        @error('descripcion')
            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
        @enderror
    </div>

    <!-- Campo para el peso -->
    <div>
        <label for="peso" class="block text-sm font-medium text-gray-700">Peso</label>
        <input type="text" id="peso" name="peso" class="mt-1 block w-full" value="{{ old('peso', $tarea?->peso) }}" autocomplete="peso" placeholder="Peso">
        @error('peso')
            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
        @enderror
    </div>

    <!-- Campo para inicio de proyecto -->
    <div>
        <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">Fecha Inicio</label>
        <input type="text" id="fecha_inicio" name="fecha_inicio" class="mt-1 block w-full" value="{{ old('fecha_inicio', $tarea?->fecha_inicio) }}" autocomplete="fecha_inicio" placeholder="Fecha Inicio">
        @error('fecha_inicio')
            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
        @enderror
    </div>

    <!-- Campo para el fin de proyecto-->
    <div>
        <label for="fecha_limite" class="block text-sm font-medium text-gray-700">Fecha Límite</label>
        <input type="text" id="fecha_limite" name="fecha_limite" class="mt-1 block w-full" value="{{ old('fecha_limite', $tarea?->fecha_limite) }}" autocomplete="fecha_limite" placeholder="Fecha Límite">
        @error('fecha_limite')
            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
        @enderror
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            flatpickr("#fecha_inicio", {
                dateFormat: "Y-m-d",
            });
            flatpickr("#fecha_limite", {
                dateFormat: "Y-m-d",
            });
        });
    </script>

    <!-- Botón de envío -->
    <div class="flex items-center gap-4">
        <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">
            {{ isset($tarea->id) ? 'Actualizar Tarea' : 'Crear Tarea' }}
        </button>
    </div>
</div> 
