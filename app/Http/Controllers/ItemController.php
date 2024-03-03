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
    
    public function destroy(Item $item) {
        $item->delete();
        return redirect()->route('shoppinglist.index');
    }
}
