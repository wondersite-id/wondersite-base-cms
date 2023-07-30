@extends('layouts.cms')
 
@section('title', 'Admin')

@section('css')
    @parent
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('administrators.index') }}">List of Administrators</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail of Administrator</li>
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
                <a class="nav-link active" href="{{ route('administrators.show', $model) }}">Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('administrators.edit', $model) }}">Form</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('administrators.change-password', $model) }}">Change Password</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('administrators.historical-changes', $model) }}">Historical Changes</a>
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
            <label for="email">Email address</label>
                <br>
                {{ $model->email }}
        </div>
        <div class="form-group">
            <label for>Password</label><br>
            <a href="{{ route('administrators.change-password', $model) }}" class="mb-1 btn btn-sm btn-outline-primary">
                    <i class=" mdi mdi-key mr-1"></i>
                    Change Password
                </a>
        </div>
        <hr />
        @include('cms._include.buttons.back', ['backUrl' => route('administrators.index')])
        @include('cms._include.buttons.edit', ['editUrl' => route('administrators.edit', $model)])
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