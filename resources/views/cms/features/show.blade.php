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
        <li class="breadcrumb-item active" aria-current="page">Detail Feature</li>
    </ol>
</nav>
<div class="card card-default">
    <div class="card-body text-center">
        <h3 class="card-title">Detail of @yield('title')</h3>
        <p class="card-text pb-4 pt-1">
            @yield('description')
        </p>
        <a href="{{ route('features.create') }}" class="btn btn-primary btn-sm btn-pill">
            <i class="mdi mdi-plus"></i>
            &nbsp;Create New @yield('title')
        </a>
    </div>
</div>
<div class="card card-default ">
    <div class="card-footer card-profile-footer">
        <ul class="nav nav-border-top justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('features.show', $model) }}">Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('features.edit', $model) }}">Form</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('features.historical-changes', $model) }}">Historical Changes</a>
            </li>
        </ul>
    </div>
    <div class="card-body card-profile-body">
        <div class="form-group">
            <label for="name">Name</label>
            <br>
            {{ $model->name }}
        </div>
        <div class="form-group">
            <label for="name">Slug</label>
            <br>
            {{ $model->slug }}
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <br>
            {!! $model->description !!}
        </div>
        <div class="form-group">
            <label for="sequence_number">Sequence Number</label>
            <br>
            {{ $model->sequence_number }}
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <br>
            @if ($image = $model->getFirstMedia("images"))
            <img id="image-preview" height="150px" src="{{ $image->getUrl() }}" alt="Uploaded image" class="mt-3"/>
            @endif
        </div>
        <div class="form-group">
            <label for="image">Published</label>
            <br>
            @if ($model->isPublished())
                <span class="badge badge-success">Published at {{ $model->published_at }}</span>
            @else
                <span class="badge badge-secondary">Unpublished</span>
            @endif
        </div>
        <hr />
        @include('cms._include.buttons.back', ['backUrl' => route('features.index')])
        @include('cms._include.buttons.edit', ['editUrl' => route('features.edit', $model)])
    </div>
</div>
@endsection

@section('js')
    @parent
    @if (session()->has('message'))    
    <script type="text/javascript">
        $(function () {
        toastr.info("{{ session()->get('message') }}");
    });
    </script>
    @endif
@endsection