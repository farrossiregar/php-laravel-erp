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
                                @php($all_status = \App\Models\CommitmentDaily::from('commitment_dailys','cd')->select(
                                        \DB::raw("(SELECT count(*) FROM commitment_dailys where date(commitment_dailys.updated_at)=date(cd.updated_at) and {$key}=1 and client_project_id=cd.client_project_id and region_id=cd.region_id and sub_region_id=cd.sub_region_id) as done"),
                                        \DB::raw("(SELECT count(*) FROM commitment_dailys where date(commitment_dailys.updated_at)=date(cd.updated_at) and {$key} is null and client_project_id=cd.client_project_id and region_id=cd.region_id and sub_region_id=cd.sub_region_id) as not_done"),
                                        \DB::raw("(SELECT count(*) FROM commitment_dailys where date(commitment_dailys.updated_at)=date(cd.updated_at) and {$key}=2 and client_project_id=cd.client_project_id and region_id=cd.region_id and sub_region_id=cd.sub_region_id) as tidak_bersedia")
                                    )->whereDate('updated_at',date('Y-m-d'))->where(['client_project_id'=> $p->id,'region_id'=>$region->region_id,'sub_region_id'=>$sub->region_cluster_id])->first())

                                @php($grand_total = (isset($all_status->done)?$all_status->done:0)+(isset($all_status->not_done)?$all_status->not_done:0))
                                <td class="text-center">{{isset($all_status->done)?$all_status->done:0}}</td>
                                <td class="text-center">{{isset($all_status->not_done)?$all_status->not_done:0}}</td>
                                <td class="text-center">{{isset($all_status->tidak_bersedia)?$all_status->tidak_bersedia:0}}</td>
                                <td class="text-center">{{$grand_total}}</td>
                                @if(isset($all_status->done) and $all_status->done ==0) 
                                    <td class="bg-danger text-center" style="color:white;">0%</td> 
                                @else
                                    @php($persentase  = @floor($all_status->done/$grand_total*100))
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