@extends('layouts.cms')
 
@section('title', 'Features')

@section('description', 'Features will be shown on homepage and feature page. It contains name, description, sequence number and image.')

@section('css')
    @parent
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('features.index') }}">List of Features</a></li>
        <li class="breadcrumb-item active" aria-current="page">Update Feature</li>
    </ol>
</nav>
<div class="card card-default">
    <div class="card-body text-center">
        <h3 class="card-title">Update @yield('title')</h3>
        <p class="card-text pb-4 pt-1">
            @yield('description')
        </p>
        <a href="{{ route('features.create') }}" class="btn btn-primary btn-sm btn-pill">
            <i class="mdi mdi-plus"></i>
            &nbsp;Create New @yield('title')
        </a>
    </div>
</div>
<div class="card card-default">
    <div class="card-footer card-profile-footer">
        <ul class="nav nav-border-top justify-content-center">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('features.show', $model) }}">Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('features.edit', $model) }}">Form</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('features.historical-changes', $model) }}">Historical Changes</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('features.update', $model->id) }}" enctype="multipart/form-data">
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
                <label for="description">Description @include('cms._include.required')</label>
                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description">
                    {{ old('description', $model->description) }}
                </textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="sequence_number">Sequence Number @include('cms._include.required')</label>
                <input class="form-control @error('sequence_number') is-invalid @enderror" id="sequence_number" name="sequence_number" placeholder="Sequence Number" value="{{ old('sequence_number', $model->sequence_number) }}">
                @error('sequence_number')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">
                    Image
                    <i class="mdi mdi-tooltip-image-outline"  data-toggle="tooltip" data-placement="right" data-original-title="Best image size with landscape image with size 1394x974. Accept all image file types with max size 2MB."></i>
                </label>
                <div class="accordion" id="accordionOne">
                    <div class="card border-0">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <i class="mdi mdi-cursor-default-click"></i>
                                    Click Here to Change The Image
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse {{ old('image') === null ? '' : 'show' }}" aria-labelledby="headingThree" data-parent="#accordionOne">
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" placeholder="Image" value="{{ old('image') }}" accept="image/*">
                        </div>
                    </div>
                </div>

                @error('image')
                    <small class="mb-0 text-danger">{{ $message }}</small>
                    <br>
                @enderror
                
                @if ($image = $model->getFirstMedia("images"))
                    <img id="image-preview" height="150px" src="{{ $image->getUrl() }}" alt="Uploaded image" class="mt-3"/>
                @else
                    <img id="image-preview" height="150px" src="#" alt="Uploaded image" class="mt-3" style="display:none;"/>
                @endif
            </div>
            <div class="form-group">
                <label for="published_at">Published</label><br>
                <label class="switch switch-text switch-primary switch-pill form-control-label mr-2">
                    <input id="published_at" name="published_at" type="checkbox" class="switch-input form-check-input" value="on" {{ $model->isPublished() ? 'checked' : ''}}>
                    <span class="switch-label" data-on="Yes" data-off="No"></span>
                    <span class="switch-handle"></span>
                </label>
            </div>
            <hr />
            @include('cms._include.buttons.back', ['backUrl' => route('features.index')])
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
