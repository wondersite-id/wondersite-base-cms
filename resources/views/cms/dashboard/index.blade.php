@extends('layouts.cms')
 
@section('title', 'Dashboard')

@section('content')
    <div class="card card-default bg-transparent border-0 mt-0 mb-0">
        <div class="card-body px-0">
            <div class="row">
                <div class="col-lg-6 col-xl-3">
                    <div class="card card-default bg-secondary">
                        <div class="card-header">
                            <h2 class="text-white">890</h2>
                            <p class="flex-basis-100 text-white">Total Users</p>
                        </div>
                        <div class="card-body">
                            <div class="progress progress-sm progress-white rounded-0 mb-1">
                                <div class="progress-bar bg-white" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-white text-capitalize">User Reached</span>
                                <span class="text-white text-capitalize">80%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3">
                    <div class="card card-default bg-success">
                        <div class="card-header">
                            <h2 class="text-white">350</h2>
                            <p class="flex-basis-100 text-white">Order Placed</p>
                        </div>
                        <div class="card-body">
                            <div class="progress progress-sm progress-white rounded-0 mb-1">
                                <div class="progress-bar bg-white" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-white text-capitalize">Order Placed</span>
                                <span class="text-white text-capitalize">70%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3">
                    <div class="card card-default bg-primary">
                        <div class="card-header">
                            <h2 class="text-white">1360</h2>
                            <p class="flex-basis-100 text-white">Total Sales</p>
                        </div>
                        <div class="card-body">
                            <div class="progress progress-sm progress-white rounded-0 mb-1">
                                <div class="progress-bar bg-white" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-white text-capitalize">Sales of this year</span>
                                <span class="text-white text-capitalize">60%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3">
                    <div class="card card-default bg-info">
                        <div class="card-header">
                            <h2 class="text-white">Rp. </h2>
                            <p class="flex-basis-100 text-white">Monthly Revenue</p>
                        </div>
                        <div class="card-body">
                            <div class="progress progress-sm progress-white rounded-0 mb-1">
                                <div class="progress-bar bg-white" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-white text-capitalize">Reveneu Reached</span>
                                <span class="text-white text-capitalize">80%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card card-default">
                <div class="card-header">
                    <h2>Last Activities</h2>
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-thead-border">
                        <tbody>
                            @foreach ($data['lastActivities'] as $activity)
                            <tr>
                                <td class="col-lg-3 text-dark ">
                                    @if ($activity->causer)
                                    <a class="text-primary" href="{{ route($activity->causer->isAdmin() ? "administrators.show":"customers.show", $activity->causer->id) }}">{{ $activity->causer->name }} ({{ $activity->causer->email }})</a> 
                                    @else
                                    System
                                    @endif
                                    {{ $activity->description . " " . (($activity->subject == null) ? "" : $activity->subject->name . " data") }}
                                </td>
                                <td class="col-lg-3 text-right">
                                    {{ $activity->created_at->diffForHumans() }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="border-top">
                            <tr>
                                <td><a href="#" class="text-uppercase font-weight-bold">See All</a></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card card-default">
                <div class="card-header align-items-center">
                    <h2 class="">Wondersite's Templates</h2>
                    <a href="#" class="btn btn-primary btn-sm btn-pill" data-toggle="modal" data-target="#modal-stock">Add Template</a>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <table id="product-sale" class="table table-product " style="width:100%">
                            <thead>
                                <tr>
                                    <th>Template Name</th>
                                    <th>Total Used</th>
                                    <th>Price</th>
                                    <th>%used</th>
                                    <th class="th-width-250"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Coach Swagger</td>
                                    <td>134</td>
                                    <td>$24541</td>
                                    <td>35.28%</td>
                                    <td>
                                        <div class="progress progress-md rounded-0">
                                            <div class="progress-bar" role="progressbar" style="width: 70%" aria-valuenow="70%" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Gucci Watch</td>
                                    <td>32</td>
                                    <td>$554</td>
                                    <td>8%</td>
                                    <td>
                                        <div class="progress progress-md rounded-0">
                                            <div class="progress-bar" role="progressbar" style="width: 8%" aria-valuenow="8%" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
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
        toastr.success("{{ session()->get('message') }}");
        @endif        
    });
    </script>
@endsection

