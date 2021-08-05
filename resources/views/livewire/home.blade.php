@section('title', 'Dashboard')
@section('parentPageTitle', 'Home')
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
                                    {{-- <p class="ng-star-inserted">{{$sub->id}}</p> --}}
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