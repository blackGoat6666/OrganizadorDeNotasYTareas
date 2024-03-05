<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TaskList;
use App\Models\Task;

class TaskController extends Controller
{
    public function store(Request $request) {
        $task = Task::create([
            'description'=>$request->description,
            'deadline'=>$request->deadline, 
            'state'=>0,
            'task_list_id'=>$request->task_list_id,
        ]);
        $task->save();
        return redirect()->route('tasklist.index');
    }

    public function edit(Task $task) {
        $editingTaskId = $task->id;
        $user = Auth::user();
        $tasklists = $user->taskList()->with('tasks')->paginate(4);
        return view('tasklist.index', compact('tasklists', 'editingTaskId'));
    }

    public function update(Request $request, Task $task) {
        $task->description = $request->description;
        $task->deadline = $request->deadline;
        $task->updated_at = now(); 
        $task->save();
        return redirect()->route('tasklist.index');
    }

    public function destroy(Task $task) {
        $task->delete();
        return redirect()->route('tasklist.index');
    }
}
