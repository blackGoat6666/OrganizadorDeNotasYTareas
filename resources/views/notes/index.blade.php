@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row row-cols-3">
        <h1>Mis Notas</h1>
        <a href="{{ route('home') }}" class="btn btn-sm btn-primary">Volver</a>
        <a href="#" class="btn btn-sm btn-primary" onclick="agregarNuevaNota()">Nueva</a>
    </div>

    <div class="row row-cols-3" id="notasContainer">
        @foreach($notes as $note)
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <a href="{{ route('note.edit', $note) }}" class="btn btn-sm btn-primary">Editar</a>
                    <form action="{{ route('notes.destroy', $note) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-primary">Borrar</button>
                    </form>
                </div>
                <div class="card-body">
                    @if($note->id == $editingNoteId)
                        <form action="{{ route('note.update', $note) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <textarea name="text" class="form-control">{{ $note->text }}</textarea>
                            <button type="submit" class="btn btn-sm btn-primary mt-2">Guardar</button>
                        </form>
                    @else
                        {{ $note->text }}
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $notes->links('pagination::bootstrap-4') }}
    </div>
</div>

<script>
    function agregarNuevaNota() {
        // Crea un nuevo elemento div para la tarjeta de la nota
        var nuevaNota = document.createElement('div');
        nuevaNota.className = 'card mb-3';
        
        // Crea la estructura interna de la tarjeta de la nota
        nuevaNota.innerHTML = `
            <div class="card-header d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-sm btn-primary" onclick="borrarNota(this)">Borrar</button>
            </div>
            <div class="card-body">
                <form action="{{route('note.store')}}" method="POST">
                    @csrf
                    <input type="text" name="text" value="{{old('text')}}">
                    <button type="submit">Guardar</button>
                </form>


            </div>
        `;
        
        // Agrega la nueva tarjeta de nota al contenedor de notas
        document.getElementById('notasContainer').appendChild(nuevaNota);
    }

    function borrarNota(elemento) {
        // Encuentra el div de la tarjeta de la nota y lo elimina
        var tarjetaNota = elemento.closest('.card');
        tarjetaNota.remove();
    }

    
</script>

@endsection
