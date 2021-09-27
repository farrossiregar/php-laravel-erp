<div class="table-responsive">
    <table class="table m-b-0 c_list table-bordered table-dasboard">
        <thead>
            <tr style="background:#eee;">                                    
                <th>Project</th>   
                <th class="text-center">Region</th>
                <th class="text-center">Sub Region</th>
                <th class="text-center">Total Number Of Employee Posisi CME/TE  Only</th>
                <th class="text-center">Total Number Of Employee Posisi CME/TE  Only Overspeeding</th>
                <th class="text-center">Count Of Overspeeding</th>
                <th class="text-center">Number Of Days</th>
                <th class="text-center">Percentage Of Employee Overspeeding</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $k => $p)
                @php($count_row_project = \App\Models\ClientProjectRegion::where('client_project_id',$p->id)->count())
                @php($region_project = \App\Models\ClientProjectRegion::where('client_project_id',$p->id)->groupBy('region_id')->get())
                @php($show_project=true)
                @foreach($region_project as $key_region => $region)
                    @php($sub_region = \App\Models\ClientProjectRegion::where(['client_project_id'=>$p->id,'region_id'=>$region->region_id])->get())
                    @foreach($sub_region as $key_sub =>  $sub)
                        <tr>
                            @if($show_project)
                                <td rowspan="{{ $count_row_project }}">{{$p->name}}</td>
                                @php($show_project=false)
                            @endif
                            @if($key_sub==0)
                                @php($count_sub_region = \App\Models\ClientProjectRegion::where(['client_project_id'=>$p->id,'region_id'=>$region->region_id])->count())
                                <td rowspan="{{$count_sub_region}}">{{isset($region->region->region) ? $region->region->region : ''}}</td>
                            @endif
                            @php($employee = \App\Models\Employee::whereIn('employee_position',['CME Engineer','TE Engineer'])->where(['region_id'=>$region->region_id,'sub_region_id'=>$sub->region_cluster_id])->count())
                            @php($total = \App\Models\SpeedWarningAlarm::where(['client_project_id'=>$p->id,'region_id'=>$region->region_id,'sub_region_id'=>$sub->region_cluster_id])->count())
                            @php($count = \App\Models\SpeedWarningAlarm::where(['client_project_id'=>$p->id,'region_id'=>$region->region_id,'sub_region_id'=>$sub->region_cluster_id])->groupBy('employee_id')->count())
                            <td>{{isset($sub->sub_region->name) ? $sub->sub_region->name : ''}}</td>
                            <td class="text-center">{{$employee}}</td>
                            <td class="text-center">{{$total}}</td>
                            <td class="text-center">{{$count}}</td>
                            <td class="text-center"></td>
                            @if($total ==0) 
                                <td class="bg-success text-center" style="color:white;">0%</td> 
                            @else
                                @php($persentase  = floor($total/$employee*100))
                                @if($persentase < 50)
                                    <td class="bg-success text-center" style="color:white;">{{$persentase}}%</td>
                                @elseif($persentase >= 50 and $persentase <=99)
                                    <td class="bg-warning text-center" style="color:white;">{{$persentase}}%</td>
                                @elseif($persentase ==100)
                                    <td class="bg-danger text-center" style="color:white;">{{$persentase}}%</td>
                                @endif
                            @endif
                        </tr>
                    @endforeach
                @endforeach    
            @endforeach
        </tbody>
    </table>
</div>