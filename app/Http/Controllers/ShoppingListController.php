<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ShoppingList;


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
        return view('shoppinglist.index', compact('shoppinglists', 'editingShoppingListId'));
    }

    public function destroy(ShoppingList $shopinglist) {
        $shopinglist->delete();
        return redirect()->route('shoppinglist.index');
    }
}
