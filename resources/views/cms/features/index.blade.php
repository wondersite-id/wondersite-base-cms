@extends('layouts.cms')
 
@section('title', 'Features')

@section('description', 'Features will be shown on homepage and feature page. It contains name, description, sequence number and image.')

@section('css')
    @parent
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">List of Features</li>
    </ol>
</nav>
<div class="card card-default">
    <div class="card-body text-center">
        <h3 class="card-title">List of Features</h3>
        <p class="card-text pb-4 pt-1">
            @yield('description')
        </p>
        <a href="{{ route('features.create') }}" class="btn btn-primary btn-sm btn-pill">
            <i class="mdi mdi-plus"></i>
            &nbsp;Create New @yield('title')
        </a>
    </div>
</div>
<div class="card card-default">
    <div class="card-body">
        <table class="yajra-datatable table table-hover table-product" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Published</th>
                    <th>Seq. Number</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Published</th>
                    <th>Seq. Number</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirm" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirm">Delete Confirmation</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Are you sure to delete the data?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" action="#">
                    @csrf
                    @method('DELETE')

                    <input type="submit" class="btn btn-primary delete-user" value="Delete" />
                </form>
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
            scrollX: true,
            processing: true,
            serverSide: true,
            bLengthChange: false,
            ajax: "{{ route('features.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'description', name: 'description'},
                {data: 'published', name: 'published'},
                {data: 'sequence_number', name: 'sequence_number'},
                {data: 'image', name: 'image'},
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false
                },
            ]
        });

        $(document).on('click','body .delete-btns',function(){
            var id = $(this).attr('data-id')
            $('#deleteForm').attr('action', "{{ url('features') }}"+ "/" + id)
        });
        
    });
    </script>
@endsection