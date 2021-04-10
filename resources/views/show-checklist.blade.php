@extends('layouts.app')
@section('content')

  <div class="container">
    <div class="text-center">
      <h2>{{ $checklist -> name }}</h2>
      <div class="description">
        {{ $checklist -> description }}
      </div>
    </div>
  </div><br>

  <div id="app">
    <task-list 
      :checklist="{{ $checklist -> id }}"
      :loggeduser="'{{ Auth::user() -> firstname }}'"
    />
  </div>

@endsection