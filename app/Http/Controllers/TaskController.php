<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function index()
    {
        $tasks = Task::all();
        $users = User::all();
        return view('tasks.index', compact('tasks', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'location' => 'required|string',
            'priority' => 'required|in:' . implode(',', Task::PRIORITIES),
            'user_id' => 'required|exists:users,id',
        ]);
        $task = Task::create($request->all());
        response()->json(['task' => $task], 200);
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'location' => 'required|string',
            'priority' => 'required|in:' . implode(',', Task::PRIORITIES),
            'user_id' => 'required|exists:users,id',
        ]);
        $task->update($request->all());
        return response()->json(['task' => $task], 200);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}
