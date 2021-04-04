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
        <div class="col-md-8 checklist-user">
          @foreach ($checklists as $checklist)
            @if ($checklist -> user_id == Auth::user() -> id)
                <div style="margin-bottom: 20px;" class="card">
                    <div class="card-header single-list checklist-item">
                    <span class="checklist-title">
                        <a href="{{ route('show-checklist', $checklist -> id) }}"> {{ $checklist -> name }} </a>
                    </span>
                    <div>
                        <a href="{{ route('show-checklist', $checklist -> id) }}" type="button" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> Open</a>
                        <a href="{{ route('edit-checklist', $checklist -> id) }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"></i> Edit</a>
                        <a href="{{ route('destroy-checklist', $checklist -> id) }}" onclick="return confirm('This will perform permanent deletion. Are you sure?')" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Delete</a>
                    </div>
                    </div>

                    <div class="card-body">
                    <p><u>Description:</u> {{ $checklist -> description }}</p>
                    <p><u>Related Tasks:</u> {{ $tasks->where('checklist_id', $checklist -> id)->count() }}</p>
                    <p><u>Completed Tasks:</u> {{ $tasks->where('checklist_id', $checklist -> id)->where('status', 1)->count() }} </p>
                    </div>
                </div>
            @endif
          @endforeach
        </div>
    </div>
</div>

@endsection