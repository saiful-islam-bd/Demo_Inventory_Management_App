<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tasks = Task::select(['id', 'task_title', 'asign_to', 'deadline', 'created_at', 'updated_at']);
            return DataTables::of($tasks)
                ->addColumn('action', function ($row) {
                    return '
                        <button type="button" class="btn btn-success btn-sm edit" data-id="' . $row->id . '">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm delete" data-id="' . $row->id . '">Delete</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('tasks.index');
    }


    public function store(Request $request)
    {
        $request->validate([
            'task_title' => 'required',
            'asign_to' => 'required',
            'deadline' => 'required' . $request->id,
        ]);
        

        Task::updateOrCreate(
            ['id' => $request->id],
            ['task_title' => $request->task_title, 'asign_to' => $request->asign_to, 'deadline' => $request->deadline]
        );


        return response()->json(['success' => 'Task saved successfully!']);
    }


    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return response()->json($task);
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'task_title' => 'required|string|max:255',
            'asign_to' => 'required',
            'deadline' => 'required|date',
        ]);

        $task = Task::findOrFail($id); // Find the task
        $task->update($request->all()); // Update with request data

        return response()->json(['message' => 'Task updated successfully!']);
    }


    
    public function destroy($id)
    {
        Task::find($id)->delete();
        return response()->json(['success' => 'Task deleted successfully!']);
    }
}
