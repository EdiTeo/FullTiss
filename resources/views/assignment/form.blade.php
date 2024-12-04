<form method="POST" action="{{ $assignment->exists ? route('assignments.update', $assignment->id) : route('assignments.store') }}">
    @csrf
    @if($assignment->exists)
        @method('PUT')
    @endif

    <div class="mb-4">
        <label for="docente_id" class="block text-sm font-medium text-gray-700">Seleccionar Docente:</label>
        <ul class="list-disc pl-5">
            @foreach($docentes as $index => $docente)
                <li>
                    <input type="radio" id="docente_{{ $docente->id }}" name="docente_id" value="{{ $docente->id }}" {{ (old('docente_id') == $docente->id || (isset($assignment) && $assignment->docente_id == $docente->id)) ? 'checked' : '' }}>
                    <label for="docente_{{ $docente->id }}">{{ $index + 1 }}. {{ $docente->name }}</label>
                </li>
            @endforeach
        </ul>
        @if ($errors->has('docente_id'))
            <p class="text-sm text-red-600 mt-2">{{ $errors->first('docente_id') }}</p>
        @endif
    </div>

    <div class="mb-4">
        <label for="estudiante_id" class="block text-sm font-medium text-gray-700">Seleccionar Estudiantes:</label>
        <ul class="list-disc pl-5">
            @foreach($estudiantes as $index => $estudiante)
                <li>
                    <input type="checkbox" id="estudiante_{{ $estudiante->id }}" name="estudiante_ids[]" value="{{ $estudiante->id }}" {{ (is_array(old('estudiante_ids')) && in_array($estudiante->id, old('estudiante_ids'))) || (isset($estudiantesAsignados) && in_array($estudiante->id, $estudiantesAsignados)) ? 'checked' : '' }}>
                    <label for="estudiante_{{ $estudiante->id }}">{{ $index + 1 }}. {{ $estudiante->name }}</label>
                </li>
            @endforeach
        </ul>
        @if ($errors->has('estudiante_ids'))
            <p class="text-sm text-red-600 mt-2">{{ $errors->first('estudiante_ids') }}</p>
        @endif
    </div>

    <div class="flex items-center gap-4">
        <button type="submit" class="bg-indigo-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-600 focus:ring focus:ring-indigo-300">
            Guardar
        </button>
    </div>
</form>
