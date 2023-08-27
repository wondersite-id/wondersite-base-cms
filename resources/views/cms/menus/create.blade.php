@extends('layouts.cms')
 
@section('title', $title)

@section('description', $description)

@section('css')
    @parent
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light">
        <li class="breadcrumb-item"><a href="{{ route('cms.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('cms.'.$routePrefix . '.index') }}">List of {{ $title }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Menu</li>
    </ol>
</nav>
<div class="card card-default">
    <div class="card-body text-center">
        <h3 class="card-title">Create New @yield('title')</h3>
        <p class="card-text pb-4 pt-1">
            @yield('description')
        </p>
    </div>
</div>
<div class="card card-default">
    <div class="card-header">
        <h2>New Menu</h2>
    </div>
    
    <div class="card-body">
        <form method="POST" action="{{ route('cms.'.$routePrefix . '.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name @include('cms._include.required')</label>
                <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="type">Type @include('cms._include.required')</label>
                <select class="form-control @error('type') is-invalid @enderror" id="type" name="type">
                    <option value="header" {{ old('type') == 'header' ? 'selected' : '' }}>Header</option>
                    <option value="footer" {{ old('type') == 'footer' ? 'selected' : '' }}>Footer</option>
                </select>
            </div>
            <div class="form-group">
                <label for="parent_id">Parent Menu</label>
                <select class="form-control @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id">
                    <option value="">-- Select Parent Menu --</option>
                    @foreach($parentMenus as $parentMenu)
                        <option value="{{ $parentMenu->id }}" {{ old('parent_id') == $parentMenu->id ? 'selected' : '' }}>{{ $parentMenu->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="sequence_number">Sequence Number @include('cms._include.required')</label>
                <input class="form-control @error('sequence_number') is-invalid @enderror" id="sequence_number" type="number" name="sequence_number" placeholder="Sequence Number" value="{{ old('sequence_number') }}">
                @error('sequence_number')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">
                    URL
                    <i class="mdi mdi-tooltip-edit"  data-toggle="tooltip" data-placement="right" data-original-title="For empty URL in parent menu please fill the URL with `javascript:void(0)`"></i>
                    @include('cms._include.required')
                </label>
                <input class="form-control @error('url') is-invalid @enderror" id="url" name="url" placeholder="URL" value="{{ old('url') }}">
                @error('url')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="is_open_in_new_tab">Open In New Tab @include('cms._include.required')</label><br>
                <label class="switch switch-text switch-primary switch-pill form-control-label mr-2">
                    <input id="is_open_in_new_tab" name="is_open_in_new_tab" type="checkbox" class="switch-input form-check-input" value="on" {{ old('is_open_in_new_tab') == "on" ? 'checked' : ''}}>
                    <span class="switch-label" data-on="Yes" data-off="No"></span>
                    <span class="switch-handle"></span>
                </label>
            </div>
            <br />
            @include('cms._include.buttons.back', ['backUrl' => route('cms.'.$routePrefix . '.index')])
            @include('cms._include.buttons.save')
        </form>
    </div>
</div>
@endsection

@section('js')
    @parent
    
@endsection