@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row row-cols-3">
        <h1>Listas de compras</h1>
        <a href="{{ route('home') }}" class="btn btn-sm btn-primary">Volver</a>
        <form action="{{route('shoppinglist.store')}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-primary">Nueva</button>
        </form>
    </div>

    <div class="row row-cols-1" id="ShoppingListContainer">
    @foreach($shoppinglists as $shoppinglist)
    <div class="card mb-3">
        
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
                <div><form action="{{ route('shopinglist.destroy', $shoppinglist) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-primary">Borrar</button>
                </form>
                </div>
            </div>
        </div>

        
        <div class="card-body justify-content-md-around">
                <div class="list-group">
                    @foreach($shoppinglist->items as $item)
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div><a>{{$item->quantity}}</a></div>
                        <div class="d-flex justify-content-between"><a>{{ $item->name }}</a></div>
                        <div class="d-flex justify-content-between"><a>${{$item->price}}</a></div>
                        <div class="d-flex flex-row">
                            <div><a href="" class="btn btn-sm btn-primary">Editar</a></div>
                            <div><form action="{{ route('item.destroy', $item) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-primary">Borrar</button>
                                </form>
                            </div>
                        </div>
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


@endsection
