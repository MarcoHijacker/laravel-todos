@extends('layouts.app')
@section('content')


  <div class="container">
    <div class="text-center">
      <h1>{{ $checklist -> name }} - ID: {{ $checklist -> id }}</h1>
      <div class="description">
        <em>Descrizione:</em> {{ $checklist -> description }}
      </div>
    </div>
  </div><br>

  <div id="app">
    <single-task :checklist="{{ $checklist }}" />
  </div>

@endsection