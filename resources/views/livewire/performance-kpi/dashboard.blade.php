<div>
    <ul class="nav nav-tabs-new">
        <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#dashboard-daily-commitment">{{ __('Commitment Daily') }}</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#dashboard-health-check">{{ __('Health Check') }}</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#dashboard-vehicle-check">{{ __('Vehicle Check') }}</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#dashboard-ppe-check">{{ __('PPE Check') }}</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tools-check">{{ __('Tools Check') }}</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#speed-warning-alarm">{{ __('Speed Warning Alarm') }}</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#preventive-maintenance">{{ __('Preventive Maintenance') }}</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#drug-test">{{ __('Drug Test') }}</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="dashboard-daily-commitment">
            <div class="table-responsive">
                <table class="table m-b-0 c_list table-bordered table-dasboard">
                    <thead>
                        <tr style="background:#eee;">
                            <th colspan="9" class="text-center">FLM Status Commitment PPE, Safety, BCG</th>
                        </tr>
                        <tr style="background:#eee;">                 
                            <th>Project</th>   
                            <th class="text-center">Region</th>
                            <th class="text-center">Sub Region</th>
                            <th class="text-center">Done</th>
                            <th class="text-center">Not Done</th>
                            <th class="text-center">Grand Total</th>
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
                                @foreach($sub_region as $key_sub =>  $sub)
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
                                        <td class="text-center">0</td>
                                        <td class="text-center">0</td>
                                        <td class="text-center">0</td>
                                        <td class="text-center">0</td>
                                    </tr>
                                @endforeach
                            @endforeach    
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane" id="dashboard-health-check">
            <hr />
            <div class="p-2">
                <h6>Health Check</h6>
            </div>
            <div class="table-responsive">
                <table class="table m-b-0 c_list">
                    <thead>
                        <tr style="background:#eee;">                      
                            <th>Project</th>   
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Done</th>
                            <th class="text-center">Working</th>
                            <th class="text-center">Cuti</th>
                            <th class="text-center">WFH</th>
                            <th class="text-center">Healthy</th>
                            <th class="text-center">Sick</th>
                            <th class="text-center">Traveling</th>
                            <th class="text-center">Positive Interaksi</th>
                            <th class="text-center">Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $k => $p)
                            @php($done = \App\Models\HealthCheck::where(['client_project_id'=>$p->id,'is_submit'=>1])->count())
                            @php($qty = \App\Models\HealthCheck::where(['client_project_id'=>$p->id])->count())
                            @php($persen = @floor($done / $qty * 100))
                            <tr>
                                <td>{{$p->name}}</td>
                                <td class="text-center">{{$qty}}</td>
                                <td class="text-center">{{$done}}</td>
                                <td class="text-center">{{\App\Models\HealthCheck::where('client_project_id',$p->id)->whereIn('status_bekerja',['Bekerja (hadir dikantor)','WFH (Izin)','WFH (Sakit)','WFH (Intruksi Kantor)','WFH (Others)'])->count()}}</td>
                                <td class="text-center">{{\App\Models\HealthCheck::where('client_project_id',$p->id)->whereIn('status_bekerja',['Cuti'])->count()}}</td>
                                <td class="text-center">{{\App\Models\HealthCheck::where('client_project_id',$p->id)->whereIn('status_bekerja',['WFH (Izin)','WFH (Sakit)','WFH (Intruksi Kantor)','WFH (Others)'])->count()}}</td>
                                <td class="text-center">{{\App\Models\HealthCheck::where(['client_project_id'=>$p->id,'kondisi_badan'=>1])->count()}}</td>
                                <td class="text-center">{{\App\Models\HealthCheck::where(['client_project_id'=>$p->id,'kondisi_badan'=>2])->count()}}</td>
                                <td class="text-center">{{\App\Models\HealthCheck::where(['client_project_id'=>$p->id,'bepergian_keluar_kota'=>1])->count()}}</td>
                                <td class="text-center">{{\App\Models\HealthCheck::where(['client_project_id'=>$p->id,'mengunjungi_keluarga'=>1])->count()}}</td>
                                <td class="text-center">
                                    @if($qty and $done)
                                        {{$persen}}
                                    @endif
                                </td>
                            </tr>  
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane" id="dashboard-vehicle-check">
            <div class="table-responsive">
                <table class="table m-b-0 c_list">
                    <thead>
                        <tr style="background:#eee;">                                    
                            <th>Project</th>   
                            <th class="text-center">Region</th>
                            <th class="text-center">Sub Region</th>
                            <th class="text-center">Done</th>
                            <th class="text-center">Not Done</th>
                            <th class="text-center">Stiker Safety Ticked 'Tidak'</th>
                            <th class="text-center">Grand Total</th>
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
                                @foreach($sub_region as $key_sub =>  $sub)
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
                                        <td class="text-center">0</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                    </tr>
                                @endforeach
                            @endforeach    
                        @endforeach
                    </tbody>
                </table>
            </div>
            <style>
                .table-dasboard tr td {
                    padding-top:1px !important;
                    padding-bottom:1px !important;
                }
            </style>
        </div>
    </div>
</div>