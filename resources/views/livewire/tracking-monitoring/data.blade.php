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


    <!-- if(check_access('petty-cash.add')) -->
    <!-- <div class="col-md-2">
        <a href="javascript:;" wire:click="$emit('modaladdteamschedule')" class="btn btn-info"><i class="fa fa-plus"></i> Team Schedule </a>
    </div>
    
    <div class="col-md-2">
        <a href="javascript:;" wire:click="$emit('modalimportactual')" class="btn btn-info"><i class="fa fa-upload"></i> Actual Schedule </a>
    </div>

    <div class="col-md-2">
        <a href="javascript:;" wire:click="$emit('modalgeneratetimesheet')" class="btn btn-info"><i class="fa fa-download"></i> Generate Timesheet </a>
    </div>
     -->
    <!-- endif -->


    
    
    
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>

                    <tr>
                        <th>No</th> 
                        <th>Status</th> 
                        <th>Month</th>
                        <th>Generate Timesheet</th>
                        <th>Project</th> 
                        <th>Region</th> 
                        <th>Action</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                             
                        <?php
                                $status_approve = \App\Models\TimesheetRecord::where('region', $item->region)
                                                                                ->where('company_name', 2)
                                                                                ->where('project', $item->project)
                                                                                ->where('month', date_format(date_create($item->created_at), 'm'))
                                                                                ->where('year', date_format(date_create($item->created_at), 'Y'))
                                                                                ->first();
                            ?>
                            @if($status_approve)
                                @if($status_approve->status == '4')
                                    <label class="badge badge-success" data-toggle="tooltip" title="Approved By HRD">Approved By HRD</label>
                                @endif

                                @if($status_approve->status == '3')
                                    <label class="badge badge-success" data-toggle="tooltip" title="Approved By NOC Manager">Approved By NOC Manager</label>
                                @endif


                                @if($status_approve->status == '2')
                                    <label class="badge badge-success" data-toggle="tooltip" title="Approved By NOC Team">Approved By NOC Team</label>
                                @endif

                                @if($status_approve->status == '1')
                                    <label class="badge badge-success" data-toggle="tooltip" title="Approved By TOC Leader">Approved By TOC Leader</label>
                                @endif

                                <!-- @if($item->status == '0')
                                    <label class="badge badge-danger" data-toggle="tooltip" title="{{$item->note}}">Team Schedule is Decline</label>
                                @endif -->

                                @if($status_approve->status == '' || $status_approve->status == 'null')
                                    <label class="badge badge-warning" data-toggle="tooltip" title="Waiting to Approve">Waiting to Approve</label>
                                @endif
                            @else
                                <label class="badge badge-warning" data-toggle="tooltip" title="Waiting to Approve">Waiting to Approve</label>
                            @endif

                        </td> 
                        <td>{{ date_format(date_create($item->created_at), 'M Y') }}</td>
                        <td><a href="#" wire:click="generatetimesheet({{$item->project}}, 2, {{date_format(date_create($item->created_at), 'm')}}, {{date_format(date_create($item->created_at), 'Y')}}, {{@\App\Models\Region::where('region_code', $item->region)->first()->id}})"><i class="fa fa-download fa-2x" style="color: #007bff;"></i></a></td>

                        <td>{{ get_project_company($item->project, $item->company_name) }}</td>
                        <td>{{$item->region}}</td>
                        
                        <td>
                            <?php
                                $status_approve = \App\Models\TimesheetRecord::where('region', $item->region)
                                                                                ->where('company_name', 2)
                                                                                ->where('project', $item->project)
                                                                                ->where('month', date_format(date_create($item->created_at), 'm'))
                                                                                ->where('year', date_format(date_create($item->created_at), 'Y'))
                                                                                ->first();
                            ?>
                            @if($status_approve)
                                @if($status_approve->status == '') <!-- TOC Leader -->
                                
                                    <a href="javascript:;" wire:click="$emit('modalapprovetimesheetrecord',['{{ $status_approve->id }}', '2', '1', '{{ $item->region }}', '{{ $item->project }}', '{{ date_format(date_create($item->created_at), 'm') }}', '{{ date_format(date_create($item->created_at), 'Y') }}'])"><i class="fa fa-check fa-2x" style="color: #22af46;"></i></a>
                                    <!-- <a href="javascript:;" wire:click="$emit('modaldeclinetimesheetrecord',['{{ $status_approve->id }}', '2', '1', '{{ $item->region }}', '{{ $item->project }}', '{{ date_format(date_create($item->created_at), 'm') }}', '{{ date_format(date_create($item->created_at), 'Y') }}'])"><i class="fa fa-close fa-2x" style="color: #de4848;"></i></a> -->
                                @endif

                                @if($status_approve->status == '1') <!-- NOC Team -->
                                
                                    <a href="javascript:;" wire:click="$emit('modalapprovetimesheetrecord',['{{ $status_approve->id }}', '2', '2', '{{ $item->region }}', '{{ $item->project }}', '{{ date_format(date_create($item->created_at), 'm') }}', '{{ date_format(date_create($item->created_at), 'Y') }}'])"><i class="fa fa-check fa-2x" style="color: #22af46;"></i></a>
                                    <!-- <a href="javascript:;" wire:click="$emit('modaldeclinetimesheetrecord',['{{ $status_approve->id }}', '2', '2', '{{ $item->region }}', '{{ $item->project }}', '{{ date_format(date_create($item->created_at), 'm') }}', '{{ date_format(date_create($item->created_at), 'Y') }}'])"><i class="fa fa-close fa-2x" style="color: #de4848;"></i></a> -->
                                @endif

                                @if($status_approve->status == '2') <!-- NOC Manager -->
                                    
                                    <a href="javascript:;" wire:click="$emit('modalapprovetimesheetrecord',['{{ $status_approve->id }}', '2', '3', '{{ $item->region }}', '{{ $item->project }}', '{{ date_format(date_create($item->created_at), 'm') }}', '{{ date_format(date_create($item->created_at), 'Y') }}'])"><i class="fa fa-check fa-2x" style="color: #22af46;"></i></a>
                                    <!-- <a href="javascript:;" wire:click="$emit('modaldeclinetimesheetrecord',['{{ $status_approve->id }}', '2', '3', '{{ $item->region }}', '{{ $item->project }}', '{{ date_format(date_create($item->created_at), 'm') }}', '{{ date_format(date_create($item->created_at), 'Y') }}'])"><i class="fa fa-close fa-2x" style="color: #de4848;"></i></a> -->
                                @endif

                                @if($status_approve->status == '3') <!-- HRD -->
                                    
                                    <a href="javascript:;" wire:click="$emit('modalapprovetimesheetrecord',['{{ $status_approve->id }}', '2', '4', '{{ $item->region }}', '{{ $item->project }}', '{{ date_format(date_create($item->created_at), 'm') }}', '{{ date_format(date_create($item->created_at), 'Y') }}'])"><i class="fa fa-check fa-2x" style="color: #22af46;"></i></a>
                                    <!-- <a href="javascript:;" wire:click="$emit('modaldeclinetimesheetrecord',['{{ $status_approve->id }}', '2', '4', '{{ $item->region }}', '{{ $item->project }}', '{{ date_format(date_create($item->created_at), 'm') }}', '{{ date_format(date_create($item->created_at), 'Y') }}'])"><i class="fa fa-close fa-2x" style="color: #de4848;"></i></a> -->
                                @endif
                            @else

                                <!-- TOC Leader -->
                                <a href="javascript:;" wire:click="$emit('modalapprovetimesheetrecord',['', '2', '1', '{{ $item->region }}', '{{ $item->project }}', '{{ date_format(date_create($item->created_at), 'm') }}', '{{ date_format(date_create($item->created_at), 'Y') }}'])"><i class="fa fa-check fa-2x" style="color: #22af46;"></i></a>
                                <!-- <a href="javascript:;" wire:click="$emit('modaldeclinetimesheetrecord',['', '2', '1', '{{ $item->region }}', '{{ $item->project }}', '{{ date_format(date_create($item->created_at), 'm') }}', '{{ date_format(date_create($item->created_at), 'Y') }}'])"><i class="fa fa-close fa-2x" style="color: #de4848;"></i></a> -->

                            @endif

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>