@extends('layouts.cms')
 
@section('title', 'Menus')

@section('description', 'Menu will be shown on every page. It will be located at the header & footer section.')

@section('css')
    @parent
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('menus.index') }}">List Menus</a></li>
        <li class="breadcrumb-item active" aria-current="page">Historical Changes</li>
    </ol>
</nav>
<div class="card card-default">
    <div class="card-body text-center">
        <h3 class="card-title">Historical Changes of @yield('title')</h3>
        <p class="card-text pb-4 pt-1">
            @yield('description')
        </p>
        <a href="{{ route('menus.create') }}" class="btn btn-primary btn-sm btn-pill">
            <i class="mdi mdi-plus"></i>
            &nbsp;Create New @yield('title')
        </a>
    </div>
</div>
<div class="card card-default">
    <div class="card-footer card-profile-footer">
        <ul class="nav nav-border-top justify-content-center">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('menus.show', $model) }}">Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('menus.edit', $model) }}">Form</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('menus.historical-changes', $model) }}">Historical Changes</a>
            </li>

        </ul>
    </div>
    @include('cms._include.activitylog', ['subjectType' => get_class($model), 'model' => $model, 'activities' => $activities])
</div>
@endsection
