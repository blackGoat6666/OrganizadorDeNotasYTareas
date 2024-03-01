<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        /*$notes = Notes::where();
        return view('dragones.index', compact('dragones'));*/
    }

    
}
