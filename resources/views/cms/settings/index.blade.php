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
        <li class="breadcrumb-item active" aria-current="page">List of Utilities</li>
    </ol>
</nav>
<div class="card card-default">
    <div class="card-body text-center">
        <h3 class="card-title">List of Utilities</h3>
        <p class="card-text pb-4 pt-1">
            @yield('description')
        </p>
    </div>
</div>
<div class="card card-default">
    <div class="card-body ">
        <div class="p-12">
            <ul class="nav nav-custom-pills mb-3 justify-content-center" id="pills-tab-custom" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ request()->get('type') == 'home' ? 'active' : '' }}" id="pills-home-tab"  href="{{ route($routePrefix . '.index', ['type' => 'home']) }}" role="tab" aria-controls="pills-home" aria-selected="true">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->get('type') == 'footer' ? 'active' : '' }}" id="pills-footer-tab"  href="{{ route($routePrefix . '.index', ['type' => 'footer']) }}" role="tab" aria-controls="pills-footer" aria-selected="false">Footer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->get('type') == 'other' ? 'active' : '' }}" id="pills-other-tab"  href="{{ route($routePrefix . '.index', ['type' => 'other']) }}" role="tab" aria-controls="pills-other" aria-selected="false">Other</a>
                </li>
            </ul>
            <div class="tab-content mt-5" id="nav-tabContent">
                <div class="tab-pane fade active show" id="pills-{{ request()->get('type') }}-custom-pill" role="tabpanel" aria-labelledby="pills-{{ request()->get('type') }}-tab">
                    <table class="yajra-datatable table table-hover table-product" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Form Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>    
        </div>    
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
            ajax: "{{ route($routePrefix . '.index', ['type' => request()->get('type')]) }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'form_type', name: 'form_type'},
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