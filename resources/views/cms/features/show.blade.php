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
        <li class="breadcrumb-item active" aria-current="page">Detail Feature</li>
    </ol>
</nav>
<div class="card card-default">
    <div class="card-body text-center">
        <h3 class="card-title">Detail of @yield('title')</h3>
        <p class="card-text pb-4 pt-1">
            @yield('description')
        </p>
        @can('create', App\Models\Feature::class)
        <a href="{{ route('cms.'.$routePrefix . '.create') }}" class="btn btn-primary btn-sm btn-pill">
            <i class="mdi mdi-spin mdi-shape-polygon-plus"></i>
            &nbsp;Create New @yield('title')
        </a>
        @endcan
    </div>
</div>
<div class="card card-default ">
    <div class="card-footer card-profile-footer">
        <ul class="nav nav-border-top justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('cms.'.$routePrefix . '.show', $model) }}">Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cms.'.$routePrefix . '.edit', $model) }}">Form</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cms.'.$routePrefix . '.historical-changes', $model) }}">Historical Changes</a>
            </li>
        </ul>
    </div>
    <div class="card-header">
        <h2>Feature</h2>
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
                <span class="badge badge-secondary">Draft</span>
            @endif
        </div>
    </div>
    <hr />
    <div class="card-header">
        <h2>SEO</h2>
    </div>
    <div class="card-body card-profile-body">
        <div class="form-group">
            <label for="title">SEO Title</label>
            <br>
            {{ $model->seo->title }}
        </div>
        <div class="form-group">
            <label for="description">SEO Description</label>
            <br>
            {!! $model->seo->description !!}
        </div>
        <div class="form-group">
            <label for="image">SEO Image</label>
            <br>
            <img id="image-preview" height="150px" src="{{ $model->seo->image }}" alt="Uploaded image" class="mt-3"/>
        </div>
        <div class="form-group">
            <label for="author">SEO Author</label>
            <br>
            {{ $model->seo->author ?: '-' }}
        </div>
        <div class="form-group">
            <label for="robots">SEO Robots Tag</label>
            <br>
            {{ $model->seo->robots ?: '-' }}
        </div>
        <div class="form-group">
            <label for="canonical_url">SEO Canonical URL</label>
            <br>
            {{ $model->seo->canonical_url ?: '-' }}
        </div>
        <br />
        @include('cms._include.buttons.back', ['backUrl' => route('cms.'.$routePrefix . '.index')])        
        @can('update', $model)
            @include('cms._include.buttons.edit', ['editUrl' => route('cms.'.$routePrefix . '.edit', $model)])
        @endcan
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