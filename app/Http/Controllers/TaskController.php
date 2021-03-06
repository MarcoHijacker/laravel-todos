<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
      // Checklists index
  public function index() {

    $checklists = Checklist::all();
    return view('index-checklist', compact('checklists'));
  }
  // Personal Iser checklists
    public function personal() {

    $checklists = Checklist::all() -> sortByDesc('created_at');
    return view('user-checklist', compact('checklists'));
  }
  // Create new checklist
  public function create() {

    $users = User::all();
    return view('create-checklist', compact('users'));

  }
  // Show a single checklist
  public function show($id) {

    $checklist = Checklist::findOrFail($id);
    return view('show-checklist', compact('checklist'));

  }
  // Store a new checklist
  public function store(Request $request) {

    $data = $request -> validate([

      'name' => 'required|min:3|max:35',
      'description' => 'required|min:10|max:250',
      'status' => 'required|max:1',
      'priority' => 'gte:0',
      'user_id' => 'required|gte:0'

    ]);

    $checklist = Checklist::create($data);

    return redirect() -> route('user-checklist');

  }
  // Edit existing checklist
  public function edit($id) {

    $checklist = Checklist::findOrFail($id);
    return view('edit-checklist', compact('checklist'));

  }
  // Update edited checklist
  public function update(Request $request, $id) {

    $data = $request -> validate([

      'name' => 'required|min:3|max:35',
      'description' => 'required|min:10|max:250',
      'status' => 'required|max:1',
      'priority' => 'gte:0',
      'user_id' => 'required|gte:0'

    ]);

    $checklist = Checklist::findOrFail($id);

    $checklist -> update($data);

    return redirect() -> route('show-checklist', $id);

  }
  // Delete an existing checlist
  public function destroy($id) {

    $checklist = Checklist::findOrFail($id);

    $checklist -> delete();

    return redirect() -> route('index-checklist');

  }

}
