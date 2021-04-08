@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="text-center">
      <h1>My Checklists</h1>
    </div>
  </div>

  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 checklist-user">
          <checklist-list :loggeduser="{{ Auth::user() -> id }}" />
        </div>
    </div>
</div>

@endsection