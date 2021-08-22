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
            <form id="navbar-search" class="col-md-9 navbar-form px-0">
                <div class="row">
                    <div class="col-md-2">
                        <h6 class="mt-2 mb-0 pb-0"> @yield('title')</h6>
                        @if (trim($__env->yieldContent('parentPageTitle')))
                            <span>@yield('parentPageTitle')</span>
                        @endif
                    </div>
                    <div class="col-md-10 px-0">
                        <ul class="nav navbar-nav">
                            @if(isset($_GET['company_id']))
                                @php(session(['company_id'=>$_GET['company_id']]))
                            @endif
                            @php($company_id = session()->get('company_id'))
                            <li>
                                <select class="form-control" style="border:0" onchange="set_company_active(this)">
                                    <option value="1" {{$company_id==1 ? 'selected' : ''}}>HUP</option>
                                    <option value="2" {{$company_id==2 ? 'selected' : ''}}>PMT</option>
                                </select>
                            </li>
                            @foreach(\App\Models\Department::get() as $key_dep => $dep)
                                @if($key_dep >5) @continue @endif
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle icon-menu text-info px-1" data-toggle="dropdown">{{$dep->name}}</a>
                                    <ul class="dropdown-menu user-menu menu-icon">
                                        @foreach(\App\Models\Module::select('modules.*')->join('client_projects','client_projects.id','=','modules.client_project_id')
                                            ->where(['department_id'=>$dep->id])->groupBy('client_project_id')->where(function($table){
                                            if(session()->get('company_id')) $table->where('client_projects.company_id',session()->get('company_id'));
                                        })->get() as $menu)

                                            <li><a href="{{route('home',['menu'=>$menu->id,'department_id'=>$dep->id])}}">{{isset($menu->client_project->name) ? $menu->client_project->name : ''}}</a></li>
                                            @php($sub_menu = \App\Models\Module::where(['department_id'=>$dep->id,'client_project_id'=>$menu->client_project_id])->get())
                                            @if($sub_menu->count() > 1 )
                                                <ul>
                                                    @foreach($sub_menu as $sub)
                                                        <li class="py-1"><a href="{{route('home',['menu'=>$sub->id,'department_id'=>$dep->id])}}" style="color:white;">{{isset($sub->name) ? $sub->name : ''}}</a></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                        {{-- <select class="form-control" name="searching_menu">
                            <option value="">Searching...</option>
                            @foreach(get_menu(\Auth::user()->user_access_id) as $menu)
                                <optgroup label="{{$menu['name']}}">
                                @if(isset($menu['sub_menu']))
                                    @foreach($menu['sub_menu'] as $sub)
                                    <option value="{{$sub->id}}" data-link="{{Route::has($sub->link) ? route($sub->link) : ''}}">{{$sub->name}}</option>
                                    @endforeach
                                @endif
                                </optgroup>
                            @endforeach
                        </select> --}}
                    </div>
                </div>
            </form>
            <div id="navbar-menu">
                <ul class="nav navbar-nav">
                    <li class="d-none d-sm-inline-block d-md-none d-lg-inline-block">
                        @if(\Auth::user()->name)
                        {{\Auth::user()->name}} {!!isset(\Auth::user()->access->name) ? ' <small>( '. \Auth::user()->access->name .' )</small>' : ''!!}
                        @endif
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