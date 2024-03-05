@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row row-cols-3">
        <h1>Listas de tareas</h1>
        <a href="{{ route('home') }}" class="btn btn-sm btn-primary">Volver</a>
        <form action="{{ route('tasklist.store') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-sm btn-primary">Nueva</button>
        </form>
    </div>

    <div class="row row-cols-2" id="TaskListContainer">
        @foreach($tasklists as $tasklist)
            <div class="card mb-3" data-tasklist-id="{{ $tasklist->id }}">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <a class="btn btn-sm btn-primary" onclick="agregarNuevaTarea({{ $tasklist->id }})">Nueva tarea</a>
                    <form action="{{ route('tasklist.destroy', $tasklist) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-primary">Borrar</button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @foreach($tasklist->tasks as $task)
                            @if($task->id == $editingTaskId)
                                <form action="{{ route('task.update', $task) }}" method="POST" class="d-flex align-items-center">
                                    @csrf
                                    @method('PUT')
                                    <div class="col">
                                        <input type="text" name="description" class="form-control" value="{{ $task->description }}">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="deadline" class="form-control" value="{{ $task->deadline }}">
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                                    </div>
                                </form>
                            @else
                                <div class="d-flex justify-content-between">
                                    <div class='col'><a>{{ $task->description }}</a></div>
                                    <div class='col'><a>{{ $task->deadline }}</a></div>
                                    <div class='col'><a href="{{ route('task.edit', $task) }}" class="btn btn-sm btn-primary">Editar</a></div>
                                    <div class='col'>
                                        <form action="{{ route('task.destroy', $task) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="col">
                                                <button type="submit" class="btn btn-sm btn-primary">Borrar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $tasklists->links('pagination::bootstrap-4') }}
    </div>
</div>

<script>
    function agregarNuevaTarea(tasklistId) {
        // Crea un nuevo elemento div para la nueva tarea
        var nuevaTarea = document.createElement('div');
        nuevaTarea.className = 'list-group-item d-flex justify-content-between align-items-center';
        nuevaTarea.innerHTML = `
            <form action="{{ route('task.store') }}" method="POST" class="d-flex align-items-center">
                @csrf
                <div class="col">
                    <input type="text" name="description" class="form-control" placeholder="Descripción">
                </div>
                <div class="col">
                    <input type="text" name="deadline" class="form-control" placeholder="Deadline">
                </div>
                <input type="hidden" name="task_list_id" value="${tasklistId}">
                <div class="col">
                    <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                </div>
            </form>
        `;
        // Encuentra la lista de tareas correspondiente y agrega la nueva tarea al principio
        var tasklist = document.querySelector(`[data-tasklist-id='${tasklistId}']`);
        var listGroup = tasklist.querySelector('.list-group');
        listGroup.insertBefore(nuevaTarea, listGroup.firstChild);
    }
</script>

@endsection
