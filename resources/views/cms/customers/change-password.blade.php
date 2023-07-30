@extends('layouts.cms')
 
@section('title', 'Customers')

@section('css')
    @parent
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">List of Customers</a></li>
        <li class="breadcrumb-item active" aria-current="page">Change Password</li>
    </ol>
</nav>
<div class="card card-default card-profile">
    <div class="card-header-bg" style="background-image:url({{ asset('cms/img/user/user-bg-01.jpg') }})"></div>
    <div class="card-body card-profile-body">
        <div class="profile-avata">
            <img class="rounded-circle" height="150px" width="150px" src="{{ asset('cms/images/user/undraw_profile_3.svg') }}" alt="Avatar Image">
            <span class="h5 d-block mt-3 mb-2">{{ $model->name }}</span>
            <span class="d-block">{{ $model->email }}</span>
        </div>
    </div>
</div>
<div class="card card-default">
    <div class="card-footer card-profile-footer">
        <ul class="nav nav-border-top justify-content-center">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('customers.show', $model) }}">Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('customers.edit', $model) }}">Form</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('customers.change-password', $model) }}">Change Password</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('customers.historical-changes', $model) }}">Historical Changes</a>
            </li>

        </ul>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('customers.do-change-password', $model->id) }}">
            @csrf
            <div class="form-group">
                <label for="current_password">Current Password @include('cms._include.required')</label>
                <input class="form-control @error('current_password') is-invalid @enderror" id="current_password" type="password" name="current_password" placeholder="Enter your current password" value="{{ old('current_password') }}">
                @error('current_password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">New Password @include('cms._include.required')</label>
                <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password" placeholder="Enter your new password" value="{{ old('password') }}">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Password Confirmation @include('cms._include.required')</label>
                <input class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" type="password" name="password_confirmation" placeholder="Enter your password" value="{{ old('password_confirmation') }}">
                @error('password_confirmation')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <hr />
            @include('cms._include.buttons.back', ['backUrl' => route('customers.index')])
            @include('cms._include.buttons.save')
        </form>
    </div>
</div>
@endsection
