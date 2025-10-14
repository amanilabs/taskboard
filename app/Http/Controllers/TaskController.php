<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Lane;

use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{

public function form(Request $r, Task $task = null) {
    $users = User::orderBy('name')->get(['id','name','email']);
    return view('tasks._form', [
        'task'     => $task,
        'users'    => $users,
        'lane_id'  => $r->integer('lane_id'),   // or lane_id
    ])->render();
}


    public function store(Request $r)
    {


        $data = $r->validate([
        'lane_id'     => ['required','exists:lanes,id'],
        'title'       => ['required','string','max:255'],
        'description' => ['required','string'],
        'priority'    => ['required'], 
        'user_ids'    => ['nullable','array'],
        'user_ids.*'  => ['exists:users,id'],
        'start_date' => ['date'],
        'end_date'   => ['date'],
    ]);

    $data['assignee_ids'] = collect($r->input('user_ids', [])) ;

     $data['position'] = (Task::where('lane_id', $data['lane_id'])->max('position') ?? 0) + 1;
    
     $path = null;
    if ($r->hasFile('attachment_path')) {
        $file = $r->file('attachment_path');
        $path = $file->store('attachments', 'public');               // e.g. attachments/abc123.pdf
        $name = $file->getClientOriginalName();      
        $data['attachment_path'] = $path;
        $data['attachment_name'] = $name; 
    }


    try {
        $task = $r->id ? Task::findOrFail($r->id) : new Task();
        $task->fill($data)->save();
       

        if (! $task ) {
            return back()->withInput()->withErrors(['/' => 'Could not create the task.']);
        }

        // success → no message
        return redirect('/');

    } catch (\Throwable $e) {
        Log::error('task create failed', ['error' => $e->getMessage()]);
        return back()->withInput()->withErrors([
             'task' => 'Something went wrong while creating the task.',
        ]);
    }
    }

    public function addtask(Lane $lane) {
        $users = User::orderBy('name')->get(['id','name','email']);
        return view('tasks._form', compact('users','lane'));
    
    }

    public function move(Request $r, Task $task) {
        $payload = $r->validate(['lane_id'=>'required|exists:lanes,id','position'=>'nullable|integer']);
        $task->lane_id = $payload['lane_id'];
        if (isset($payload['position'])) $task->position = $payload['position'];
        $task->save();
        return response()->json(['ok'=>true]);
    }

    public function reorder(Request $r, Lane $lane) {
    $data = $r->validate(['order'=>'required|array']); 
    foreach ($data['order'] as $i => $taskId) {
        Task::where('id', $taskId)->where('lane_id', $lane->id)
            ->update(['position' => $i + 1]);
    }
    return response()->json(['ok'=>true]);
}
public function destroy($id = null)
{
    $record = Task::find($id);
    $record->delete();
    return back()->with('ok', 'Task deleted');
}
public function download(Task $task)
{
    if (!$task->attachment_path || !Storage::disk('public')->exists($task->attachment_path)) {
        abort(404);
    }

    $filename = $task->attachment_name ?: basename($task->attachment_path);
    $mime     = $task->attachment_mime
                ?? Storage::disk('public')->mimeType($task->attachment_path)
                ?? 'application/octet-stream';

    return Storage::disk('public')->download($task->attachment_path, $filename);

}

}
