@section('title', 'Dashboard')
@section('parentPageTitle', 'Dashboard')

<div class="row clearfix">
    @foreach(\App\Models\Module::orderBy('name','ASC')->get() as $menu)
    <div class="col-lg-3 col-md-3 col-sm-12">
        <div class="card appliances-grp ng-star-inserted">
            <div class="body clearfix">
                <div class="icon" style="font-size:50px;">
                    @if($menu->icon)
                        <i class="fa fa-{{$menu->icon}}"></i>
                    @endif
                </div>
                <div class="content">
                    <h6>{{$menu->name}} <span class="text-success">On</span></h6>
                    <p class="ng-star-inserted">
                        @foreach(\App\Models\ModulesItem::where(['module_id'=>$menu->id,'type'=>1])->get() as $sub)
                        <a href="{{route($sub->link)}}">{{$sub->name}}</a>
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>