<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TaskController extends Controller
{
    //
    public function index()
    {
        $tasks = Task::all();
        $users = User::all();
        return view('tasks.index', compact('tasks', 'users'));
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function getUserTasks()
    {
        $tasks = auth()->user()->tasks;
        $data = [];
        foreach ($tasks as $item) {
            $updateButton = '<button class="btn btn-info btn-sm update-btn" id="updateBtn" data-toggle="modal" data-target="#updateTaskModal"
            data-task-id="' . $item->id . '" data-task-title="' . $item->title . '" data-task-description="' . $item->description . '" data-task-due_date="' . $item->due_date . '" data-task-location="' . $item->location . '" data-task-priority="' . $item->priority . '" data-task-user_id="' . $item->user_id . '"
            >Edit</button>';
            $viewButton = '<a class="btn btn-primary btn-sm view-btn" id="viewBtn" href="' . route('tasks.show', $item->id) . '"
            >View</a>';

            $data[] = [
                'id' => $item->id,
                'title' => $item->title,
                'due_date' => $item->due_date,
                'location' => $item->location,
                'priority' => $item->priority,
                'user' => $item->user->name,
                'action' => $viewButton.$updateButton,
            ];
        }
        $data = [
            "draw" => 1,
            "recordsTotal" => $tasks->count(),
            "recordsFiltered" => $tasks->count(),
            'data' => $data,
        ];
        return response()->json($data, 200);
    }

    public function getTaskData()
    {
        $tasks = Task::all();
        $data = [];
        foreach ($tasks as $item) {
            $deleteButton = '<button class="btn btn-danger btn-sm delete-btn" id="deleteBtn" data-toggle="modal" data-target="#deleteTaskModal"
            data-task-id="' . $item->id . '"
            >Delete</button>';
            $viewButton = '<a class="btn btn-primary btn-sm view-btn" id="viewBtn" href="' . route('tasks.show', $item->id) . '"
            >View</a>';
            $data[] = [
                'id' => $item->id,
                'title' => $item->title,
                'due_date' => $item->due_date,
                'location' => $item->location,
                'priority' => $item->priority,
                'user' => $item->user->name,
                'action' => $viewButton.$deleteButton,
            ];
        }
        $data = [
            "draw" => 2,
            "recordsTotal" => $tasks->count(),
            "recordsFiltered" => $tasks->count(),
            'data' => $data,
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'location' => 'required|string',
            'priority' => 'required|in:' . implode(',', Task::PRIORITIES),
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            $task = Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'due_date' => $request->due_date,
                'location' => $request->location,
                'priority' => $request->priority,
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['success' => true, 'data' => $task], 200);
        } catch (\Exception $e) {
            return response()->json(['errors' => [$e->getMessage()]], 500);
        }
    }

    public function update(Request $request, Task $task)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'location' => 'required|string',
            'priority' => 'required|in:' . implode(',', Task::PRIORITIES),
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            $task->title = $request->title;
            $task->description = $request->description;
            $task->due_date = $request->due_date;
            $task->location = $request->location;
            $task->priority = $request->priority;
            $task->user_id = auth()->user()->id;
            $task->update();
            return response()->json(['success' => true, 'data' => $task], 200);
        } catch (\Exception $e) {
            return response()->json(['errors' => [$e->getMessage()]], 500);
        }
    }

    public function destroy(Task $task)
    {
        try {
            $task->delete();
            return response()->json(['success' => true], 200);
        }catch (\Exception $e) {
            return response()->json(['errors' => [$e->getMessage()]], 500);
        }
    }
}
