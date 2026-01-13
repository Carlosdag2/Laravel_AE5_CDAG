<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarea</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], textarea, select { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        .btn { padding: 10px 15px; text-decoration: none; border-radius: 5px; display: inline-block; margin: 5px; border: none; cursor: pointer; }
        .btn-success { background: #28a745; color: white; }
        .btn-secondary { background: #6c757d; color: white; }
        .error { color: red; font-size: 14px; }
    </style>
</head>
<body>
    <h1>Editar Tarea</h1>

    @if ($errors->any())
        <div style="background: #f8d7da; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="error">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tareas.update', $tarea) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="titulo">Título *</label>
            <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $tarea->titulo) }}" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="4">{{ old('descripcion', $tarea->descripcion) }}</textarea>
        </div>

        <div class="form-group">
            <label for="estado">Estado *</label>
            <select id="estado" name="estado" required>
                <option value="pendiente" {{ old('estado', $tarea->estado) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="completada" {{ old('estado', $tarea->estado) == 'completada' ? 'selected' : '' }}>Completada</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Actualizar Tarea</button>
        <a href="{{ route('tareas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</body>
</html>