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
        <li class="breadcrumb-item active" aria-current="page">Detail Menu</li>
    </ol>
</nav>
<div class="card card-default">
    <div class="card-body text-center">
        <h3 class="card-title">Detail of @yield('title')</h3>
        <p class="card-text pb-4 pt-1">
            @yield('description')
        </p>
        <a href="{{ route($routePrefix . '.create') }}" class="btn btn-primary btn-sm btn-pill">
            <i class="mdi mdi-plus"></i>
            &nbsp;Create New @yield('title')
        </a>
    </div>
</div>
<div class="card card-default ">
    <div class="card-footer card-profile-footer">
        <ul class="nav nav-border-top justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route($routePrefix . '.show', $model) }}">Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route($routePrefix . '.edit', $model) }}">Form</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route($routePrefix . '.historical-changes', $model) }}">Historical Changes</a>
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
            <label for="name">Parent Menu</label>
            <br>
            {{ $model->parent ? $model->parent->name : 'No Parent Menu' }}
        </div>
        <div class="form-group">
            <label for="description">Type</label>
            <br>
            {{ ucfirst($model->type) }}
        </div>
        <div class="form-group">
            <label for="sequence_number">Sequence Number</label>
            <br>
            {{ $model->sequence_number }}
        </div>
        <div class="form-group">
            <label for="sequence_number">URL</label>
            <br>
            @if ($model->url == "#" || $model->url == "javascript:void(0)")
                No URL Provided
            @elseif (filter_var($model->url, FILTER_VALIDATE_URL) === FALSE)
            <a target="_blank" href="{{ asset($model->url) }}">
                <i class="mdi mdi-link"></i>
                <span class="text">{{ asset($model->url) }}</span>
            </a>
            @else
                <a target="_blank" href="{{ ($model->url) }}">
                    <i class="mdi mdi-link"></i>
                    <span class="text">{{ ($model->url) }}</span>
                </a>
            @endif 
        </div>
        <div class="form-group">
            <label for="image">Open In New Tab</label>
            <br>
            @if ($model->isNewTab())
                <span class="badge badge-success">Yes</span>
            @else
                <span class="badge badge-secondary">No</span>
            @endif
        </div>
        <hr />
        @include('cms._include.buttons.back', ['backUrl' => route($routePrefix . '.index')])
        @include('cms._include.buttons.edit', ['editUrl' => route($routePrefix . '.edit', $model)])
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