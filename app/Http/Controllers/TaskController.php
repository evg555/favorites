<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'asc')->get();
        return view('tasks',compact('tasks'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:tasks|max:255',
            'description' => 'required'
        ]);

        $task = new Task();
        $task->fill($data);
        $task->save();

        return redirect()->route('tasks.index');
    }

    public function delete($id)
    {
        $task = Task::find($id);

        if ($task) {
            $task->delete();
        }

        return redirect()->route('tasks.index');
    }
}
