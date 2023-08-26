<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta name="theme-name" content="wondersite" />
        @include('cms._include.meta')
        <title>{{ Utility::get('home-website-name') }} - @yield('title') </title>
        @section('css')
        <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
        <link href="{{ asset('cms/plugins/material/css/materialdesignicons.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('cms/plugins/simplebar/simplebar.css') }}" rel="stylesheet" />
        <link href="{{ asset('cms/plugins/nprogress/nprogress.css') }}" rel="stylesheet" />
        <link href="{{ asset('cms/css/style.css') }}" id="main-css-href" rel="stylesheet" />
        <link href="{{ asset('cms/images/favicon.png') }}" rel="shortcut icon" />
        <script src="{{ asset('cms/plugins/nprogress/nprogress.js') }}"></script>
        @show
    </head>
    <body class="bg-light-gray" id="body">
        <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh">
        <div class="d-flex flex-column justify-content-between">
          <div class="row justify-content-center mt-5">
            <div class="col-md-10">
              <div class="card card-default">
                <div class="card-header">
                  <div class="app-brand w-100 d-flex justify-content-center border-bottom-0">
                    <a class="w-auto pl-0" href="{{ route('cms.dashboard') }}">
                      <img height="40%" src="{{ asset('cms/images/logo.png') }}" alt="Logo">
                      <span class="brand-name text-dark">
                        {{ strtoupper(Utility::get('home-website-name')) }}
                      </span>
                    </a>
                  </div>
                </div>
                <div class="card-body p-7 text-center">
                  <h4 class="text-dark mb-6 ">403 Forbidden</h4>
                  <p class="mb-7">You don't have permission to access this resource.</p>
                  <a href="{{ route('cms.dashboard') }}" class="btn btn-primary btn-pill">Back to Home</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>  
    </body>
</html>
