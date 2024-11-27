<form action="{{ route('entregas.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="p-4 bg-white rounded shadow-lg">
        <div class="mb-3">
            <label for="tarea_id" class="form-label font-weight-bold">Nombre de la Tarea</label>
            <input id="tarea_id" name="tarea_id" type="text" class="form-control bg-gray-100" value="{{ $tarea->nombre }}" readonly>
            @error('tarea_id') <div class="text-danger mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="grupo_id" class="form-label font-weight-bold">Nombre del Grupo</label>
            <input id="grupo_id" name="grupo_id" type="text" class="form-control bg-gray-100" value="{{ $grupo->nombre }}" readonly>
            @error('grupo_id') <div class="text-danger mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="user_id" class="form-label font-weight-bold">Nombre del Usuario</label>
            <input id="user_id" name="user_id" type="text" class="form-control bg-gray-100" value="{{ $user->name }}" readonly>
            @error('user_id') <div class="text-danger mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="archivo" class="form-label font-weight-bold">Archivo</label>
            <input id="archivo" name="archivo" type="file" class="form-control">
            @error('archivo') <div class="text-danger mt-1">{{ $message }}</div> @enderror
        </div>

        <input type="hidden" name="tarea_id" value="{{ $tarea->id }}">
        <input type="hidden" name="grupo_id" value="{{ $grupo->id }}">
        <input type="hidden" name="user_id" value="{{ $user->id }}">

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </div>
</form>
