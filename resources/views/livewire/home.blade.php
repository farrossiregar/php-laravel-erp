@section('title', 'Dashboard')
@section('parentPageTitle', 'Home')
<div>
    <div id="left-sidebar" class="sidebar pt-3">
        <div class="sidebar-scroll">
            <div wire:loading class="mx-3"> Load menu....</div>
            @if($department)
                <div class="row" wire:loading.remove>
                    <div class="col-md-10">
                        <h6 class="mx-3">{{$department->name}}</h6>
                    </div>
                    <div class="col-md-2">
                        <a href="javascript:void(0)" onclick="close_left_menu()"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <hr />
                <nav id="left-sidebar-nav" class="sidebar-nav" wire:loading.remove>
                    <ul class="metismenu main-menu">
                        @foreach(\App\Models\Module::select('modules.*')->join('client_projects','client_projects.id','=','modules.client_project_id')->where(['department_id'=>$department->id])->groupBy('client_project_id')->where(
                                        function($table){
                                            if(session()->get('company_id')) $table->where('client_projects.company_id',session()->get('company_id')); 
                                        })->get() as $menu)
                            <li class="">
                                <a href="#menu_{{$menu->id}}" class="has-arrow"><span>{{isset($menu->client_project->name) ? $menu->client_project->name : ''}}</span></a>
                                <ul>
                                    @foreach(\App\Models\ModulesItem::where('module_id',$menu->id)->whereNotNull('module_group_id')->groupBy('module_group_id')->get() as $group)
                                        
                                        @if(isset($group->group->name))
                                            @if($group->group->name != $menu->client_project->name)
                                                <li><a href="javascript:void(0)">{{$group->group->name}}</a>
                                                    <ul>
                                                        @foreach(\App\Models\ModulesItem::where(['module_id'=>$menu->id,'module_group_id'=>$group->module_group_id])->get() as $action)    
                                                            <li class="ml-2">
                                                                @if(Route::has($action->link))
                                                                    <a href="{{route($action->link)}}" class="pl-5">{{$action->name}}</a>
                                                                @else
                                                                    <a href="javascript:void(0)" class="pl-5">{{$action->name}}</a>
                                                                @endif
                                                                @if($action->is_have_sub_menu==1)
                                                                    <ul>
                                                                        @foreach(\App\Models\ModulesItem::where(['parent_id'=>$action->id])->get() as $sub)
                                                                            @if(Route::has($sub->link))
                                                                                <li><a href="{{route($sub->link)}}" class="pl-5">{{$sub->name}}</a></li>
                                                                            @else
                                                                                <li> <a href="javascript:void(0)" class="pl-5">{{$sub->name}}</a></li>
                                                                            @endif
                                                                        @endforeach
                                                                    </ul>                                                        
                                                                @endif
                                                            </li> 
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @else
                                                @foreach(\App\Models\ModulesItem::where(['module_id'=>$menu->id,'module_group_id'=>$group->module_group_id])->get() as $action)    
                                                    <li class="">
                                                        @if(Route::has($action->link))
                                                            <a href="{{route($action->link)}}" class="pl-5">{{$action->name}}</a>
                                                        @else
                                                            <a href="javascript:void(0)" class="pl-5">{{$action->name}}</a>
                                                        @endif
                                                        @if($action->is_have_sub_menu==1)
                                                            <ul>
                                                                @foreach(\App\Models\ModulesItem::where(['parent_id'=>$action->id])->get() as $sub)
                                                                    @if(Route::has($sub->link))
                                                                        <li class="ml-2"> <a href="{{route($sub->link)}}" class="pl-5">{{$sub->name}}</a></li>
                                                                    @else
                                                                        <li class="ml-2"> <a href="javascript:void(0)" class="pl-5">{{$sub->name}}</a></li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>                                                        
                                                        @endif
                                                    </li> 
                                                @endforeach
                                            @endif
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            @endif
        </div>
    </div>
    <!--/End Sidebar-->

    <div class="col-md-10 pt-2" style="margin: auto;">
        @if(\Auth::user()->user_access_id == 1)
            @foreach(get_menu(\Auth::user()->user_access_id) as $menu)
                <h4>{{$menu['name']}}</h4>
                <div class="row clearfix mt-3">
                @if(isset($menu['sub_menu']))
                    @foreach($menu['sub_menu'] as $sub)
                        <div class="col-lg-2 col-md-2 col-sm-12 px-1" onclick="window.open('{{route($sub->link)}}','_self')">
                            <div class="card ng-star-inserted text-center" style="height:200px;border:1px solid #eee">
                                <div class="body clearfix">
                                    <div class="content3">
                                        <h6>{{$sub->name}}</h6>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    @if($sub->icon)
                                    <img src="{{$sub->icon}}" class="ml-3" style="width: 45%;" />
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                </div>
            @endforeach
        @else

            @if(!isset($_GET['company_id']) and !isset($_GET['menu']))
                <div class="home row">
                    <div class="item col-md-3 is_hover {{$company_id==2 ? 'active_hover' : ''}}" wire:click="$set('company_id',2)">
                        <a href="javascript:void(0)" title="PT Putra Mulia Telecommunication">
                            <img class="pmt" src="{{asset('images/pmt-logo.png')}}">
                        </a>
                    </div>
                    <div class="item col-md-3 is_hover {{$company_id==1 ? 'active_hover' : ''}}" wire:click="$set('company_id',1)">
                        <a href="javascript:void(0)" title="Harapan Utama Prima">
                            <img class="hup" src="{{asset('images/hup.png')}}">
                        </a>
                    </div>
                    <div class="col-md-6 item item-department">
                        <div class="row">
                            @foreach(\App\Models\Department::get() as $dep)
                                <div class="sub-item col-md-4" title="{{$dep->name}}" wire:click="set_department({{$dep->id}})" onclick="show_left_menu({{$dep->id}})">
                                    @if($dep->icon)
                                        <img src="{{$dep->icon}}" class="ml-3 mb-2" style="width: 30%;margin-top:20px;" />
                                    @endif
                                    <p>{{$dep->name}}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            @if(isset($_GET['company_id']) and !isset($_GET['department_id']))
                <h5 class="text-info"><a href="javascript:void();" class="text-info mr-1" style="font-size:20px;" onclick="history.back()"><i class="fa fa-arrow-left mr-1" title="Back"></i></a> {{isset($_GET['company_name']) ? $_GET['company_name'] : ''}}</h5>
                <div class="row clearfix mt-3">
                    @foreach(\App\Models\Department::get() as $dep)
                        <div class="col-lg-2 col-md-2 col-sm-12 px-1" onclick="window.open('{{route('home',['company_id'=>$_GET['company_id'], 'department_name'=>$dep->name,'department_id'=>$dep->id])}}','_self')">
                            <div class="card ng-star-inserted text-center" style="height:200px;border:1px solid #eee">
                                <div class="body clearfix">
                                    <div class="content3">
                                        <h6>{{$dep->name}}</h6>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    @if($dep->icon)
                                        <a href="{{route('home',['company_id'=>$_GET['company_id'], 'department_name'=>$dep->name,'department_id'=>$dep->id])}}"><img src="{{$dep->icon}}" style="width: 45%;" /></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            @if(isset($_GET['company_id']) and isset($_GET['department_id']) and !isset($_GET['menu']))
                <h5 class="text-info"><a href="javascript:void();" class="text-info" style="font-size:20px;" onclick="history.back()"><i class="fa fa-arrow-left mr-2" title="Back"></i></a> {{isset($_GET['department_name']) ? $_GET['department_name'] : ''}}</h5>
                <div class="row clearfix mt-3">
                    @foreach(\App\Models\Module::select('modules.*')->join('client_projects','client_projects.id','=','modules.client_project_id')
                    ->where(['department_id'=>$_GET['department_id']])->groupBy('client_project_id')->where(function($table){
                    if(session()->get('company_id')) $table->where('client_projects.company_id',session()->get('company_id'));
                })->get() as $menu)
                        @php($sub_menu = \App\Models\Module::where(['department_id'=>$_GET['department_id'],'client_project_id'=>$menu->client_project_id])->get())
                        @if($sub_menu->count() > 1 )
                            @foreach($sub_menu as $sub)
                            <div class="col-lg-2 col-md-2 col-sm-12 px-1">
                                <div class="card ng-star-inserted text-center" style="height:200px;border:1px solid #eee">
                                    <div class="body clearfix" style="min-height: 78px;">
                                        <div class="content3">
                                            <h6><a style="color:#444" href="{{route('home',['menu'=>$sub->id,'company_id'=>$_GET['company_id'],'department_id'=>$_GET['department_id']])}}">{{isset($sub->client_project->name) ? $sub->client_project->name : ''}} - {{$sub->name }}</a></h6>
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                        @if($sub->icon)
                                            <a href="{{route('home',['menu'=>$sub->id,'company_id'=>$_GET['company_id'],'department_id'=>$_GET['department_id']])}}"><img src="{{$sub->icon}}" style="width: 45%;" /></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="col-lg-2 col-md-2 col-sm-12 px-1">
                                <div class="card ng-star-inserted text-center" style="height:200px;border:1px solid #eee">
                                    <div class="body clearfix" style="min-height: 78px;">
                                        <div class="content3">
                                            <a style="color:#444" href="{{route('home',['menu'=>$menu->id,'company_id'=>$_GET['company_id'],'department_id'=>$_GET['department_id']])}}"><h6>{{isset($menu->client_project->name) ? $menu->client_project->name : ''}}</h6></a>
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                        @if($menu->icon)
                                            <a href="{{route('home',['menu'=>$menu->id,'company_id'=>$_GET['company_id'],'department_id'=>$_GET['department_id']])}}"><img src="{{$menu->icon}}" style="width: 45%;" /></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        
            @if(isset($_GET['menu']))
                @foreach(\App\Models\ModulesItem::where('module_id',$_GET['menu'])->whereNotNull('module_group_id')->groupBy('module_group_id')->get() as $group)
                    <h5 class="text-info"><a href="javascript:void();" class="text-info" style="font-size:20px;" onclick="history.back()"><i class="fa fa-arrow-left" title="Back"></i></a> {{$group->group->name}}</h5>
                    <div class="row clearfix mt-3">
                        @foreach(\App\Models\ModulesItem::where(['module_id'=>$_GET['menu'],'module_group_id'=>$group->module_group_id])->get() as $action)
                            @if($action->is_have_sub_menu==1)
                                <div class="col-lg-2 col-md-2 col-sm-12 px-1" x-data="{show_sub_menu:false}">
                                    <div class="card ng-star-inserted text-center" style="height:200px;border:1px solid #eee">
                                        <div class="body clearfix" x-on:click="show_sub_menu = ! show_sub_menu" style="min-height: 78px;">
                                            <div class="content3">
                                                <h6>{{$action->name}}</h6>
                                            </div>
                                        </div>
                                        <div class="clearfix" x-on:click="show_sub_menu = ! show_sub_menu">
                                            @if($action->icon)
                                                <template x-if="!show_sub_menu">
                                                    <img src="{{$action->icon}}" class="ml-3" style="width: 45%;" />
                                                </template>
                                            @endif
                                        </div>
                                        <ul x-show="show_sub_menu" class="list-unstyled feeds_widget text-left">
                                            @foreach(\App\Models\ModulesItem::where(['parent_id'=>$action->id])->get() as $sub)
                                                <li><i class="fa {{$sub->icon}}"></i> <a href="{{route($sub->link)}}">{{$sub->name}}</a></li>
                                            @endforeach
                                            </ul>
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-2 col-md-2 col-sm-12 px-1" onclick="window.open('{{route($action->link)}}','_blank')">
                                    <div class="card ng-star-inserted text-center" style="height:200px;border:1px solid #eee">
                                        <div class="body clearfix" style="min-height: 78px;">
                                            <div class="content3">
                                                <h6>{{$action->name}}</h6>
                                            </div>
                                        </div>
                                        <div class="clearfix">
                                            @if($action->icon)
                                                <img src="{{$action->icon}}" class="ml-3" style="width: 45%;" />
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            @endif
        @endif
    </div>
</div>
@push('after-scripts')
<script>
    function show_left_menu(id){
        if($('body').hasClass('layout-fullwidth')){
            $(".btn-toggle-fullwidth").trigger('click');
        }
    }
    function close_left_menu(){
        $(".btn-toggle-fullwidth").trigger('click');
    }
    Livewire.on('update-menu',()=>{
        $('.metismenu').metisMenu({
            toggle: false
        });
    });
</script>
@endpush
<style>
    body {
        background: url('{{asset('images/bg-home.jpg')}}') !important;
        background-size: 300% !important;
        background-repeat: no-repeat !important;
    }
    .home {
        display: flex;
        flex-wrap: wrap;
        text-align: center;
        margin-top:20%;
    }
    .home .item{
        cursor:pointer;
        border-radius: 5px;
    }
    .home .is_hover:hover {
        border:3px solid#91da91;
    }
    .home .active_hover {
        border:3px solid#91da91 !important;
    }
    .home .item {
        border: 1px solid #d6d0d0;
        height: 280px;
        width: 280px;
        /* margin-right: 10px; */
    }
    .home .item img.hup {
        height: 80px;
        margin-top: 30%;
    }
    .home .item img.pmt {
        margin-top: 35%;
    }
    .home .item-department {
        display: flex;
        flex-wrap: wrap;
        border:0px;
    }
    .home .item-department .sub-item:hover{
        border:2px solid#91da91 !important;
        cursor:pointer;
    }
    .home .item-department .sub-item {
        border: 1px solid #d6d0d0;
        height: 140px;
        /* width: 160px; */ 
        /* margin-right: 5px; */
        flex: 1 0 33%; /* explanation below */
    }

    /* If the screen size is 600px or less, set the font-size of <div> to 30px */
    @media only screen and (max-width: 600px) {
        .home {
            margin-top:0;
        }
    }
    /* h4 {color:white;}*/
    body{
        /* background-image: linear-gradient(white, rgba(110,204,223,1)); */
        background:white;
        /* background: rgb(110,204,223); */
        /* background: linear-gradient(90deg, rgba(110,204,223,1) 0%, rgba(44,109,175,1) 100%); */
    } 
    .card {
        border-radius:0;
    }
    .center {
        display: flex;
        justify-content: center;
        align-items: center;
        /* height: 200px; */
        /* border: 3px solid green; */
    }
</style>