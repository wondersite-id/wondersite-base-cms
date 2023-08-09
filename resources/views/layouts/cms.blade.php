<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta name="theme-name" content="mono" />
        @include('cms._include.meta')
        <title>wondersite.id - @yield('title') </title>
        @section('css')
        <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
        <link href="{{ asset('cms/plugins/material/css/materialdesignicons.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('cms/plugins/simplebar/simplebar.css') }}" rel="stylesheet" />
        <link href="{{ asset('cms/plugins/nprogress/nprogress.css') }}" rel="stylesheet" />
        <link href="{{ asset('cms/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <link href="{{ asset('cms/plugins/toaster/toastr.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('cms/plugins/ladda/ladda.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('cms/css/style.css') }}" id="main-css-href" rel="stylesheet" />
        <link href="{{ asset('cms/images/favicon.png') }}" rel="shortcut icon" />
        <script src="{{ asset('cms/plugins/nprogress/nprogress.js') }}"></script>
        @show
    </head>
    <body class="navbar-fixed sidebar-fixed" id="body">
        <script>
            NProgress.configure({ showSpinner: false });
            NProgress.start();
        </script>
        <div id="toaster"></div>
        <div class="wrapper">
            <aside class="left-sidebar sidebar-dark" id="left-sidebar">
                <div id="sidebar" class="sidebar sidebar-with-footer">
                    <div class="app-brand">
                        <a href="{{ route('dashboard') }}">
                        <img height="40%" src="{{ asset('cms/images/logo.png') }}" alt="Mono">
                        <span class="brand-name">{{ strtoupper(Setting::get('home-website-name')) }}</span>
                        </a>
                    </div>
                    @include('cms._include.sidebar')
                </div>
            </aside>
            <div class="page-wrapper">
                @include('cms._include.navbar')
                <div class="content-wrapper">
                    <div class="content">
                        @yield('content')

                        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutConfirm"aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="logoutConfirm">Logout Confirmation</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Are you sure to logout?</div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        <a class="btn btn-primary" href="{{ route('logout') }}">Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer -->
                <footer class="footer mt-auto">
                    <div class="copyright bg-white">
                        <p>
                            <span>Copyright &copy; wondersite.id &#8226; {{ now()->year }}</span>
                        </p>
                    </div>
                </footer>
            </div>
        </div>
        @section('js')
        <script src="{{ asset('cms/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('cms/plugins/simplebar/simplebar.min.js') }}"></script>
        <script src="https://unpkg.com/hotkeys-js/dist/hotkeys.min.js"></script>
        <script src="{{ asset('cms/plugins/apexcharts/apexcharts.js') }}"></script>
        <script src="{{ asset('cms/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('cms/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js') }}"></script>
        <script src="{{ asset('cms/plugins/jvectormap/jquery-jvectormap-world-mill.js') }}"></script>
        <script src="{{ asset('cms/plugins/jvectormap/jquery-jvectormap-us-aea.js') }}"></script>
        <script src="{{ asset('cms/plugins/daterangepicker/moment.min.js') }}"></script>
        <script src="{{ asset('cms/plugins/daterangepicker/daterangepicker.js') }}"></script>
        @yield('scripts')
        <script>
            jQuery(document).ready(function () {
               jQuery('input[name="dateRange"]').daterangepicker({
                  autoUpdateInput: false,
                  singleDatePicker: true,
                  locale: {
                     cancelLabel: 'Clear'
                  }
               });
               jQuery('input[name="dateRange"]').on('apply.daterangepicker', function (ev, picker) {
                  jQuery(this).val(picker.startDate.format('MM/DD/YYYY'));
               });
               jQuery('input[name="dateRange"]').on('cancel.daterangepicker', function (ev, picker) {
                  jQuery(this).val('');
               });
            });
        </script>
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        <script src="{{ asset('cms/plugins/toaster/toastr.min.js') }}"></script>
        <script src="{{ asset('cms/plugins/ladda/spin.min.js') }}"></script>
        <script src="{{ asset('cms/plugins/ladda/ladda.min.js') }}"></script>
        <script src="{{ asset('cms/js/mono.js') }}"></script>
        <script src="{{ asset('cms/js/custom.js') }}"></script>
        @show
    </body>
</html>
