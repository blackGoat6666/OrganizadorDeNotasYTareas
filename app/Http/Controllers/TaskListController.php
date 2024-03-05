<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TaskList;
use App\Models\Task;

class TaskListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $user = Auth::user();
        $tasklists = $user->taskList()->with('tasks')->paginate(4);
        $editingTaskId = null;
        return view('tasklist.index', compact('tasklists', 'editingTaskId'));
    }

    public function store() {
        $user = Auth::user();
        $tasklist = TaskList::create([
            'user_id' => $user->id, 
        ]);
        $tasklist->save();
        return redirect()->route('tasklist.index');
    }

    public function destroy(TaskList $tasklist) {
        $tasklist->delete();
        return redirect()->route('tasklist.index');
    }
}
