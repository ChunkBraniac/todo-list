<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Todo;


class TodoController extends Controller
{
    //
    public static function task()
    {
        return view('task.home');
    }

    public static function newTask(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'task' => 'required',
        ]);

        $request['userId'] = $userId;
        $request['status'] = "In Progress";

        $tasks = new Todo([
            'userId' => $request['userId'],
            'task' => $request->task,
            'status' => $request['status']
        ]);

        $tasks->save();

        return redirect('task')->with('status', 'Successful');
    }

    public static function show()
    {
        $user = Auth::id();

        // get the tasks according to logged in user
        $showTasks = Todo::where('userId', $user)->orderBy('created_at', 'Asc')->get();

        // get the tasks id
        $taskIds = Todo::all()->pluck('id');

        return view('task.home', compact('showTasks', 'taskIds'));

    }

    public static function destroy($id)
    {
        $tasks = Todo::findOrFail($id);

        $tasks->delete();

        return redirect('task')->with('status', 'Task deleted');
    }

    public static function finishedTask($id)
    {
        $task = Todo::findOrFail($id);

        $task->status = "Done";

        $task->save();

        return redirect('task')->with('status', 'Task completed');
    }
}
