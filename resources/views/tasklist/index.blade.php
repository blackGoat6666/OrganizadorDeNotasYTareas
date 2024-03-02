@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row row-cols-3">
        <h1>Listas de compras</h1>
        <a href="{{ route('home') }}" class="btn btn-sm btn-primary">Volver</a>
        <a href="#" class="btn btn-sm btn-primary" onclick="">Nueva</a>
    </div>

    <div class="row row-cols-2" id="ShoppingListContainer">
        @foreach($tasklists as $tasklist)
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <a href="" class="btn btn-sm btn-primary">Nuevo Item</a>
                    <form action="{{ route('tasklist.destroy', $tasklist) }}" method="POST">
                        
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-primary">Borrar</button>
                    </form>
                </div>
                <div class="card-body">
                    @if($tasklist->id == $editingTaskListId)
                        <form action="" method="POST">
                            @csrf
                            @method('PUT')
                            <textarea name="text" class="form-control">{{ $tasklist->id }}</textarea>
                            <button type="submit" class="btn btn-sm btn-primary mt-2">Guardar</button>
                        </form>
                    @else
                        
                        <div class="list-group">
                            @foreach($tasklist->tasks as $task)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <a>{{ $task->description }}</a>
                                <a href="" class="btn btn-sm btn-primary">Editar</a>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $tasklists->links('pagination::bootstrap-4') }}
    </div>
</div>


@endsection
