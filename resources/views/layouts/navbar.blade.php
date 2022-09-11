<nav class="navbar navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-btn">
            <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
        </div>
        <div class="navbar-brand">    
            <a href="javascript:void(0);" class="btn-toggle-fullwidth hidden-sm hidden-md hidden-lg" style="display:none;"><i class="fa fa-list"></i></a>
            <a href="/" class="hidden-sm hidden-md" style="font-size:25px;margin-right:10px"><i class="fa fa-list"></i></a>
            @if(get_setting('logo'))<a href="/"><img src="{{ get_setting('logo') }}" alt="" class="img-responsive logo"></a>@endif
        </div>
        <div class="navbar-right">
            <form id="navbar-search" class="navbar-form px-0">
                <div class="row">
                    <div>
                        @if(session()->get('company_id'))
                            @if(session()->get('company_id')==1)
                                <a href="{{route('home',['company_id'=>1])}}">
                                    <img src="{{asset('images/hup.png')}}" class="mr-3  mt-2" style="height:40px;" />
                                </a>
                            @else
                                <a href="{{route('home',['company_id'=>2])}}">
                                    <img src="{{asset('images/pmt-logo.png')}}" class="mr-3 mt-2"  style="height:30px;" />
                                </a>
                            @endif
                        @endif
                    </div>
                    <div>
                        <h6 class="mt-2 mb-0 pb-0"> @yield('title')</h6>
                        @if (trim($__env->yieldContent('parentPageTitle')))
                            <span>@yield('parentPageTitle')</span>
                        @endif
                    </div>
                </div>
            </form>
            <div id="navbar-menu">
                <ul class="nav navbar-nav">
                    <li class="d-none d-sm-inline-block d-md-none d-lg-inline-block">
                        @if(\Auth::user()->name)
                            {{\Auth::user()->name}} {!!isset(\Auth::user()->access->name) ? '<br /><small>( '. \Auth::user()->access->name .' )</small>' : ''!!}
                        @endif
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown"><i class="icon-support"></i></a>
                        <ul class="dropdown-menu user-menu menu-icon">
                            <li class="menu-heading">IT SUPPORT</li>
                            <li><a href="{{route('trouble-ticket.index')}}"><i class="fa fa-gear"></i> <span>Trouble Ticket</span></a></li>
                            <li><a href="{{route('incident-report.index')}}"><i class="fa fa-gear"></i> <span>Incident Report</span></a></li>
                            <li><a href="{{route('application-room-request.index')}}"><i class="fa fa-gear"></i> <span>Application & Room Request</span></a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown"><i class="icon-equalizer"></i></a>
                        <ul class="dropdown-menu user-menu menu-icon">
                            <li class="menu-heading">ACCOUNT SETTINGS</li>
                            <li><a href="javascript:void(0);" title="Profile, Name, Picture, Telepon, etc"><i class="icon-note"></i> <span>Profile</span></a></li>
                            <li><a href="{{route('setting')}}" title="Setting Application"><i class="fa fa-gear"></i> <span>Setting</span></a></li>
                            @if(\Auth::user()->user_access_id !=1 and \Session::get('is_login_administrator')==true)
                            <li><a href="{{route('back-to-admin')}}" class="text-danger"><i class="fa fa-arrow-right"></i> <span>Back to Admin</span></a></li>
                            @endif
                        </ul>
                    </li>
                    <li><a href="" data-toggle="tooltip" title="Logout" onclick="event.preventDefault();
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
    $("select[name='searching_menu']").on('select2:select', function (e) {
        var link = $(this).find(':selected').data('link');
        if(link!=""){
            window.location.href = link;
        }    
    });

</script>
@endpush