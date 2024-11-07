<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Grupo') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('grupos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="nombre">Nombre del Grupo</label>
                        <input type="text" name="nombre" required class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>
                    <div class="mt-4">
                        <label for="descripcion">Descripción</label>
                        <textarea name="descripcion" class="mt-1 block w-full border-gray-300 rounded-md"></textarea>
                    </div>
                    <div class="mt-4">
                        <label for="estudiantes">Integrantes Seleccionados</label>
                        <div class="mt-2">
                            @foreach ($companeros as $companero)
                                <div>
                                    <input type="checkbox" name="estudiantes[]" value="{{ $companero->id }}" id="estudiante_{{ $companero->id }}" checked>
                                    <label for="estudiante_{{ $companero->id }}">{{ $companero->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-4">
                        <label for="solvencia_tecnica">Solvencia Técnica (PDF)</label>
                        <input type="file" name="solvencia_tecnica" required class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>
                    <div class="mt-4">
                        <label for="boleta_garantia">Boleta de Garantía (PDF)</label>
                        <input type="file" name="boleta_garantia" required class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>
                    <button type="submit" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Crear Grupo
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
