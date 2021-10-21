<div id="left-sidebar" class="sidebar">
    <div class="sidebar-scroll">
        <div class="user-account">
            @if(\Auth::user()->profile_photo_path!="")
            <img src="{{ \Auth::user()->profile_photo_path }}" class="rounded-circle user-photo" alt="{{\Auth::user()->name}}">
            @else
            <img src="{{ asset('assets/img/user.png') }}" class="rounded-circle user-photo" alt="{{\Auth::user()->name}}">
            @endif
            <div class="dropdown">
                <span>Welcome,</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>{{ isset(\Auth::user()->name)?\Auth::user()->name :''}}</strong></a>
                <ul class="dropdown-menu dropdown-menu-right account">
                    <li><a href="{{route('profile')}}"><i class="icon-user"></i>My Profile</a></li>
                    <li><a href=""><i class="icon-envelope-open"></i>Messages</a></li>
                    <li><a href="{{route('setting')}}"><i class="icon-settings"></i>Settings</a></li>
                    <li class="divider"></li>
                    <li><a href="#" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="icon-power"></i>Logout</a></li>
                </ul>
            </div>
            <hr>
            <ul class="row list-unstyled">
                @if(\Auth::user()->user_access_id==3)<!--Sales and Business Development-->
                <li class="col-4 text-center">
                    <small>Opportunity</small>
                    <h6>{{count_project_status(1)}}</h6>
                </li>
                <li class="col-4 text-center">
                    <small>Successful</small>
                    <h6>{{count_project_status(2)}}</h6>
                </li>
                <li class="col-4 text-center">
                    <small>Unsuccessful</small>
                    <h6>{{count_project_status(3)}}</h6>
                </li>
                @else
                <li class="col-4">
                    <small>Sales</small>
                    <h6>456</h6>
                </li>
                <li class="col-4">
                    <small>Order</small>
                    <h6>1350</h6>
                </li>
                <li class="col-4">
                    <small>Revenue</small>
                    <h6>$2.13B</h6>
                </li>
                @endif
            </ul>
        </div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#menu">Menu</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Chat"><i class="icon-book-open"></i></a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#setting"><i class="icon-settings"></i></a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#question"><i class="icon-question"></i></a></li>                
        </ul>
        <!-- Tab panes -->
        <div class="tab-content p-l-0 p-r-0">
            <div class="tab-pane active" id="menu">
                <nav id="left-sidebar-nav" class="sidebar-nav">
                    <ul id="main-menu" class="metismenu">    
                        @if(\Auth::user()->user_access_id==3)<!--Sales and Business Development-->
                        <li class="{{ Request::segment(1) === 'project' ? 'active' : null }}">
                            <a href="{{route('project')}}"><i class="fa fa-database"></i> <span>Projects</span></a>
                        </li>
                        <li class="{{ Request::segment(1) === 'customer' ? 'active' : null }}">
                            <a href="{{route('customer')}}"><i class="fa fa-user"></i> <span>Customer</span></a>
                        </li>
                        @endif
                        @if(\Auth::user()->user_access_id==4)<!--Project Manager-->
                        <li class="{{ Request::segment(1) === 'vendor' ? 'active' : null }}">
                            <a href="{{route('vendor')}}"><i class="fa fa-database"></i> <span>Vendor</span></a>
                        </li>
                        @endif
                        <li class="{{ Request::segment(1) === 'dashboard' ? 'active' : null }}">
                            <a href="#Dashboard" class="has-arrow"><i class="icon-home"></i> <span>Dashboard</span></a>
                            <ul>
                                <li class="{{ Request::segment(2) === 'analytical' ? 'active' : null }}"><a href="">Analytical</a></li>                                    
                            </ul>
                        </li>
                        @foreach(get_menu(\Auth::user()->user_access_id) as $menu)
                        <li class="{{ (isset($menu['prefix_all']) && (in_array(Request::segment(1),$menu['prefix_all']) || Request::segment(1)==@$menu['prefix_link'])) ? 'active' : null }}">
                            <a href="#App" class="has-arrow"><i class="icon-grid"></i> <span>{{ $menu['name'] }}</span></a>
                            @if(isset($menu['sub_menu']))
                            <ul>
                                @foreach($menu['sub_menu'] as $k =>$sub_menu)
                                <li class="{{ (Request::segment(2) === $sub_menu['prefix_link'] || Request::segment(1) === $sub_menu['prefix_link']) ? 'active' : null }}"><a href="{{route($sub_menu['link'])}}">{{ $sub_menu['name'] }}</a></li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
            <div class="tab-pane p-l-15 p-r-15" id="Chat">
                <form>
                    <div class="input-group m-b-20">
                        <div class="input-group-prepend">
                            <span class="input-group-text" ><i class="icon-magnifier"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Search...">
                    </div>
                </form>
            </div>            
        </div>          
    </div>
</div>
