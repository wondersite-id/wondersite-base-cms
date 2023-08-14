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
        <li class="breadcrumb-item"><a href="{{ route($routePrefix . '.index') }}">List of SEO</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail SEO</li>
    </ol>
</nav>
<div class="card card-default">
    <div class="card-body text-center">
        <h3 class="card-title">Detail of @yield('title')</h3>
        <p class="card-text pb-4 pt-1">
            @yield('description')
        </p>
    </div>
</div>
<div class="card card-default ">
    <div class="card-footer card-profile-footer">
        <ul class="nav nav-border-top justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route($routePrefix . '.show', $model) }}">Data</a>
            </li>
        </ul>
    </div>
    <div class="card-body card-profile-body">
        <div class="form-group">
            <label for="model_type">Related Model</label>
            @php
            $modelType = Str::replace('App\Models\\', '', $model->model_type);
            $routeName = Str::lower(Str::plural($modelType));
            $showUrl = route($routeName . '.show', $model->model_id);
            @endphp
            <br>
            <a href="{{ $showUrl }}">{{ $modelType }} - {{ $model->model->name }}</a>
        </div>
        <div class="form-group">
            <label for="title">SEO Title</label>
            <br>
            {{ $model->title }}
        </div>
        <div class="form-group">
            <label for="description">SEO Description</label>
            <br>
            {!! $model->description !!}
        </div>
        <div class="form-group">
            <label for="image">SEO Image</label>
            <br>
            <img id="image-preview" height="150px" src="{{ $model->image }}" alt="Uploaded image" class="mt-3"/>
        </div>
        <div class="form-group">
            <label for="author">SEO Author</label>
            <br>
            {{ $model->author ?: '-' }}
        </div>
        <div class="form-group">
            <label for="robots">SEO Robots Tag</label>
            <br>
            {{ $model->robots ?: '-' }}
        </div>
        <div class="form-group">
            <label for="canonical_url">SEO Canonical URL</label>
            <br>
            {{ $model->canonical_url ?: '-' }}
        </div>
        <hr />
        @include('cms._include.buttons.back', ['backUrl' => route($routePrefix . '.index')])
        @include('cms._include.buttons.edit', ['editUrl' => route($routeName . '.edit', $model->model->id)])
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