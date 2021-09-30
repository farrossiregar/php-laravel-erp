<div class="table-responsive">
    <table class="table m-b-0 c_list table-bordered table-dasboard">
        <thead>
            <tr style="background:#eee;">                 
                <th rowspan="2">Project</th>   
                <th rowspan="2" class="text-center">Region</th>
                <th rowspan="2" class="text-center">Sub Region</th>
                @foreach(config('vars.commitment_daily_statement') as $field)
                    <th colspan="5" class="text-center">{{$field}}</th>
                @endforeach
            </tr>
            <tr style="background:#eee;">
                @foreach(config('vars.commitment_daily_statement') as $field)
                <th class="text-center">Done</th>
                <th class="text-center">Not Done</th>
                <th class="text-center">Tidak Bersedia</th>
                <th class="text-center">Grand Total</th>
                <th class="text-center">Percentage</th>
                @endforeach
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
                            @foreach(config('vars.commitment_daily_statement') as $key => $field)
                                @php($done = \App\Models\CommitmentDaily::whereDate('updated_at',date('Y-m-d'))->where(['client_project_id'=> $p->id,'region_id'=>$region->region_id,'sub_region_id'=>$sub->region_cluster_id])->where($key,1)->count())
                                @php($not_done = \App\Models\CommitmentDaily::whereDate('updated_at',date('Y-m-d'))->where(['client_project_id'=> $p->id,'region_id'=>$region->region_id,'sub_region_id'=>$sub->region_cluster_id])->where($key,NULL)->count())
                                @php($tidak_bersedia = \App\Models\CommitmentDaily::whereDate('updated_at',date('Y-m-d'))->where(['client_project_id'=> $p->id,'region_id'=>$region->region_id,'sub_region_id'=>$sub->region_cluster_id])->where($key,2)->count())
                                @php($grand_total = $done+$not_done)
                                <td class="text-center">{{$done}}</td>
                                <td class="text-center">{{$not_done}}</td>
                                <td class="text-center">{{$tidak_bersedia}}</td>
                                <td class="text-center">{{$grand_total}}</td>
                                @if($done ==0) 
                                    <td class="bg-danger text-center" style="color:white;">0%</td> 
                                @else
                                    @php($persentase  = floor($done/$grand_total*100))
                                    @if($persentase < 50)
                                        <td class="bg-danger text-center" style="color:white;">{{$persentase}}%</td>
                                    @elseif($persentase >= 50 and $persentase <=99)
                                        <td class="bg-warning text-center" style="color:white;">{{$persentase}}%</td>
                                    @elseif($persentase ==100)
                                        <td class="bg-success text-center" style="color:white;">{{$persentase}}%</td>
                                    @endif
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                @endforeach    
            @endforeach
        </tbody>
    </table>
</div>