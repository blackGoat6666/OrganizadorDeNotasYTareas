<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(Item $item) {
        $editingItemId = $item->id;
        $editingShoppingListId = null;
        $user = Auth::user();
        $shoppinglists = $user->shoppingList()->with('items')->paginate(4);
        return view('shoppinglist.index', compact('shoppinglists', 'editingShoppingListId', 'editingItemId'));
    }

    public function store(Request $request) {
        $item = Item::create([
            'name'=>$request->name,
            'quantity'=>$request->quantity, 
            'price'=>$request->price,
            'state'=>0,
            'shopping_list_id'=>$request->shoppinglist_id,
        ]);
        $item->save();
        return redirect()->route('shoppinglist.index');
    }

    public function update(Request $request, Item $item) {
        $item->name = $request->name;
        $item->quantity = $request->quantity;
        $item->price = $request->price;
        $item->updated_at = now(); 
        $item->save();
        return redirect()->route('shoppinglist.index');
    }
    
    public function destroy(Item $item) {
        $item->delete();
        return redirect()->route('shoppinglist.index');
    }
}
