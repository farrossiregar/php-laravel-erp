<div class="row">
    <div class="col-md-2">
        <input type="date" class="form-control" wire:model="date" />
    </div>

<!--     
    <div class="col-md-1">                
        <select class="form-control" wire:model="year">
            <option value=""> --- Year --- </option>
            @foreach(\App\Models\EmployeeNoc::select('year')->groupBy('year')->get() as $item) 
            <option>{{$item->year}}</option>
            @endforeach 
        </select>
    </div> -->


    @if(check_access('duty-roster.import'))
    <!-- <div class="col-md-2">
        <a href="#" data-toggle="modal" data-target="#modal-dutyroster-importdutyroster" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Input Petty Cash')}}</a>
    </div> -->
    
    @endif


    <div class="col-md-3" style="float: right;">
        <a href="javascript:;" wire:click="$emit('modaladdpettycash')" class="btn btn-info"><i class="fa fa-plus"></i> Add Petty Cash </a>
    </div>
    
    
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Company Name</th> 
                        <th>Project</th> 
                        <th>Region</th> 
                        <th>Amount</th> 
                        <th>Keterangan</th> 
                        <th>Settlement</th> 
                        <th>Date Upload</th> 
                        <th>Status</th> 
                        <th>Action</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            @if($item->company_id == '1')
                                HUP
                            @else
                                PMT
                            @endif
                        </td>
                        <td>{{ get_project_company($item->project, $item->company_id) }}</td>
                        <td>{{$item->region}}</td>
                        <td>Rp, {{ format_idr($item->amount) }}</td>
                        <td>{{$item->keterangan}}</td>
                        <td>
                            
                            @if($item->settlement == '' || $item->settlement == NULL )
                                <!-- if(check_access('commitment-letter.pic')) -->
                                    <!-- <a href="javascript:;" wire:click="$emit('modalimportpettycash','{{ $item->id }}')"><i class="fa fa-upload"></i></a> -->
                                <!-- endif -->
                            @else
                                <!-- <a href="<?php echo asset('storage/PettyCash/'.$item->settlement); ?>"><i class="fa fa-download" style="color: #28a745;"></i></a> -->
                                <!-- <a href="javascript:;" wire:click="$emit('modalimportpettycash','{{ $item->id }}')"><i class="fa fa-download" style="color: #28a745;"></i></a> -->
                            @endif

                            <a href="javascript:;" wire:click="$emit('modalimportpettycash','{{ $item->id }}')"><i class="fa fa-eye fa-2x"></i></a>

                        </td>
                        <td>{{ date_format(date_create($item->created_at), 'd M Y') }}</td>
                        <td>
                            @if($item->status == '1')
                                <label class="badge badge-success" data-toggle="tooltip" title="Close">Close</label>
                            @endif

                            @if($item->status == '0')
                                <label class="badge badge-danger" data-toggle="tooltip" title="Decline">Decline</label>
                            @endif

                            @if($item->status == '' || $item->status == 'null')
                                <label class="badge badge-warning" data-toggle="tooltip" title="Waiting to Approve">Waiting to Approve</label>
                            @endif
                        </td> 
                        <td>
                            <!-- <a href="{{route('duty-roster.preview',['id'=>$item->id]) }}" title="Add" class="btn btn-primary"><i class="fa fa-eye"></i> {{__('Preview')}}</a> -->
                            @if(check_access('duty-roster.approve'))
                                @if($item->status == '')
                                    <a href="javascript:;" wire:click="$emit('modalapprovedutyroster','{{ $item->id }}')" class="btn btn-success"><i class="fa fa-check"></i> Approve</a>
                                    <a href="javascript:;" wire:click="$emit('modaldeclinedutyroster','{{ $item->id }}')" class="btn btn-danger"><i class="fa fa-close"></i> Decline</a>
                                @endif

                            @endif

                            @if(check_access('duty-roster.import'))
                                @if($item->status == '0')
                                    <a href="#" wire:click="$emit('modalrevisidutyroster','{{ $item->id }}')" data-toggle="modal" data-target="#modal-dutyroster-revisidutyroster" title="Add" class="btn btn-warning"><i class="fa fa-plus"></i> {{__('Revisi Duty roster')}}</a>
                                @endif
                            @endif
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>