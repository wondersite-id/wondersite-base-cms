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
        <li class="breadcrumb-item active" aria-current="page">Historical Changes</li>
    </ol>
</nav>
<div class="card card-default">
    <div class="card-body text-center">
        <h3 class="card-title">Historical Changes of @yield('title')</h3>
        <p class="card-text pb-4 pt-1">
            @yield('description')
        </p>
        <a href="{{ route('cms.'.$routePrefix . '.create') }}" class="btn btn-primary btn-sm btn-pill">
            <i class="mdi mdi-spin mdi-shape-polygon-plus"></i>
            &nbsp;Create New @yield('title')
        </a>
    </div>
</div>
<div class="card card-default">
    <div class="card-footer card-profile-footer">
        <ul class="nav nav-border-top justify-content-center">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cms.'.$routePrefix . '.show', $model) }}">Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cms.'.$routePrefix . '.edit', $model) }}">Form</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('cms.'.$routePrefix . '.historical-changes', $model) }}">Historical Changes</a>
            </li>

        </ul>
    </div>
    <div class="card-body">
        <div class="form-group">
            <br>
            <center><b>Important Notice:</b> SEO historical changes data won't be saved for performance matters.</center>
        </div>
    </div>
    @include('cms._include.activitylog', ['subjectType' => get_class($model), 'model' => $model, 'activities' => $activities])
</div>
@endsection
