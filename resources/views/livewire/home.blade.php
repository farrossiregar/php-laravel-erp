@section('title', 'Dashboard')
@section('parentPageTitle', 'Dashboard')

<div class="row clearfix">
    @foreach(\App\Models\Module::orderBy('name','ASC')->get() as $menu)
    <div class="col-lg-3 col-md-3 col-sm-12">
        <div class="card appliances-grp ng-star-inserted" style="min-height:250px;">
            <div class="body clearfix">
                <div class="icon" style="font-size:50px;{{$menu->color?'color:'.$menu->color:''}}">
                    @if($menu->icon)
                        <i class="fa fa-{{$menu->icon}}"></i>
                    @endif
                </div>
                <div class="content px-3">
                    <h6>{{$menu->name}} <span class="text-success">On</span></h6>
                    <p class="ng-star-inserted">
                        @foreach(\App\Models\ModulesItem::where(['module_id'=>$menu->id,'type'=>1])->get() as $sub)
                        <a href="{{route($sub->link)}}">{{$sub->name}} </a>
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>