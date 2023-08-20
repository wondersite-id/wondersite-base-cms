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
        <li class="breadcrumb-item active" aria-current="page">List of {{ $title }}</li>
    </ol>
</nav>
<div class="card card-default">
    <div class="card-body text-center">
        <h3 class="card-title">List of {{ $title }}</h3>
        <p class="card-text pb-4 pt-1">
            @yield('description')
        </p>
        <a href="{{ route('cms.'.$routePrefix . '.create') }}" class="btn btn-primary btn-sm btn-pill">
            <i class="mdi mdi-spin mdi-shape-polygon-plus"></i>
            &nbsp;Create New @yield('title')
        </a>
    </div>
</div>

<div class="row">
    <div class="col-xl-6">
        <div class="card card-default">
            <div class="card-body">
                <table class="table accordion" id="accordionHeaderMenu">
                    <thead id="headerMenu" data-toggle="collapse" data-target="#collapseHeaderMenu" aria-expanded="true" aria-controls="collapseHeaderMenu" style="background-color: #708090">
                        <tr>
                            <th class="col-xl-3 text-white">
                                Header Menus Structure
                            </th>
                            <th class="text-right text-white col-xl-3 justify-content-center">
                                <i class="mdi mdi-arrow-bottom-left-thick"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="collapseHeaderMenu" class="collapse" aria-labelledby="headerMenu" data-parent="#accordionHeaderMenu">
                        @foreach ($parentMenus->where('type', 'header') as $menu)
                        <tr>
                            <td><small>{{ $menu->name }}</small></td>
                            <td>
                                @foreach($menu->childs as $childMenu)
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card card-default">
            <div class="card-body" style="display: block;overflow-x: auto;white-space: nowrap;">
                <table class="table">
                    <thead id="footerMenu" data-toggle="collapse" data-target="#collapseFooterMenu" aria-expanded="true" aria-controls="collapseFooterMenu" style="background-color: #708090">
                        <tr>
                            <th class="col-xl-4 text-white">
                                Footer Menus Structure
                            </th>
                            <th class="text-right text-white col-xl-2">
                                <i class="mdi mdi-arrow-bottom-left-thick"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="collapseFooterMenu" class="collapse" aria-labelledby="footerMenu" data-parent="#accordionFooterrMenu">
                        @foreach ($parentMenus->where('type', 'footer') as $menu)
                        <tr>
                            <td><small>{{ $menu->name }}</small></td>
                            <td>
                                @if ($menu->childs->count() > 0)
                                    @foreach($menu->childs as $childMenu)
                                    &#8226; <small>{{ $childMenu->name }}</small><br>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    
<div class="card card-default">
    <div class="card-body">
        <table class="yajra-datatable table table-hover table-product" id="dataTable" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Seq. Number</th>
                    <th>Type</th>
                    <th>URL</th>
                    <th>New Tab</th>
                    <th>Action</th>
                </tr>
            </thead>
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
            dom: '<lf><t><"d-flex justify-items-center justify-content-between py-5" <"small text-muted" i>p>',
            scrollX: true,
            processing: true,
            serverSide: true,
            bLengthChange: false,
            ajax: "{{ route('cms.'.$routePrefix . '.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'sequence_number', name: 'sequence_number'},
                {data: 'type', name: 'type'},
                {data: 'url', name: 'url'},
                {data: 'new_tab', name: 'new_tab'},
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false
                } 
            ]
        });

        $(document).on('click','body .delete-btns',function(){
            var id = $(this).attr('data-id')
            $('#deleteForm').attr('action', "{{ url('cms/menus') }}"+ "/" + id)
        });
        
    });
    </script>
@endsection