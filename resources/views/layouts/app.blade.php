<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"> <!-- Favicon-->
        <title>@yield('title') - {{ get_setting('company') }}</title>
        <meta name="description" content="@yield('meta_description', config('app.name'))">
        <meta name="author" content="@yield('meta_author', config('app.name'))">
        @yield('meta')

        {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
        @stack('before-styles')

        <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/jvectormap/jquery-jvectormap-2.0.3.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/vendor/morrisjs/morris.min.css') }}" />

        <!-- Custom Css -->
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/color_skins.css') }}">

        @stack('after-styles')

        @if (trim($__env->yieldContent('page-styles')))
            @yield('page-styles')
        @endif
        @livewireStyles
    </head>
    
    <?php 
        $setting = !empty($_GET['theme']) ? $_GET['theme'] : '';
        $theme = "theme-cyan";
        $menu = "";
        if ($setting == 'p') {
            $theme = "theme-purple";
        } else if ($setting == 'b') {
            $theme = "theme-blue";
        } else if ($setting == 'g') {
            $theme = "theme-green";
        } else if ($setting == 'o') {
            $theme = "theme-orange";
        } else if ($setting == 'bl') {
            $theme = "theme-blush";
        } else {
             $theme = "theme-cyan";
        }
    ?>

    <body class="<?= $theme ?>">

        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="m-t-30"><img src="{{url('/')}}/assets/img/logo-icon.svg" width="48" height="48" alt="Lucid"></div>
                <p>Please wait...</p>        
            </div>
        </div>

        <div id="wrapper">

            @include('layouts.navbar')
            @include('layouts.sidebar')

            <div id="main-content">
                <div class="container-fluid">
                    <div class="block-header">
                        <div class="row">
                            <div class="col-lg-5 col-md-8 col-sm-12">                        
                                <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> @yield('title')</h2>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('dashboard.analytical')}}"><i class="icon-home"></i></a></li>
                                    @if (trim($__env->yieldContent('parentPageTitle')))
                                       <li class="breadcrumb-item">@yield('parentPageTitle')</li>
                                    @endif
                                    @if (trim($__env->yieldContent('title')))
                                        <li class="breadcrumb-item active">@yield('title')</li>
                                    @endif
                                </ul>
                            </div>            
                            <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                                <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                                    <div class="sparkline text-left" data-type="line" data-width="8em" data-height="20px" data-line-Width="1" data-line-Color="#00c5dc"
                                        data-fill-Color="transparent">3,5,1,6,5,4,8,3</div>
                                    <span>Visitors</span>
                                </div>
                                <div class="inlineblock text-center m-r-15 m-l-15 hidden-sm">
                                    <div class="sparkline text-left" data-type="line" data-width="8em" data-height="20px" data-line-Width="1" data-line-Color="#f4516c"
                                        data-fill-Color="transparent">4,6,3,2,5,6,5,4</div>
                                    <span>Visits</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @yield('content')
                    {{$slot}}
                </div>
            </div>
        </div>

        <!-- Scripts -->
        @stack('before-scripts')
        <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>    
        <script src="{{ asset('assets/bundles/vendorscripts.bundle.js') }}"></script>
        <script src="{{ asset('assets/bundles/morrisscripts.bundle.js') }}"></script><!-- Morris Plugin Js -->
        <script src="{{ asset('assets/bundles/jvectormap.bundle.js') }}"></script> <!-- JVectorMap Plugin Js -->
        <script src="{{ asset('assets/bundles/knob.bundle.js') }}"></script>
        <script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
        @stack('after-scripts')
        @if (trim($__env->yieldContent('page-script')))
            <script>
                @yield('page-script')
            </script>
        @endif
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        @livewireScripts
    </body>
</html>
