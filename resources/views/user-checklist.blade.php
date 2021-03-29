@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="text-center">
      <h1>My Checklists</h1>
      <a href="{{ route('create-checklist') }}"><i class="fa fa-plus-square" aria-hidden="true"></i> Create new List</a>
    </div>
  </div>

  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @foreach ($checklists as $checklist)
            @if ($checklist -> user_id == Auth::user() -> id)
                <div style="margin-bottom: 20px" class="card">
                    <div class="card-header single-list">
                    <h3>
                        <a href="{{ route('show-checklist', $checklist -> id) }}"> {{ $checklist -> name }} </a>
                    </h3>
                    <div>
                        <a href="{{ route('show-checklist', $checklist -> id) }}" type="button" class="btn btn-primary"><i class="fa fa-eye"></i> View</a>
                        <a href="{{ route('edit-checklist', $checklist -> id) }}" type="button" class="btn btn-secondary"><i class="fa fa-pencil-square-o"></i> Edit</a>
                        <a href="{{ route('destroy-checklist', $checklist -> id) }}" type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</a>
                    </div>
                    </div>

                    <div class="card-body">
                    <p>{{ $checklist -> description }}</p>
                    </div>
                </div>
            @endif
          @endforeach
        </div>
    </div>
</div>

@endsection