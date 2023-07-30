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
        <li class="breadcrumb-item active" aria-current="page">Historical Changes</li>
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
                <a class="nav-link" href="{{ route('customers.change-password', $model) }}">Change Password</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('customers.historical-changes', $model) }}">Historical Changes</a>
            </li>

        </ul>
    </div>
    @include('cms._include.activitylog', ['subjectType' => get_class($model), 'model' => $model, 'activities' => $activities])
</div>
@endsection
