<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ env('APP_NAME')}}: @yield('title')  </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('img/logo/logo2.png')}}' />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('js/pnotify/css/pnotify.custom.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('js/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/ruang-admin.min.css') }}" rel="stylesheet">
    @yield('style')  

 
</head>
<body id="page-top">
    <div class="loader"></div>
    <div id="app" ng-app="sms">
    <div id="wrapper">
@include('layouts.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('layouts.topbar')
                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                      <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
                       @yield('breadcrumb')
                      </ol>
                    </div>
                  
                   <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                          @yield('content')
                        </div>
                    </div>
                       
                   </div>
            </div>
        </div>
        </div>

     

        
    </div>
    </div>

 <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/ruang-admin.min.js') }}"></script>
    <script src="{{ asset('js/angular-1.8.0/angular.min.js') }}"></script>
    <script src="{{ asset('js/angular-1.8.0/ui-bootsrap-all.js') }}"></script>
    <script src="{{ asset('js/angular/loader.js')}}"></script>
    <script src="{{ asset('js/pnotify/js/pnotify.custom.min.js')}}"></script>
    <script src="{{ asset('js/sweet-alert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendor/marquee/jquery.marquee.min.js') }}"></script>
<script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/angular/main.js')}}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    @yield('script')  
</body>
</html>
