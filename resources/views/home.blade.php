@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row row-cols-3 row-cols-md-3 g-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Notas</span>
                <a href="#" class="btn btn-primary">Crear Nota</a>
            </div>

            <div class="body">
                @foreach($notes as $note)
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>{{ $note->id }}</span>
                        <a href="#" class="btn btn-sm btn-primary">Editar</a>
                    </div>
                    <div class="card-body">{{ $note->text }}</div>
                </div>
                @endforeach
            </div>
            

            <!-- Agregar enlaces de paginación -->
            <div class="d-flex justify-content-center">
                {{ $notes->links('pagination::bootstrap-4') }}
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Lista de compras</span>
                <a href="#" class="btn btn-primary">Crear lista</a>
            </div>

            <div class="body">
                @foreach($shoppinglists as $shoppinglist)
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>{{ $shoppinglist->id }}</span>
                        <a href="#" class="btn btn-sm btn-primary">Editar</a>
                    </div>
                    <div class="card-body">
                        <ul>
                            @foreach($shoppinglist->items as $item)
                            <li>{{ $item->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
            

            <!-- Agregar enlaces de paginación -->
            <div class="d-flex justify-content-center">
                {{ $shoppinglists->links('pagination::bootstrap-4') }}
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Lista de tareas</span>
                <a href="#" class="btn btn-primary">Crear lista</a>
            </div>

            <div class="body">
                @foreach($tasklists as $tasklist)
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>{{ $tasklist->id }}</span>
                        <a href="#" class="btn btn-sm btn-primary">Editar</a>
                    </div>
                    <div class="card-body">
                        <ul>
                            @foreach($tasklist->tasks as $task)
                            <li>{{ $task->description }}</li>
                            @endforeach
                        </ul>

                    </div>
                </div>
                @endforeach
            </div>
            

            <!-- Agregar enlaces de paginación -->
            <div class="d-flex justify-content-center">
                {{ $tasklists->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

</div>
@endsection
