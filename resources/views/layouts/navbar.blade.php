<nav class="navbar navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-btn">
            <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
        </div>
        <div class="navbar-brand">    
            <a href="javascript:void(0);" class="btn-toggle-fullwidth hidden-sm hidden-md hidden-lg" style="display:none;"><i class="fa fa-list"></i></a>
            <a href="/" class="hidden-sm hidden-md" style="font-size:25px;margin-right:10px"><i class="fa fa-list"></i></a>
            @if(get_setting('logo'))<a href="/"><img src="{{ get_setting('logo') }}" alt="Lucid Logo" class="img-responsive logo"></a>@endif
        </div>
        <div class="navbar-right">
            <form id="navbar-search" class="col-md-6 navbar-form">
                <div class="row">
                    <div class="col-md-4">
                        <h6 class="mt-2"> @yield('title')</h6>
                    </div>
                    <div class="col-md-7">
                        {{-- <input value="" class="form-control" placeholder="Search here..." type="text"> --}}
                        <select class="form-control" name="searching_menu">
                            <option value="">Searching...</option>
                            @foreach(\App\Models\ClientProject::get() as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                                @foreach(\App\Models\Module::where(['client_project_id'=>$item->id])->get() as $module)
                                <option value=""> - {{$module->name}}</option>
                                    @foreach(\App\Models\ModulesItem::where(['module_id'=>$module->id,'type'=>1])->get() as $module_item)
                                    <option value=""> -- {{$module_item->name}}</option>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="col-md-1">
                        <button type="button" class="btn btn-default"><i class="icon-magnifier"></i></button>
                    </div> --}}
                </div>
            </form>
            <div id="navbar-menu">
                <ul class="nav navbar-nav">
                    <li class="d-none d-sm-inline-block d-md-none d-lg-inline-block">
                        @if(\Auth::user()->name)
                            {{\Auth::user()->name}} {{isset(\Auth::user()->access->name) ? ' ( '. \Auth::user()->access->name .' ) ' : ''}}
                        @endif
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                            <i class="icon-bell"></i>
                            <span class="notification-dot"></span>
                        </a>
                        <ul class="dropdown-menu notifications">
                            <li class="header"><strong>You have 0 new Notifications</strong></li>
                            <li class="footer"><a href="javascript:void(0);" class="more">See all notifications</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown"><i class="icon-equalizer"></i></a>
                        <ul class="dropdown-menu user-menu menu-icon">
                            <li class="menu-heading">ACCOUNT SETTINGS</li>
                            <li><a href="javascript:void(0);"><i class="icon-note"></i> <span>Profile</span></a></li>
                            <li><a href="javascript:void(0);"><i class="icon-equalizer"></i> <span>Setting</span></a></li>
                            <li><a href="{{route('back-to-admin')}}" class="text-danger"><i class="fa fa-arrow-right"></i> <span>Back to Admin</span></a></li>
                        </ul>
                    </li>
                    <li><a href="" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" class="icon-menu"><i class="icon-login"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
@push('after-scripts')
<link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}"/>
<script src="{{ asset('assets/vendor/select2/js/select2.min.js') }}"></script>
<style>
    .select2-container .select2-selection--single {height:36px;padding-left:10px;}
    .select2-container .select2-selection--single .select2-selection__rendered{padding-top:3px;}
    .select2-container--default .select2-selection--single .select2-selection__arrow{top:4px;right:10px;}
    .select2-container {width: 100% !important;}
</style>
<script>
    $("select[name='searching_menu']").select2();
</script>
@endpush