
<div class="container">
    <h1>{{ isset($sprint) ? 'Editar' : 'Crear' }} Sprint</h1>
    <form action="{{ isset($sprint) ? route('sprints.update', $sprint->id) : route('sprints.store') }}" method="POST">
        @csrf
        @if(isset($sprint))
            @method('PUT')
        @endif
        <div class="space-y-6">
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input id="nombre" name="nombre" type="text" class="mt-1 block w-full" value="{{ old('nombre', $sprint->nombre ?? '') }}" autocomplete="nombre" placeholder="Nombre">
                @error('nombre')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">Fecha Inicio</label>
                <input id="fecha_inicio" name="fecha_inicio" type="date" class="mt-1 block w-full" value="{{ old('fecha_inicio', $sprint->fecha_inicio ?? '') }}" autocomplete="fecha_inicio" placeholder="Fecha Inicio">
                @error('fecha_inicio')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="fecha_fin" class="block text-sm font-medium text-gray-700">Fecha Fin</label>
                <input id="fecha_fin" name="fecha_fin" type="date" class="mt-1 block w-full" value="{{ old('fecha_fin', $sprint->fecha_fin ?? '') }}" autocomplete="fecha_fin" placeholder="Fecha Fin">
                @error('fecha_fin')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="grupo_id" class="block text-sm font-medium text-gray-700">Grupo</label>
                <input id="grupo_id" name="grupo_id" type="text" class="mt-1 block w-full" value="{{ $sprint->grupo->nombre ?? $grupoName }}" readonly>
                @error('grupo_id')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700">Creador</label>
                <input id="user_id" name="user_id" type="text" class="mt-1 block w-full" value="{{ $sprint->user->name ?? $userName }}" readonly>
                @error('user_id')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex items-center gap-4">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">{{ isset($sprint) ? 'Actualizar' : 'Crear' }}</button>
            </div>
        </div>
    </form>
</div>
