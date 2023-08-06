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
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route($routePrefix . '.index') }}">List of Menus</a></li>
        <li class="breadcrumb-item active" aria-current="page">Update Menu</li>
    </ol>
</nav>
<div class="card card-default">
    <div class="card-body text-center">
        <h3 class="card-title">Update @yield('title')</h3>
        <p class="card-text pb-4 pt-1">
            @yield('description')
        </p>
        <a href="{{ route($routePrefix . '.create') }}" class="btn btn-primary btn-sm btn-pill">
            <i class="mdi mdi-plus"></i>
            &nbsp;Create New @yield('title')
        </a>
    </div>
</div>
<div class="card card-default">
    <div class="card-footer card-profile-footer">
        <ul class="nav nav-border-top justify-content-center">
            <li class="nav-item">
                <a class="nav-link" href="{{ route($routePrefix . '.show', $model) }}">Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route($routePrefix . '.edit', $model) }}">Form</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route($routePrefix . '.historical-changes', $model) }}">Historical Changes</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route($routePrefix . '.update', $model->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name @include('cms._include.required')</label>
                <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ old('name', $model->name) }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="type">Type @include('cms._include.required')</label>
                <select class="form-control @error('type') is-invalid @enderror" id="type" name="type">
                    <option value="header" {{ old('type') == 'header' || $model->type == 'header' ? 'selected' : '' }}>Header</option>
                    <option value="footer" {{ old('type') == 'footer' || $model->type == 'footer' ? 'selected' : '' }}>Footer</option>
                </select>
            </div>
            <div class="form-group">
                <label for="parent_id">Parent Menu</label>
                <select class="form-control @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id">
                    <option value="">-- Select Parent Menu --</option>
                    @foreach($parentMenus as $parentMenu)
                        <option value="{{ $parentMenu->id }}" {{ old('parent_id') == $parentMenu->id || $model->parent_id == $parentMenu->id ? 'selected' : '' }}>{{ $parentMenu->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="sequence_number">Sequence Number @include('cms._include.required')</label>
                <input class="form-control @error('sequence_number') is-invalid @enderror" id="sequence_number" type="number" name="sequence_number" placeholder="Sequence Number" value="{{ old('sequence_number', $model->sequence_number) }}">
                @error('sequence_number')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">URL @include('cms._include.required')</label>
                <input class="form-control @error('url') is-invalid @enderror" id="url" name="url" placeholder="URL" value="{{ old('url', $model->url) }}">
                @error('url')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="is_open_in_new_tab">Open In New Tab @include('cms._include.required')</label><br>
                <label class="switch switch-text switch-primary switch-pill form-control-label mr-2">
                    <input id="is_open_in_new_tab" name="is_open_in_new_tab" type="checkbox" class="switch-input form-check-input" value="on" {{ old('is_open_in_new_tab') == "on" || $model->isNewTab() == true ? 'checked' : ''}}>
                    <span class="switch-label" data-on="Yes" data-off="No"></span>
                    <span class="switch-handle"></span>
                </label>
            </div>
            <hr />
            @include('cms._include.buttons.back', ['backUrl' => route($routePrefix . '.index')])
            @include('cms._include.buttons.save')
        </form>
    </div>
</div>
@endsection

@section('js')
    @parent
    @include('cms._include.tinymce')
    <script>
        image.onchange = evt => {
            preview = document.getElementById('image-preview');
            preview.style.display = 'block';
            const [file] = image.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
