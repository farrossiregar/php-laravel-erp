<div class="row">
    <!-- <div class="col-md-2">
        <input type="date" class="form-control" wire:model="date" />
    </div> -->

    <div class="col-md-1">                
        <select class="form-control" wire:model="filteryear">
            <option value=""> --- Year --- </option>
            <option value="2021">2021</option>
            <option value="2020">2020</option>
            <option value="2019">2019</option>
            <option value="2018">2018</option>
            <option value="2017">2017</option>
        </select>
    </div>
    <div class="col-md-2" wire:ignore>
        <select class="form-control" style="width:100%;" wire:model="filtermonth">
            <option value=""> --- Month --- </option>
            @for($i = 1; $i <= 12; $i++)
                <option value="{{$i}}">{{date('F', mktime(0, 0, 0, $i, 10))}}</option>
            @endfor
        </select>
    </div>
    <div class="col-md-2" wire:ignore>
        <select class="form-control" style="width:100%;" wire:model="filterproject">
            <option value=""> --- Project --- </option>
            @foreach(\App\Models\ClientProject::orderBy('id', 'desc')
                                ->where('company_id', Session::get('company_id'))
                                ->where('is_project', '1')
                                ->get() as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2" wire:ignore>
        <select class="form-control" style="width:100%;" wire:model="filterovertime">
            <option value=""> --- Overtime --- </option>
            <option value="1">Overtime</option>
            <option value="">All</option>
        </select>
    </div>


    @if(check_access('team-schedule.toc-leader'))
    <!-- <div class="col-md-1" style="margin: 0 10px;">
        <a href="javascript:;" wire:click="$emit('modaladdteamschedule')" class="btn btn-info"><i class="fa fa-plus"></i> Team Schedule </a>
    </div> -->

    <div class="col-md-1" style="margin: 0 10px;">
        <a href="javascript:;" wire:click="$emit('modalimportplan')" class="btn btn-info"><i class="fa fa-upload"></i> Plan Schedule </a>
    </div>
    
    <div class="col-md-1" style="margin: 0 10px;">
        <a href="javascript:;" wire:click="$emit('modalimportactual')" class="btn btn-info"><i class="fa fa-upload"></i> Actual Schedule </a>
    </div>

    <!-- <div class="col-md-1" style="margin: 0 10px;">
        <a href="javascript:;" wire:click="$emit('modalgeneratetimesheet')" class="btn btn-info"><i class="fa fa-download"></i> Generate Timesheet </a>
    </div> -->
    
    @endif


    
    
    
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped table-bordered m-b-0 c_list">
                <thead>
                    <tr>
                        <th rowspan="2" class="align-middle">No</th>
                        <th rowspan="2" class="align-middle">Status</th> 
                        <th rowspan="2" class="align-middle">Date Create</th>
                        <th rowspan="2" class="align-middle">Timesheet</th>
                        <th rowspan="2" class="align-middle">Employee Name</th> 
                        <!-- <th rowspan="2" class="align-middle">NIK</th>  -->
                        <!-- <th rowspan="2" class="align-middle">Company Name</th>  -->
                        <th rowspan="2" class="align-middle">Project</th> 
                        <th rowspan="2" class="align-middle">Region</th> 
                        <th colspan="3" class="text-center align-middle"><b style="color: #de4848;">Plan Schedule</b></th>
                        <th colspan="3" class="text-center align-middle"><b style="color: #22af46;">Actual Schedule</b></th> 
                        <th rowspan="2" class="align-middle">Overtime</th> 
                    </tr>
                    <tr>
                        
                        <th><b style="color: #de4848;">Start</b> </th> 
                        <th><b style="color: #de4848;">End</b></th> 
                        <th>Action</th> 
                        <th><b style="color: #22af46;">Start</b></th> 
                        <th><b style="color: #22af46;">End</b></th> 
                        <th>Action</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <?php
                        $diff = abs(strtotime(date_format(date_create($item->end_actual), 'Y-m-d H:i:s')) - strtotime(date_format(date_create($item->end_schedule), 'Y-m-d H:i:s')));
                        $years   = floor($diff / (365*60*60*24)); 
                        $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
                        $days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                        $hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
                        $minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 
                
                        $waktu = '';
                        if($hours > 0){
                            $waktu .= $hours.' hr ';
                        }else{
                            $waktu .= '';
                        }
                
                        if($minuts > 0){
                            $waktu .= $minuts.' min ';
                        }else{
                            $waktu .= '';
                        }

                    ?>
                    
                    <?php
                        if($filterovertime == '1'){
                            if($item->overtime != '1'){
                                continue;
                            }
                        }
                    ?>

                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <a href="javascript:;" wire:click="$emit('modalapprovalhistoryteamschedule','{{ $item->id }}')">
                                @if($item->status == '2')
                                    <label class="badge badge-success" data-toggle="tooltip" title="Actual Schedule Approved">Actual Schedule Approved</label>
                                @endif

                                @if($item->status == '1')
                                    <label class="badge badge-success" data-toggle="tooltip" title="Plan Schedule Approved">Plan Schedule Approved</label>
                                @endif

                                @if($item->status == '0')
                                    <label class="badge badge-danger" data-toggle="tooltip" title="Decline">Team Schedule is Decline</label>
                                @endif

                                @if($item->status == '' || $item->status == 'null')
                                    <label class="badge badge-warning" data-toggle="tooltip" title="Waiting to Approve">Waiting to Approve</label>
                                @endif

                                
                            </a>

                        </td> 
                        <td>{{ date_format(date_create($item->created_at), 'd M Y') }}</td>
                        <td style="text-align: center;">
                            @if($item->overtime == '1')
                                <a href="javascript:;" wire:click="generateusertimesheetpdf({{ $item->nik }}, '{{ $filteryear }}', '{{ $filtermonth }}')"><i class="fa fa-download"></i></a>
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <b>{{ $item->name }}</b>
                            <br>
                            {{ $item->nik }}
                        </td>
                        
                        <!-- <td>
                            @if($item->company_name == '1')
                                HUP
                            @else
                                PMT
                            @endif
                        </td> -->
                        <td>{{ get_project_company($item->project, $item->company_name) }}</td>
                        <td>{{$item->region}}</td>
                        <td>{{ date_format(date_create($item->start_schedule), 'H:i d M Y') }}</td>
                        <td>{{ date_format(date_create($item->end_schedule), 'H:i d M Y') }}</td>
                        <td>
                            @if(check_access('team-schedule.noc-manager'))
                                @if($item->status == '')
                                   
                                    <a href="javascript:;" wire:click="$emit('modalapproveteamschedule',['{{ $item->id }}', '1'])"><i class="fa fa-check " style="color: #22af46;"></i></a>
                                    <a href="javascript:;" wire:click="$emit('modaldeclineteamschedule',['{{ $item->id }}', '1'])"><i class="fa fa-close " style="color: #de4848;"></i></a>
                                @endif

                            @endif

                            @if(check_access('team-schedule.toc-leader'))
                                @if($item->status == '0')
                                <a href="javascript:;" wire:click="$emit('modaleditteamschedule','{{ $item->id }}')"><i class="fa fa-edit " style="color: #f3ad06;"></i></a>
                                    
                                @endif
                            @endif
                        </td>
                        <td>{{ isset($item->start_actual) ? date_format(date_create($item->start_actual), 'H:i d M Y') : '' }}</td>
                        <td>{{ isset($item->end_actual) ? date_format(date_create($item->end_actual), 'H:i d M Y') : '' }}</td>
                        
                        <td>
                            @if(check_access('team-schedule.noc-manager'))
                                @if($item->status == '1')
                                   
                                    <a href="javascript:;" wire:click="$emit('modalapproveteamschedule',['{{ $item->id }}', '2'])"><i class="fa fa-check " style="color: #22af46;"></i></a>
                                    <a href="javascript:;" wire:click="$emit('modaldeclineteamschedule',['{{ $item->id }}', '2'])"><i class="fa fa-close " style="color: #de4848;"></i></a>
                                @endif

                            @endif

                            <!-- if(check_access('petty-cash.add')) -->
                                @if($item->status == '0')
                                <!-- <a href="javascript:;" wire:click="$emit('modalrevisipettycash','{{ $item->id }}')"><i class="fa fa-edit " style="color: #f3ad06;"></i></a> -->
                                    
                                @endif
                            <!-- endif -->
                        </td>
                        <td>
                            <?php
                                if($item->end_actual){
                                    
                                    echo '<b>'.$waktu.'</b>';
                                }
                            ?>
                        </td>
                       
                    </tr>
                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>