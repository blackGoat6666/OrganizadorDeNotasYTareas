<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = Auth::id();
        // También puedes acceder al modelo completo del usuario
        $user = Auth::user();
        $notes = $user->notes()->paginate(3);
        $shoppinglists = $user->shoppingList()->with('items')->paginate(3);
        $tasklists = $user->taskList()->with('tasks')->paginate(3);

        // Hacer algo con el ID o el modelo del usuario aquí

        return view('home', compact('notes', 'shoppinglists','tasklists'));
    }
}
