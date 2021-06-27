@section('title', 'Dashboard')
@section('parentPageTitle', 'Home')
<div class="col-md-10 pt-2" style="margin: auto;">
    @if(!isset($_GET['company_id']))
        <div class="row clearfix mt-3 text-center">
            <div class="col-12 mb-5 mt-5">
                <h1 class="animate__animated animate__delay-2s animate__fadeInDown">Welcome, {{\Auth::user()->name}}</h1>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 px-1">
                <div class="card ng-star-inserted" style="float:right; width:50% !important;flex:0 0 30%;margin:auto;height:200px;border:1px solid #eee;">
                    <div class="body clearfix">
                        <div class="content3">
                            <a href="{{route('home',['company_id'=>2,'company_name'=>'PT Putra Mulia Telecommunication'])}}"><img src="{{asset('images/pmt-logo.png')}}" style="margin-top:50px"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 px-1">
                <div class="card ng-star-inserted" style="float:left; width:50% !important;flex:0 0 30%;margin:auto;height:200px;border:1px solid #eee;">
                    <div class="body clearfix">
                        <div class="content3">
                            <a href="{{route('home',['company_id'=>1,'company_name'=>'Harapan Utama Prima'])}}"><img src="{{asset('images/hup.png')}}" style="height:80px;margin-top:32px"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(isset($_GET['company_id']) and !isset($_GET['department_id']))
        <h4 class="text-info">{{isset($_GET['company_name']) ? $_GET['company_name'] : ''}}</h4>
        <div class="row clearfix mt-3">
            @foreach(\App\Models\Department::get() as $dep)
                <div class="col-lg-2 col-md-2 col-sm-12 px-1">
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

    @if(isset($_GET['company_id']) and isset($_GET['department_id']))
        <h4 class="text-info">{{isset($_GET['department_name']) ? $_GET['department_name'] : ''}}</h4>
        <div class="row clearfix mt-3">
            @foreach(\App\Models\Module::select('modules.*')->join('client_projects','client_projects.id','=','modules.client_project_id')
            ->where(['department_id'=>$_GET['department_id']])->groupBy('client_project_id')->where(function($table){
            if(session()->get('company_id')) $table->where('client_projects.company_id',session()->get('company_id'));
        })->get() as $menu)
                <div class="col-lg-2 col-md-2 col-sm-12 px-1">
                    <div class="card ng-star-inserted text-center" style="height:200px;border:1px solid #eee">
                        <div class="body clearfix" style="min-height: 86px;">
                            <div class="content3">
                                <h6>{{isset($menu->client_project->name) ? $menu->client_project->name : ''}}</h6>
                            </div>
                        </div>
                        <div class="clearfix">
                            @if($menu->icon)
                                <a href="href="{{route('home',['menu'=>$menu->id])}}""><img src="{{$menu->icon}}" style="width: 45%;" /></a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    
    @if(!isset($_GET['company_id']))
        {{-- @foreach(\App\Models\Department::get() as $dep)
        <li class="dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle icon-menu text-info px-1" data-toggle="dropdown">{{$dep->name}}</a>
            <ul class="dropdown-menu user-menu menu-icon">
                @foreach(\App\Models\Module::select('modules.*')->join('client_projects','client_projects.id','=','modules.client_project_id')
                    ->where(['department_id'=>$dep->id])->groupBy('client_project_id')->where(function($table){
                    if(session()->get('company_id')) $table->where('client_projects.company_id',session()->get('company_id'));
                })->get() as $menu)
                    <li><a href="{{route('home',['menu'=>$menu->id])}}">{{isset($menu->client_project->name) ? $menu->client_project->name : ''}}</a></li>
                    @php($sub_menu = \App\Models\Module::where(['department_id'=>$dep->id,'client_project_id'=>$menu->client_project_id])->get())
                    @if($sub_menu->count() > 1 )
                        <ul>
                            @foreach($sub_menu as $sub)
                                <li class="py-1"><a href="{{route('home',['menu'=>$sub->id])}}" style="color:white;">{{isset($sub->name) ? $sub->name : ''}}</a></li>
                            @endforeach
                        </ul>
                    @endif
                @endforeach
            </ul>
        </li>
        @endforeach --}}
    @endif

    @if(isset($_GET['menu']))
        @foreach(\App\Models\ModulesItem::where('module_id',$_GET['menu'])->whereNotNull('module_group_id')->groupBy('module_group_id')->get() as $group)
            <h4>{{$group->group->name}}</h4>
            <div class="row clearfix mt-3">
                @foreach(\App\Models\ModulesItem::where(['module_id'=>$_GET['menu'],'module_group_id'=>$group->module_group_id])->get() as $action)
                    @if(check_access($action->link))
                    <div class="col-lg-2 col-md-2 col-sm-12 px-1" onclick="window.open('{{route($action->link)}}','_blank')">
                        <div class="card ng-star-inserted" style="height:200px">
                            <div class="body clearfix">
                                <div class="content3">
                                    <h5>{{$action->name}}</h5>
                                    <p class="ng-star-inserted">{{$action->id}}</p>
                                </div>
                            </div>
                            @if($action->icon)
                            <img src="{{$action->icon}}" class="ml-3" style="height: 50px;position:absolute;bottom:40px;" />
                            @endif
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        @endforeach
        
    {{-- @else
        @foreach(get_menu(\Auth::user()->user_access_id) as $menu)
            <h4>{{$menu['name']}}</h4>
            <div class="row clearfix mt-3">
            @if(isset($menu['sub_menu']))
            @foreach($menu['sub_menu'] as $sub)
                <div class="col-lg-2 col-md-2 col-sm-12 px-1" onclick="window.open('{{route($sub->link)}}','_blank')">
                    <div class="card ng-star-inserted" style="height:200px">
                        <div class="body clearfix">
                            <div class="content3">
                                <h5>{{$sub->name}}</h5>
                                <p class="ng-star-inserted">{{$sub->id}}</p>
                            </div>
                        </div>
                        @if($sub->icon)
                        <img src="{{$sub->icon}}" class="ml-3" style="height: 50px;position:absolute;bottom:40px;" />
                        @endif
                    </div>
                </div>
            @endforeach
            @endif
            </div>
        @endforeach --}}
        
    @endif
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<style>
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