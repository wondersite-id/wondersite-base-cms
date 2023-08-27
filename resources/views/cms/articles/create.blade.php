@extends('layouts.cms')
 
@section('title', $title)

@section('badge')
    <span class="badge badge-dark badge-pill">
        <i class="mdi mdi-search-web"></i>
        SEO
    </span>
@endsection

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
        <li class="breadcrumb-item active" aria-current="page">Add Article</li>
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
    <form method="POST" action="{{ route('cms.'.$routePrefix . '.store') }}" enctype="multipart/form-data">
    @csrf
        <div class="card-header">
            <h2>Article</h2>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name @include('cms._include.required')</label>
                <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="short_description">Short Description @include('cms._include.required')</label>
                <textarea id="short_description" class="form-control @error('short_description') is-invalid @enderror" name="short_description">{{ old('short_description') }}</textarea>
                @error('short_description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="content">Content @include('cms._include.required')</label>
                <textarea id="content" class="wysiwyg form-control @error('content') is-invalid @enderror" name="content">{{ old('content') }}</textarea>
                @error('content')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="article_type_id">Article Type</label>
                <select class="form-control @error('article_type_id') is-invalid @enderror" id="article_type_id" name="article_type_id">
                    <option value="">-- Select Article Type --</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" {{ old('article_type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="image">
                    Image 
                    <i class="mdi mdi-tooltip-image-outline"  data-toggle="tooltip" data-placement="right" data-original-title="Best image size with landscape image with size 1394x974 pixels. Accept all image file types with max size 2MB."></i>
                    @include('cms._include.required')
                </label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" placeholder="image" value="{{ old('image') }}" accept="image/*">
                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                    <br>
                @enderror
                <img id="image-preview" height="150px" src="#" alt="Uploaded image" class="mt-3" style="display:none;"/>
            </div>
            <div class="form-group">
                <label for="published_at">Published @include('cms._include.required')</label><br>
                <label class="switch switch-text switch-primary switch-pill form-control-label mr-2">
                    <input id="published_at" name="published_at" type="checkbox" class="switch-input form-check-input" value="on" {{ old('published_at') == "on" ? 'checked' : ''}}>
                    <span class="switch-label" data-on="Yes" data-off="No"></span>
                    <span class="switch-handle"></span>
                </label>
            </div>
        </div>
        <hr />
        @include('cms._seoform.create')
        <div class="card-body pt-0">
            @include('cms._include.buttons.back', ['backUrl' => route('cms.'.$routePrefix . '.index')])
            @include('cms._include.buttons.save') 
        </div>
    </form>
</div>
@endsection

@section('js')
    @parent
    @include('cms._include.tinymce')
    <script>
        image.onchange = evt => {
            preview = document.getElementById('image-preview');
            preview.style.display = 'block';
            seoPreview = document.getElementById('seo-image-preview');
            seoPreview.style.display = 'block';
            const [file] = image.files
            if (file) {
                preview.src = URL.createObjectURL(file)
                seoPreview.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection