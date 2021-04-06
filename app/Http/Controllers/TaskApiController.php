<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskApiController extends Controller
{
    public function index() {

        return Task::all();

    }

    public function related($chk_id) {

        return Task::orderBy('created_at','desc') -> where('checklist_id', $chk_id) -> get();

    }

    public function create() {

        request() -> validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
            'priority' => 'required',
            'checklist_id' => 'required',
        ]);

        return Task::create([

            'name' => request('name'),
            'description' => request('description'),
            'status' => request('status'),
            'priority' => request('priority'),
            'checklist_id' => request('checklist_id'),

        ]);

    }

    public function update($id) {

        request() -> validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
            'priority' => 'required',
            'checklist_id' => 'required',
        ]);

        $task = Task::findOrFail($id);

        $success = $task -> update([
            'name' => request('name'),
            'description' => request('description'),
            'status' => request('status'),
            'priority' => request('priority'),
            'checklist_id' => request('checklist_id'),
        ]);

        return [
            'success' => $success,
        ];

    }

    public function destroy($id) {
        
        $task = Task::findOrFail($id);

        $success = $task -> delete();

        return [
            'success' => $success,
        ];

    }
}
