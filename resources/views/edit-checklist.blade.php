@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Editing Checklist ID: {{ $checklist -> id }}</div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('update-checklist', $checklist -> id) }}">
                        @csrf
                        @method('POST')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $checklist -> name }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $checklist -> description }}" required autocomplete="description" autofocus>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row" style="display: none;">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
                            <div class="col-md-6">
                                <input id="status" type="number" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ $checklist -> status }}" required autocomplete="status" autofocus>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="priority" class="col-md-4 col-form-label text-md-right">{{ __('Priority') }}</label>
                            <div class="col-md-6">
                                    <select id="priority" type="number" class="form-control @error('priority') is-invalid @enderror" name="priority" value="{{ $checklist -> priority }}" required autocomplete="priority">
                                        <option value="2" @if($checklist -> priority == 2) selected @endif>High</option>
                                        <option value="1" @if($checklist -> priority == 1) selected @endif>Middle</option>
                                        <option value="0" @if($checklist -> priority == 0) selected @endif>Low</option>
                                    </select>
                                @error('priority')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                            <div class="col-md-6" style="display: none">
                            <label for="user_id" class="col-md-4 col-form-label text-md-right">{{ __('Used ID') }}</label>
                                <input id="user_id" type="text" class="form-control @error('user_id') is-invalid @enderror" name="user_id" value="@auth {{ Auth::user() -> id }} @else 0 @endauth" required autocomplete="user_id">
                                @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" id="createBtn" class="btn btn-primary">
                                    {{ __('Update Checklist') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection