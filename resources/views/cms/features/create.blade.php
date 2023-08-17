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
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route($routePrefix . '.index') }}">List of Features</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Feature</li>
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
    <form method="POST" action="{{ route($routePrefix . '.store') }}" enctype="multipart/form-data">
    @csrf
        <div class="card-header">
            <h2>Feature</h2>
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
                <label for="description">Description @include('cms._include.required')</label>
                <textarea id="description" class="wysiwyg form-control @error('description') is-invalid @enderror" name="description">
                    {{ old('description') }}
                </textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="sequence_number">Sequence Number @include('cms._include.required')</label>
                <input class="form-control @error('sequence_number') is-invalid @enderror" id="sequence_number" type="number" name="sequence_number" placeholder="Sequence Number" value="{{ old('sequence_number') }}">
                @error('sequence_number')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
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
        <div class="card-header">
            <h2>SEO</h2>
            <a class="btn mdi mdi-spin mdi-file-replace-outline" role="button">&nbsp;&nbsp;Auto Fill&nbsp;</a>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="seo_title">SEO Title @include('cms._include.required')</label>
                <input class="form-control @error('seo_title') is-invalid @enderror" id="seo_title" name="seo_title" placeholder="SEO Title" value="{{ old('seo_title') }}">
                @error('seo_title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="seo_description">SEO Description @include('cms._include.required')</label>
                <textarea id="seo_description" class="form-control @error('seo_description') is-invalid @enderror" name="seo_description">{!! old('seo_description') !!}</textarea>
                @error('seo_description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="seo_robots">
                    SEO Robots Meta Tag
                    <i class="mdi mdi-tooltip-edit"  data-toggle="tooltip" data-placement="right" data-original-title="Comma separated HTML tag that goes the head tag of a page and provides instructions to Google bots"></i>
                </label>
                <input class="form-control @error('seo_robots') is-invalid @enderror" id="seo_robots" name="seo_robots" placeholder="SEO Robots Tag" value="{{ old('seo_robots') }}">
                @error('seo_robots')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="seo_canonical_url">
                    SEO Canonical URL
                    <i class="mdi mdi-tooltip-edit"  data-toggle="tooltip" data-placement="right" data-original-title="Canonical URL is the URL of a page that Google chose as the most representative from a set of duplicate pages"></i>
                </label>
                <input class="form-control @error('seo_canonical_url') is-invalid @enderror" id="seo_canonical_url" name="seo_canonical_url" placeholder="SEO Canonical URL" value="{{ old('seo_canonical_url') }}">
                @error('seo_canonical_url')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="seo_image">SEO Image</label>
                <br>
                It will be taken automatically from this data's image
            </div>
            <div class="form-group">
                <label for="seo_author">SEO Author</label>
                <br>
                It will be filled automatically from authenticated user's name
            </div>
               
            @include('cms._include.buttons.back', ['backUrl' => route($routePrefix . '.index')])
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
            const [file] = image.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection