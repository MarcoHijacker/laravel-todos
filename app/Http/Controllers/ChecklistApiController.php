<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Checklist;

class ChecklistApiController extends Controller
{
    public function index() {

        return Checklist::all();

    }

    public function related() {

        $user_id = request('user_id');
        if($user_id) {
            return Checklist::orderBy('created_at','desc') -> where('user_id', $user_id) -> get();
        } else {
            return 'Error. Invalid User Id!';
        }

    }

    public function create() {

        request() -> validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
            'priority' => 'required',
            'user_id' => 'required',
        ]);

        return Checklist::create([

            'name' => request('name'),
            'description' => request('description'),
            'status' => request('status'),
            'priority' => request('priority'),
            'user_id' => request('user_id'),

        ]);

    }

    public function update($id) {

        request() -> validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
            'priority' => 'required',
            'user_id' => 'required',
        ]);

        $checklist = Checklist::findOrFail($id);

        $success = $checklist -> update([
            'name' => request('name'),
            'description' => request('description'),
            'status' => request('status'),
            'priority' => request('priority'),
            'user_id' => request('user_id'),
        ]);

        return [
            'success' => $success,
        ];

    }

    public function destroy($id) {
        
        $checklist = Checklist::findOrFail($id);

        $success = $checklist -> delete();

        return [
            'success' => $success,
        ];

    }
}
