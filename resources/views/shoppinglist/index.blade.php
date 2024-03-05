@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row row-cols-3">
        <h1>Listas de compras</h1>
        <a href="{{ route('home') }}" class="btn btn-sm btn-primary">Volver</a>
        <form action="{{ route('shoppinglist.store') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-sm btn-primary">Nueva</button>
        </form>
    </div>

    <div class="row row-cols-1" id="ShoppingListContainer">
        @foreach($shoppinglists as $shoppinglist)
            <div class="card mb-3" data-shoppinglist-id="{{ $shoppinglist->id }}">
                <div class="card-header d-flex justify-content-md-around">
                    <div>Cantidad</div>
                    <div class="d-flex justify-content-between"><a>Fecha: </a>
                        @if($shoppinglist->id == $editingShoppingListId)
                            <form action="{{ route('shoppinglist.update', $shoppinglist) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <textarea name="year" class="form-control">{{ date('Y', strtotime($shoppinglist->date)) }}</textarea>
                                <textarea name="month" class="form-control">{{ date('m', strtotime($shoppinglist->date)) }}</textarea>
                                <textarea name="day" class="form-control">{{ date('d', strtotime($shoppinglist->date)) }}</textarea>
                                <button type="submit" class="btn btn-sm btn-primary mt-2">Guardar</button>
                            </form>
                        @else
                            <a> {{$shoppinglist->date}}</a>
                        @endif
                    </div>
                    <div><a>Precio</a></div>
                    <div class="d-flex flex-row">
                        <div><a href="{{ route('shoppinglist.edit', $shoppinglist) }}" class="btn btn-sm btn-primary">Editar</a></div>
                        <div>
                            <form action="{{ route('shopinglist.destroy', $shoppinglist) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-primary">Borrar</button>
                            </form>
                        </div>
                        <div>
                            <a class="btn btn-sm btn-primary" onclick="agregarNuevoItem({{ $shoppinglist->id }})">Nuevo item</a>
                        </div>
                    </div>
                </div>

                <div class="card-body justify-content-md-around">
                    <div class="list-group">
                        @foreach($shoppinglist->items as $item)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                @if($item->id == $editingItemId)
                                    <form action="{{ route('item.update', $item) }}" method="POST" class="d-flex align-items-center">
                                        @csrf
                                        @method('PUT')
                                        <div class="col">
                                            <input type="text" name="quantity" class="form-control" value="{{ $item->quantity }}">
                                        </div>
                                        <div class="col">
                                            <input type="text" name="name" class="form-control" value="{{ $item->name }}">
                                        </div>
                                        <div class="col">
                                            <input type="text" name="price" class="form-control" value="{{ $item->price }}">
                                        </div>
                                        <div class="col">
                                            <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                                        </div>
                                    </form>
                                    <form action="{{ route('item.destroy', $item) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="col">
                                            <button type="submit" class="btn btn-sm btn-primary">Borrar</button>
                                        </div>
                                    </form>
                                @else
                                    <div class="col">{{ $item->quantity }}</div>
                                    <div class="col">{{ $item->name }}</div>
                                    <div class="col">${{ $item->price }}</div>
                                    <div class="col">
                                        <a href="{{ route('item.edit', $item) }}" class="btn btn-sm btn-primary">Editar</a>
                                    </div>
                                    <div class="col">
                                        <form action="{{ route('item.destroy', $item) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-primary">Borrar</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $shoppinglists->links('pagination::bootstrap-4') }}
    </div>
</div>


<script>
    function agregarNuevoItem(shoppinglistId) {
        // Crea un nuevo elemento div para el nuevo item
        var nuevoItem = document.createElement('div');
        nuevoItem.className = 'list-group-item d-flex justify-content-between align-items-center';
        nuevoItem.innerHTML = `
            <form action="{{ route('item.store') }}" method="POST" class="d-flex align-items-center">
                @csrf
                <div class="col">
                    <input type="text" name="quantity" class="form-control" placeholder="Cantidad">
                </div>
                <div class="col">
                    <input type="text" name="name" class="form-control" placeholder="Nombre">
                </div>
                <div class="col">
                    <input type="text" name="price" class="form-control" placeholder="Precio">
                </div>
                <input type="hidden" name="shoppinglist_id" value="${shoppinglistId}">
                <div class="col">
                    <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                </div>
            </form>
        `;
        // Encuentra la lista de compras correspondiente y agrega el nuevo item arriba de los items existentes
        var shoppinglistContainer = document.querySelector('#ShoppingListContainer');
        var shoppinglist = shoppinglistContainer.querySelector(`[data-shoppinglist-id='${shoppinglistId}']`);
        var listGroup = shoppinglist.querySelector('.list-group');
        listGroup.insertBefore(nuevoItem, listGroup.firstChild);
    }
</script>

@endsection
