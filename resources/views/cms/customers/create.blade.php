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
        <li class="breadcrumb-item"><a href="{{ route($routePrefix . '.index') }}">List of Customers</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Customer</li>
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
    <div class="card-body">
        <form method="POST" action="{{ route($routePrefix . '.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Name @include('cms._include.required') </label>
                <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email address @include('cms._include.required')</label>
                <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" placeholder="name@example.com" value="{{ old('email') }}">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password @include('cms._include.required')</label>
                <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password" placeholder="Password" value="{{ old('password') }}">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <hr />
            @include('cms._include.buttons.back', ['backUrl' => route($routePrefix . '.index')])
            @include('cms._include.buttons.save')
        </form>
    </div>
</div>
@endsection
