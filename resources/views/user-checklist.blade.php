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
                      <div class="checklist-content">
                        <div class="checklist-info">
                          <p>Description: {{ $checklist -> description }} </p>
                          <p>Completed Tasks: <span class="checklist-field"> {{ $tasks->where('checklist_id', $checklist -> id)->where('status', 1)->count() }} </span></p>
                          <p>Overall Tasks: <span class="checklist-field"> {{ $tasks->where('checklist_id', $checklist -> id)->count() }} </span></p>
                        </div>
                        <div class="checklist-bar">
                          <vue-ellipse-progress 
                            :data="circles"                    
                            :progress="100 * {{ $tasks->where('checklist_id', $checklist -> id)->where('status', 1)->count() }} / {{ $tasks->where('checklist_id', $checklist -> id)->count() }}"
                            :angle="-90"
                            color="#38c172"
                            :colorFill="colorFillGradient"
                            emptyColor="#8ec5fc"
                            :emptyColorFill="emptyColorFillGradient"                      
                            :size="110"
                            :thickness="3"
                            emptyThickness="10%"
                            lineMode="in 10"
                            :legend="true"
                            :legendValue="180"
                            legendClass="legend-custom-style"
                            dash="60 0.9"
                            animation="reverse 700 400"
                            :noData="false"
                            :loading="false"                      
                            fontColor="white"
                            :half="false"
                            :gap="10"
                            dot="10 #38c172"
                            fontSize="5rem">
                            
                            <span slot="legend-value">%</span>
                            <p slot="legend-caption">COMPLETE</p> 
                          </vue-ellipse-progress>
                        </div>
                      </div>
                    </div>
                </div>
            @endif
          @endforeach
        </div>
    </div>
</div>

@endsection