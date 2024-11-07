<div class="space-y-6"> 
    <div>
        <label for="tarea_id" class="block font-medium text-sm text-gray-700">Tarea Id</label>
        <input id="tarea_id" name="tarea_id" type="text" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" value="{{ old('tarea_id', $entrega?->tarea_id) }}" autocomplete="tarea_id" placeholder="Tarea Id"/>
        @error('tarea_id') <div class="text-sm text-red-600 mt-2">{{ $message }}</div> @enderror
    </div>
    <div>
        <label for="grupo_id" class="block font-medium text-sm text-gray-700">Grupo Id</label>
        <input id="grupo_id" name="grupo_id" type="text" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" value="{{ old('grupo_id', $entrega?->grupo_id) }}" autocomplete="grupo_id" placeholder="Grupo Id"/>
        @error('grupo_id') <div class="text-sm text-red-600 mt-2">{{ $message }}</div> @enderror
    </div>
    <div>
        <label for="user_id" class="block font-medium text-sm text-gray-700">User Id</label>
        <input id="user_id" name="user_id" type="text" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" value="{{ old('user_id', $entrega?->user_id) }}" autocomplete="user_id" placeholder="User Id"/>
        @error('user_id') <div class="text-sm text-red-600 mt-2">{{ $message }}</div> @enderror
    </div>
    <div>
        <label for="archivo" class="block font-medium text-sm text-gray-700">Archivo</label>
        <input id="archivo" name="archivo" type="text" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" value="{{ old('archivo', $entrega?->archivo) }}" autocomplete="archivo" placeholder="Archivo"/>
        @error('archivo') <div class="text-sm text-red-600 mt-2">{{ $message }}</div> @enderror
    </div>

    <div class="flex items-center gap-4">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
    </div>
</div>
