<div class="table-responsive">
    <table class="table m-b-0 c_list table-bordered table-dasboard">
        <thead>
            <tr style="background:#eee;">                 
                <th colspan="{{\App\Models\Toolbox::count() + 6}}" class="text-center">Summary Of Tools Check</th>   
            </tr>
            <tr style="background:#eee;">
                <th class="text-center">Project</th>
                <th class="text-center">Region</th>
                <th class="text-center">Sub Region</th>
                <th class="text-center">Total Employee Posisi CME/TE </th>
                <th class="text-center">Done</th>
                @foreach(\App\Models\Toolbox::orderBy('name','ASC')->get() as $tool)
                    <th class="text-center">{{$tool->name}} 'Kondisi Rusak'</th>
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
                                @php($count_sub_region = \App\Models\ClientProjectRegion::where(['client_project_id'=>$p->id,'region_id'=>$region->region_id])->get()->count())
                                <td rowspan="{{$count_sub_region}}">{{isset($region->region->region) ? $region->region->region : ''}}</td>
                            @endif
                            <td>{{isset($sub->sub_region->name) ? $sub->sub_region->name : ''}}</td>
                            @php($done = \App\Models\ToolsCheck::where(['is_submit'=>1,'client_project_id'=> $p->id,'region_id'=>$region->region_id,'sub_region_id'=>$sub->region_cluster_id])->get()->count())
                            @php($grand_total = \App\Models\Employee::whereIn('user_access',[85,84]])->get()->count())
                            <td class="text-center">{{$grand_total}}</td>
                            <td class="text-center">{{$done}}</td> 
                            @foreach(\App\Models\Toolbox::orderBy('name','ASC')->get() as $tool)
                                @php($rusak = \App\Models\ToolboxCheck::where(['status'=>2,'client_project_id'=> $p->id,'region_id'=>$region->region_id,'sub_region_id'=>$sub->region_cluster_id])->get()->count())
                                <td class="text-center">{{$rusak}}</td>
                            @endforeach
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
                        </tr>
                    @endforeach
                @endforeach    
            @endforeach
        </tbody>
    </table>
</div>