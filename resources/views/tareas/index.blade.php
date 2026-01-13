<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tareas</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
        .btn { padding: 10px 15px; text-decoration: none; border-radius: 5px; display: inline-block; margin: 5px; }
        .btn-primary { background: #007bff; color: white; }
        .btn-success { background: #28a745; color: white; }
        .btn-warning { background: #ffc107; color: black; }
        .btn-danger { background: #dc3545; color: white; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f4f4f4; }
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        .alert-success { background-color: #d4edda; color: #155724; }
        .completada { background-color: #d4edda; }
        .pendiente { background-color: #fff3cd; }
    </style>
</head>
<body>
    <h1>Gestión de Tareas</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('tareas.create') }}" class="btn btn-primary">Nueva Tarea</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Fecha de creación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tareas as $tarea)
                <tr class="{{ $tarea->estado }}">
                    <td>{{ $tarea->id }}</td>
                    <td>{{ $tarea->titulo }}</td>
                    <td>{{ $tarea->descripcion ?? 'Sin descripción' }}</td>
                    <td>{{ ucfirst($tarea->estado) }}</td>
                    <td>{{ $tarea->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('tareas.edit', $tarea) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('tareas.destroy', $tarea) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Seguro que quieres eliminar esta tarea?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">No hay tareas registradas</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>