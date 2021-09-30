<div class="table-responsive">
    <table class="table m-b-0 c_list table-bordered table-dasboard">
        <thead>
            <tr style="background:#eee;">                 
                <th colspan="10" class="text-center">Summary Of PPE Check</th>   
            </tr>
            <tr style="background:#eee;">
                <th class="text-center">Project</th>
                <th class="text-center">Region</th>
                <th class="text-center">Sub Region</th>
                <th class="text-center">Total Employee Posisi CME/TE </th>
                <th class="text-center">Done</th>
                <th class="text-center">Not Done</th>
                <th class="text-center">Karyawan dgn PPE 'Tidak Lengkap'</th>
                <th class="text-center">Photo Banner 'Tidak Lengkap'</th>
                <th class="text-center">Photo Sertifikasi WAH, Elektrikal dan First Aid 'Photo Tidak Lengkap'</th>
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
                                @php($done = \App\Models\PpeCheck::whereDate('updated_at',date('Y-m-d'))->where(['is_submit'=>1,'client_project_id'=> $p->id,'region_id'=>$region->region_id,'sub_region_id'=>$sub->region_cluster_id])->count())
                                @php($not_done = \App\Models\PpeCheck::whereDate('updated_at',date('Y-m-d'))->where(['is_submit'=>0,'client_project_id'=> $p->id,'region_id'=>$region->region_id,'sub_region_id'=>$sub->region_cluster_id])->count())
                                @php($tidak_lengkap = \App\Models\PpeCheck::whereDate('updated_at',date('Y-m-d'))->where(['ppe_lengkap'=>0,'client_project_id'=> $p->id,'region_id'=>$region->region_id,'sub_region_id'=>$sub->region_cluster_id])->count())
                                @php($banner_tidak_lengkap = \App\Models\PpeCheck::whereDate('updated_at',date('Y-m-d'))->where(['banner_lengkap'=>0,'client_project_id'=> $p->id,'region_id'=>$region->region_id,'sub_region_id'=>$sub->region_cluster_id])->count())
                                @php($sertifikasi_tidak_lengkap = \App\Models\PpeCheck::whereDate('updated_at',date('Y-m-d'))->whereNotNull('sertifikasi_alasan_tidak_lengkap')->where(['client_project_id'=> $p->id,'region_id'=>$region->region_id,'sub_region_id'=>$sub->region_cluster_id])->count())
                                @php($grand_total = $done+$not_done)
                                <td class="text-center">{{$grand_total}}</td>
                                <td class="text-center">{{$done}}</td>
                                <td class="text-center">{{$not_done}}</td>
                                <td class="text-center">{{$tidak_lengkap}}</td>
                                <td class="text-center">{{$banner_tidak_lengkap}}</td>
                                <td class="text-center">{{$sertifikasi_tidak_lengkap}}</td>
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