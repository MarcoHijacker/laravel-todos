@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="text-center">
      <h1>My Checklists</h1>
      <a href="{{ route('create-checklist') }}"><i class="fa fa-plus-square" aria-hidden="true"></i> Create new List</a>
      <span>{{ Auth::user() -> id }}</span>
    </div>
  </div>

@endsection