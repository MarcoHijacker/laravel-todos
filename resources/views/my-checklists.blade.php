@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="text-center">
      <h1>My Lists</h1>
      <a href="{{ route('create-checklist') }}"><i class="fa fa-plus-square" aria-hidden="true"></i> Create new List</a>
    </div>
  </div>

  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @foreach ($checklists as $checklist)
            <div style="margin-bottom: 20px" class="card">
                <div class="card-header">
                  <h2>
                      {{ $checklist -> name }}
                  </h2>
                  <p>{{ $checklist -> description }}</p>
                </div>

                <div class="card-body">
                </div>
            </div>
          @endforeach
        </div>
    </div>
</div>

@endsection