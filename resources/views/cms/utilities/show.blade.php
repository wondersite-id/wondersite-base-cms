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
        <li class="breadcrumb-item"><a href="{{ route('cms.'.$routePrefix . '.index', ['type' => $model->type]) }}">List of {{ $title }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Utility</li>
    </ol>
</nav>
<div class="card card-default">
    <div class="card-body text-center">
        <h3 class="card-title">Detail of @yield('title')</h3>
        <p class="card-text pb-4 pt-1">
            @yield('description')
        </p>
    </div>
</div>
<div class="card card-default ">
    <div class="card-footer card-profile-footer">
        <ul class="nav nav-border-top justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('cms.'.$routePrefix . '.show', $model) }}">Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cms.'.$routePrefix . '.edit', $model) }}">Form</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cms.'.$routePrefix . '.historical-changes', $model) }}">Historical Changes</a>
            </li>
        </ul>
    </div>
    <div class="card-header">
        <h2>Utility</h2>
    </div>
    <div class="card-body card-profile-body">
        <div class="form-group">
            <label for="name">Name</label>
            <br>
            {{ $model->name }}
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <br>
            {{ ucfirst($model->type) }}
        </div>
        <div class="form-group">
            <label for="form_type">Form Type</label>
            <br>
            {{ ucfirst($model->form_type) }}
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <br>
            {!! $model->title !!}
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <br>
            {!! $model->description !!}
        </div>
        <div class="form-group">
            {{--  wysiwyg, text, textarea, image, switch --}}
            <label for="value">Value</label>
            <br>
            @if ($model->form_type == "image")
                @if ($image = $model->getFirstMedia(Str::plural('value')))
                    <img id="image-preview" height="150px" src="{{ $image->getUrl() }}" alt="Uploaded image" class="mt-3"/>
                @else
                    No Image Attached
                @endif
            @elseif ($model->form_type == "text" || $model->form_type == "textarea" || $model->form_type == "wysiwyg")
                {!! $model->value !!}
            @elseif ($model->form_type == "switch")
                @if ($model->value == "on")
                    <span class="badge badge-success">Yes</span>
                @else
                    <span class="badge badge-secondary">No</span>
                @endif
            @endif
        </div>
        <br />
        @include('cms._include.buttons.back', ['backUrl' => route('cms.'.$routePrefix . '.index', ['type' => $model->type])])
        @include('cms._include.buttons.edit', ['editUrl' => route('cms.'.$routePrefix . '.edit', $model)])
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