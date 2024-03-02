<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;

class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $user = Auth::user();
        $notes = $user->notes()->paginate(6);
        $editingNoteId = null;
        return view('notes.index', compact('notes', 'editingNoteId'));
    }

    public function store(Request $request) {
        $user = Auth::user(); // Obtener el usuario autenticado
        $noteData = $request->all(); // Obtener todos los datos de la solicitud
        $noteData['user_id'] = $user->id; // Asignar el ID del usuario al campo user_id

        $note = Note::create($noteData); 
        return redirect()->route('notes.index');
    }

    public function edit(Note $note) {
        $editingNoteId = $note->id;
        $user = Auth::user();
        $notes = $user->notes()->paginate(6);
        return view('notes.index', compact('notes', 'editingNoteId'));
    }

    public function update(Request $request, Note $note) {
        $note->text = $request->text;
        $note->updated_at = now(); 
        $note->save();
        return redirect()->route('notes.index');
    }

    public function destroy(Note $note) {
        $note->delete();
        return redirect()->route('notes.index');
    }
}
