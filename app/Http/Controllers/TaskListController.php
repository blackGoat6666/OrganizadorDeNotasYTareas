<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TaskList;

class TaskListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $user = Auth::user();
        $tasklists = $user->taskList()->with('tasks')->paginate(4);
        $editingTaskListId = null;
        return view('tasklist.index', compact('tasklists', 'editingTaskListId'));
    }

    public function destroy(TaskList $tasklist) {
        $tasklist->delete();
        return redirect()->route('tasklist.index');
    }
}
