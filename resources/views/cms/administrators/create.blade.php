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
        <li class="breadcrumb-item active" aria-current="page">Create Administrator</li>
    </ol>
</nav>
<div class="card card-default">
    <div class="card-body text-center">
        <h3 class="card-title">Add New @yield('title')</h3>
        <p class="card-text pb-4 pt-1">
            @yield('description')
        </p>
    </div>
</div>
<div class="card card-default">
    <div class="card-header">
        <h2>New Administrator</h2>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('cms.'.$routePrefix . '.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Name <small class="text-danger">*</small></label>
                <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" placeholder="name@example.com" value="{{ old('email') }}">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password" placeholder="Password" value="{{ old('password') }}">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <br />
            @include('cms._include.buttons.back', ['backUrl' => route('cms.'.$routePrefix . '.index')])
            @include('cms._include.buttons.save')
        </form>
    </div>
</div>
@endsection
