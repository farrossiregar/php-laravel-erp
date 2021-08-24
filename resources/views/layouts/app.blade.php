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
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}?v=3">
        <link rel="stylesheet" href="{{ asset('assets/css/color_skins.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}?v={{env('APP_DEBUG')?date('YmdHis'):''}}">
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    
        @stack('after-styles')
        @if (trim($__env->yieldContent('page-styles')))
            @yield('page-styles')
        @endif
        @livewireStyles
        <style>
            .theme-blue:before, .theme-blue:after {background:white !important;}
            .theme-blue #wrapper:before, .theme-blue #wrapper:after {background:white !important;}
        </style>
    </head>
    <body class="theme-blue layout-fullwidth">
        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="m-t-30">
                    <img src="{{get_setting('logo')}}" style="height:48px;" alt="{{get_setting('company')}}">
                </div>
                <p>Please wait...</p>        
            </div>
        </div>
        @foreach(\App\Models\Department::get() as $dep)
            <div class="left-sub-menu pt-5 item_{{$dep->id}}">
                <div class="sidebar-scroll">
                    <h6 class="px-3"><a href="javascript:void(0)" style="font-size: 17px;margin-right:10px;" onclick="hide_left_menu()"><i class="fa fa-arrow-left"></i></a> {{$dep->name}}</h6>
                    <nav id="lef t-sidebar-nav" class="sidebar-nav">
                        <ul class="metismenu main-menu">
                            @foreach(\App\Models\Module::select('modules.*')->join('client_projects','client_projects.id','=','modules.client_project_id')->where(['department_id'=>$dep->id])->groupBy('client_project_id')->where(
                                        function($table){
                                            if(session()->get('company_id')) $table->where('client_projects.company_id',session()->get('company_id')); 
                                        })->get() as $menu)
                                <li class="">
                                    <a href="#menu_{{$menu->id}}" class="has-arrow"><i class="icon-home"></i> <span>{{isset($menu->client_project->name) ? $menu->client_project->name : ''}}</span></a>
                                    <ul>
                                        @foreach(\App\Models\ModulesItem::where('module_id',$menu->id)->whereNotNull('module_group_id')->groupBy('module_group_id')->get() as $group)
                                            @foreach(\App\Models\ModulesItem::where(['module_id'=>$menu->id,'module_group_id'=>$group->module_group_id])->get() as $action)    
                                                <li class=""><a href="">{{$action->name}}</a></li> 
                                            @endforeach
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </nav>        
                </div>
            </div>
        @endforeach
        <div id="wrapper">
            @include('layouts.navbar')
            {{-- @include('layouts.sidebar') --}}
            <div id="main-content">
                <div class="container-fluid">
                    <div class="block-header">
                        @if(session()->has('message-success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="fa fa-check-circle"></i> {!!session('message-success')!!}
                        </div>
                        @endif
                        @if(session()->has('message-error'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="fa fa-times-circle"></i> {!!session('message-error')!!}
                        </div>
                        @endif
                        <div class="alert alert-danger alert-dismissible" role="alert" style="display:none">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="fa fa-times-circle"></i> <span class="message"></span>
                        </div>
                        <div class="alert alert-success alert-dismissible" role="alert" style="display:none">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="fa fa-check-circle"></i> <span class="message"></span>
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
        <script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}?v=1"></script>
        <style>
            .left-sub-menu {
                -webkit-transition: all 0.3s ease-in-out;
                -moz-transition: all 0.3s ease-in-out;
                -ms-transition: all 0.3s ease-in-out;
                -o-transition: all 0.3s ease-in-out;
                transition: all 0.3s ease-in-out;
                background:white;
                height: calc(100% - 65px);
                width:300px;
                position:fixed;
                margin-top: 60px;
                z-index:99;
                display: none;
            }
            .left-sub-menu.active{
                display: block !important;
            }
            .left-sub-menu #left-sidebar-nav {
                margin-top:50px;
            }
        </style>
        @livewireScripts
        @stack('after-scripts')
        @if (trim($__env->yieldContent('page-script')))
            <script>
                @yield('page-script')
            </script>
        @endif
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        <script>
            function hide_left_menu(){
                $(".left-sub-menu").hide();
            }

            $('.metismenu').metisMenu();

            Livewire.on('message-success',(msg)=>{
                $('.alert-success').show();
                $('.alert-success .message').html(msg);
                $("html, body").animate({ scrollTop: 0 }, "slow");
            });

            Livewire.on('message-error',(msg)=>{
                $('.alert-error').show();
                $('.alert-error .message').html(msg);
                $("html, body").animate({ scrollTop: 0 }, "slow");
            });

            Livewire.on('refresh-form',()=>{
                $('[data-toggle="tooltip"]').tooltip();
            });
            function set_company_active(el)
            {
                var company_id = $(el).val();
                window.location = '{{$_SERVER['PHP_SELF']}}?company_id='+company_id;
            }
        </script>
        <script>
            function confirm_delete(){
                $("#confirm_delete").modal("show");
            }
            // $( document ).ready(function() {
            //     $(".btn-toggle-fullwidth").trigger('click');
            // });
            $('[data-toggle="tooltip"]').tooltip();
            $('*').tooltip();
        </script>
    </body>
</html>
