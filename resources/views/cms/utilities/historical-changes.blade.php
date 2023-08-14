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
        <li class="breadcrumb-item"><a href="{{ route($routePrefix.'.index') }}">List Utilities</a></li>
        <li class="breadcrumb-item active" aria-current="page">Historical Changes</li>
    </ol>
</nav>
<div class="card card-default">
    <div class="card-body text-center">
        <h3 class="card-title">Historical Changes of @yield('title')</h3>
        <p class="card-text pb-4 pt-1">
            @yield('description')
        </p>
    </div>
</div>
<div class="card card-default">
    <div class="card-footer card-profile-footer">
        <ul class="nav nav-border-top justify-content-center">
            <li class="nav-item">
                <a class="nav-link" href="{{ route($routePrefix.'.show', $model) }}">Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route($routePrefix.'.edit', $model) }}">Form</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route($routePrefix.'.historical-changes', $model) }}">Historical Changes</a>
            </li>

        </ul>
    </div>
    @include('cms._include.activitylog', ['subjectType' => get_class($model), 'model' => $model, 'activities' => $activities])
</div>
@endsection
