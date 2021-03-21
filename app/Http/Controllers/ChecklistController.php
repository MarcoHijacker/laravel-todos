<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Checklist;

class ChecklistController extends Controller
{
    public function create() {

      $users = User::all();
      return view('create-checklist', compact('users'));

    }

    public function store(Request $request) {

      $data = $request -> validate([

        'name' => 'required|min:3|max:35',
        'description' => 'required|min:10|max:250',
        'status' => 'required|max:1',
        'priority' => 'gte:0',
        'user_id' => 'required|gte:0'

      ]);

      $checklist = Checklist::create($data);

      return redirect() -> route('home');

    }


}
