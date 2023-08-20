@extends('layouts.cms')
 
@section('title', strtoupper($title))

@section('description', $description)

@section('css')
    @parent
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light">
        <li class="breadcrumb-item"><a href="{{ route('cms.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">List of {{ $title }}</li>
    </ol>
</nav>
<div class="card card-default">
    <div class="card-body text-center">
        <h3 class="card-title">List of SEO</h3>
        <p class="card-text pb-4 pt-1">
            @yield('description')
        </p>
    </div>
</div>
<div class="card card-default">
    <div class="card-body">
        <table class="yajra-datatable table table-hover table-product" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Model Type</th>
                    <th>Model Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')
    @parent
    <script type="text/javascript">
        $(function () {
        
        @if (session()->has('message'))
        toastr.info("{{ session()->get('message') }}");
        @endif
        
        
        var table = $('.yajra-datatable').DataTable({
            dom: '<lf><t><"d-flex justify-items-center justify-content-between py-5" <"small text-muted" i>p>',
            scrollX: true,
            processing: true,
            serverSide: true,
            bLengthChange: false,
            ajax: "{{ route('cms.'.$routePrefix . '.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'model_url', name: 'model_url'},
                {data: 'model_name', name: 'model_name'},
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false
                },
            ]
        });
    });
    </script>
@endsection