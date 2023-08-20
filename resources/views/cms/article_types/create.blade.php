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
        <li class="breadcrumb-item active" aria-current="page">Add Article Type</li>
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
            <h2>New Article Type</h2>
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
                <label for="sequence_number">Sequence Number @include('cms._include.required')</label>
                <input class="form-control @error('sequence_number') is-invalid @enderror" id="sequence_number" type="number" name="sequence_number" placeholder="Sequence Number" value="{{ old('sequence_number') }}">
                @error('sequence_number')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <br>
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