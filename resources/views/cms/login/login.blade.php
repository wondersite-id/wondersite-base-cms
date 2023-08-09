<!DOCTYPE html>

<html lang="en">
<head>
  <head>
  @include('cms._include.meta')

  <title>wondersite.id - Login</title>

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
  <link href="{{ asset('cms/plugins/material/css/materialdesignicons.min.css') }} " rel="stylesheet" />
  <link href="{{ asset('cms/plugins/simplebar/simplebar.css') }}" rel="stylesheet" />

  <link href="{{ asset('cms/plugins/nprogress/nprogress.css') }}" rel="stylesheet" />
  <link id="main-css-href" rel="stylesheet" href="{{ asset('cms/css/style.css') }}" />

  <link href="{{ asset('cms/images/favicon.png') }}" rel="shortcut icon" />
  <script src="{{ asset('cms/plugins/nprogress/nprogress.js') }}"></script>
</head>

</head>
  <body class="bg-light-gray" id="body">
          <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh">
          <div class="d-flex flex-column justify-content-between">
            <div class="row justify-content-center">
              <div class="col-lg-6 col-md-10">
                <div class="card card-default mb-0">
                  <div class="card-header pb-0">
                    <div class="app-brand w-100 d-flex justify-content-center border-bottom-0">
                      <a class="w-auto pl-0" href="/">
                        <img height="50px" src="{{ asset('cms/images/logo.png') }}" alt="Mono">
                        <span class="brand-name text-dark">{{ Setting::get('home-website-name') }}</span>
                      </a>
                    </div>
                  </div>
                  <div class="card-body px-5 pb-5 pt-0">

                    <h4 class="text-dark mb-6 text-center">Login</h4>

                    <form class="user" novalidate method="POST" action="{{ url('login') }}">
                      @csrf
                      @if ($errors->any())
                      <div class="alert alert-danger alert-dismissible" role="alert">
                          @foreach ($errors->all() as $error)
                          <small>{{ $error }}</small> <br>
                          @endforeach
                      </div>
                      @endif
                      @if (session()->has('message'))
                          <div class="alert alert-success alert-dismissible" role="alert">
                              <small>{{ session()->get('message') }}</small> <br>
                          </div>
                      @endif
                      <div class="row">
                        <div class="form-group col-md-12 mb-4">
                          <input type="email" class="form-control input-lg" id="email" name="email" value="{{ old('email') }}" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                        </div>
                        <div class="form-group col-md-12 ">
                          <input type="password" class="form-control input-lg" id="password" name="password" placeholder="Password">
                        </div>
                        <div class="col-md-12">

                          <div class="d-flex justify-content-between mb-3">
                            <div class="custom-control custom-checkbox mr-3 mb-3">
                              <input type="checkbox" class="custom-control-input" id="customCheck2">
                              <label class="custom-control-label" for="customCheck2">Remember me</label>
                            </div>

                            <a class="text-color" href="#"> Forgot password? </a>

                          </div>

                          <button type="submit" class="btn btn-primary btn-pill mb-4">Login</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

</body>
</html>
