<div class="table-responsive">
    <table class="table m-b-0 c_list table-bordered table-dasboard">
        <thead>
            <tr style="background:#eee;">                      
                <th>Project</th>   
                <th>Region</th>   
                <th>Sub Region</th>   
                <th class="text-center">Quantity</th>
                <th class="text-center">Done</th>
                @foreach(config('vars.health_check_status_bekerja') as $field)
                    <th class="text-center">{{$field}}</th>
                @endforeach
                <th class="text-center">Percentage</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $k => $p)
                @php($count_row_project = \App\Models\ClientProjectRegion::where('client_project_id',$p->id)->count())
                @php($region_project = \App\Models\ClientProjectRegion::where('client_project_id',$p->id)->groupBy('region_id')->get())
                @php($show_project=true)
                @foreach($region_project as $key_region => $region)
                    @php($sub_region = \App\Models\ClientProjectRegion::where(['client_project_id'=>$p->id,'region_id'=>$region->region_id])->get())
                    @foreach($sub_region as $key_sub => $sub)
                        <tr>
                            @if($show_project)
                                <td rowspan="{{ $count_row_project}}">{{$p->name}}</td>
                                @php($show_project=false)
                            @endif
                            @if($key_sub==0)
                                @php($count_sub_region = \App\Models\ClientProjectRegion::where(['client_project_id'=>$p->id,'region_id'=>$region->region_id])->count())
                                <td rowspan="{{$count_sub_region}}">{{isset($region->region->region) ? $region->region->region : ''}}</td>
                            @endif
                            <td>{{isset($sub->sub_region->name) ? $sub->sub_region->name : ''}}</td>
                            @php($done = \App\Models\HealthCheck::where(['client_project_id'=>$p->id,'is_submit'=>1,'region_id'=>$region->region_id,'sub_region_id'=>$sub->id])->whereDate('created_at',date('Y-m-d'))->get()->count())
                            @php($qty = \App\Models\HealthCheck::where(['client_project_id'=>$p->id,'region_id'=>$region->region_id,'sub_region_id'=>$sub->id])->whereDate('created_at',date('Y-m-d'))->groupBy('employee_id')->get()->count())
                            @php($persen = @floor($done / $qty * 100))
                            <td class="text-center">{{$qty}}</td>
                            <td class="text-center">{{$done}}</td>
                            @foreach(config('vars.health_check_status_bekerja') as $field)
                                <td class="text-center">{{\App\Models\HealthCheck::where(['client_project_id'=>$p->id,'region_id'=>$region->region_id,'sub_region_id'=>$sub->id])->where('status_bekerja',$field)->whereDate('created_at',date('Y-m-d'))->count()}}</td>
                            @endforeach
                            @if($done ==0) 
                                <td class="bg-danger text-center" style="color:white;">0%</td> 
                            @else
                                @php($persen  = floor($done/$qty*100))
                                @if($persen < 50)
                                    <td class="bg-danger text-center" style="color:white;">{{$persen}}%</td>
                                @elseif($persen >= 50 and $persen <=99)
                                    <td class="bg-warning text-center" style="color:white;">{{$persen}}%</td>
                                @elseif($persen ==100)
                                    <td class="bg-success text-center" style="color:white;">{{$persen}}%</td>
                                @endif
                            @endif
                        </tr>
                    @endforeach
                @endforeach
            @endforeach
        </tbody> 
    </table>
</div>