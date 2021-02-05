@section('title', 'Dashboard')
@section('parentPageTitle', 'Dashboard')
<div class="col-md-10 pt-2" style="margin: auto;">
@foreach(\App\Models\Module::orderBy('name','ASC')->where('status',1)->get() as $menu)
    <h4>{{$menu->name}}</h4>    
    <div class="row clearfix mt-3">
        @foreach(\App\Models\ModulesItem::where(['module_id'=>$menu->id,'type'=>1])->get() as $sub)
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
    </div>
@endforeach
</div>
<style>
    h4 {color:white;}
    body{
        background: rgb(110,204,223);
        background: linear-gradient(90deg, rgba(110,204,223,1) 0%, rgba(44,109,175,1) 100%);
    }
    .card {
        border-radius:0;
    }
</style>