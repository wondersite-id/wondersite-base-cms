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
        <li class="breadcrumb-item active" aria-current="page">Update Article Type</li>
    </ol>
</nav>
<div class="card card-default">
    <div class="card-body text-center">
        <h3 class="card-title">Update @yield('title')</h3>
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
                <a class="nav-link active" href="{{ route('cms.'.$routePrefix . '.edit', $model) }}">Form</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cms.'.$routePrefix . '.historical-changes', $model) }}">Historical Changes</a>
            </li>
        </ul>
    </div>
    <div class="card-header">
        <h2>Article Type</h2>
    </div>
    <form method="POST" action="{{ route('cms.'.$routePrefix . '.update', $model->id) }}" enctype="multipart/form-data">
        <div class="card-body">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name @include('cms._include.required')</label>
                <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ old('name', $model->name) }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="sequence_number">Sequence Number @include('cms._include.required')</label>
                <input class="form-control @error('sequence_number') is-invalid @enderror" id="sequence_number" name="sequence_number" placeholder="Sequence Number" value="{{ old('sequence_number', $model->sequence_number) }}">
                @error('sequence_number')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <br />       
            @include('cms._include.buttons.back', ['backUrl' => route('cms.'.$routePrefix . '.index')])
            @include('cms._include.buttons.save') 
        </div>
    </form>
</div>
@endsection

