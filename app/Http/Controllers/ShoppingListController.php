<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ShoppingList;
use Carbon\Carbon;


class ShoppingListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $user = Auth::user();
        $shoppinglists = $user->shoppingList()->with('items')->paginate(4);
        $editingShoppingListId = null;
        $editingItemId = null;
        return view('shoppinglist.index', compact('shoppinglists', 'editingShoppingListId', 'editingItemId'));
    }

    public function store() {
        $user = Auth::user();
        $shoppinglist = ShoppingList::create([
            'date' => Carbon::now(),
            'user_id' => $user->id, 
        ]);
        $shoppinglist->save();
        return redirect()->route('shoppinglist.index');
    }

    public function edit(ShoppingList $shoppinglist) {
        $editingShoppingListId = $shoppinglist->id;
        $editingItemId = null;
        $user = Auth::user();
        $shoppinglists = $user->shoppingList()->with('items')->paginate(4);
        return view('shoppinglist.index', compact('shoppinglists', 'editingShoppingListId', 'editingItemId'));
    }

    public function update(Request $request, ShoppingList $shoppinglist) {
        //$date = $shoppinglist->date;
        $date = Carbon::create($request->year, $request->month, $request->day);
        $shoppinglist->date = $date;
        $shoppinglist->updated_at = now(); 
        $shoppinglist->save();
        return redirect()->route('shoppinglist.index');
    }


    public function destroy(ShoppingList $shopinglist) {
        $shopinglist->delete();
        return redirect()->route('shoppinglist.index');
    }
}
