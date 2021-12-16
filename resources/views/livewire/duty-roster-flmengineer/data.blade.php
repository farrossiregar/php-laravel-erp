<div class="row">
    <div class="col-md-1">                
        <select class="form-control" wire:model="year">
            <option value=""> --- Year --- </option>
            @foreach($yr as $item) 
            <option>{{$item->yr}}</option>
            @endforeach 
        </select>
    </div>
    <div class="col-md-1">                
        <select class="form-control" wire:model="month">
            <option value=""> --- Month --- </option>
            @for($m = 1; $m <= 12; $m++)
            <option value="{{$m}}">{{date('F', mktime(0, 0, 0, $m, 10))}}</option>
            @endfor
        </select>
    </div>
    @if(check_access('duty-roster.flm-engineer.import'))
    <div class="col-md-1" style="margin-right: 55px;">
        <a href="{{ route('duty-roster-flmengineer.updateemployee') }}"  class="btn btn-info"><i class="fa fa-edit"></i> Update Employee</a>
    </div>
    @endif
    <div class="col-md-2">
        <?php
            $monthyear = $month.$year;
        ?>
        <a href="javascript:;" wire:click="$emit('modalexportdutyrosterflm','{{ $monthyear }}')" class="btn btn-info"><i class="fa fa-download"></i> Export</a>
    </div>
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Project</th>
                        <th>Remarks</th>
                        <th>Name</th> 
                        <th>Position</th> 
                        <th>Date Update</th> 
                        <th>Status Approval</th> 
                        <th>Action</th> 
                    </tr>
                </thead>
                <tbody>

                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{isset($item->project->name) ? $item->project->name : '-'}}</td>
                        <td>
                            @if($item->status == '1')
                                @if(check_access('duty-roster.audit'))
                                    <input type="checkbox"  wire:click="checkdata({{ $item->id }})" wire:model="data_id.{{ $item->id }}" />
                                @else
                                    @if($item->remarks == '1')
                                        <a href="javascript:;" class="text-danger"><i class="fa fa-close"></i></a>
                                    @else
                                        <a href="javascript:;" class="text-success"><i class="fa fa-check"></i></a>
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ @get_position($item->user_access_id) }}</td>
                        <td>{{ isset($item->created_at) ? date_format(date_create(@$item->created_at), 'd M Y') : '' }}</td>
                        <td>
                            @if($item->status == '1')
                                <label class="badge badge-success" data-toggle="tooltip" title="Approved">Approved</label>
                            @endif
                            @if($item->status == '0')
                                <label class="badge badge-danger" data-toggle="tooltip" title="{{$item->note}}">Rejected</label>
                            @endif
                            @if($item->status == '' || $item->status == 'null')
                                <label class="badge badge-warning" data-toggle="tooltip" title="Waiting Approval">Waiting Approval</label>
                            @endif
                        </td> 
                        <td>
                            
                            <a href="javascript:;" wire:click="$emit('modalpreviewdutyrosterflm','{{ $item->id }}')" class="badge badge-info badge-active"><i class="fa fa-eye"></i> Preview</a>
                            @if(check_access('duty-roster.import'))
                                @if($item->status == '0')
                                <a href="javascript:;" wire:click="$emit('modalrevisidutyrosterflm','{{ $item->id }}')" class="badge badge-danger badge-active"><i class="fa fa-edit"></i> Revisi</a>
                                @endif
                            @endif

                            @if(check_access('duty-roster.approve'))
                                @if($item->status == '' || $item->status == 'null')
                                <a href="javascript:;" wire:click="$emit('modalapprovedutyroster','{{ $item->id }}')" class="badge badge-success badge-active"><i class="fa fa-check"></i> Approve</a>
                                <a href="javascript:;" wire:click="$emit('modaldeclinedutyroster','{{ $item->id }}')" class="badge badge-danger badge-active"><i class="fa fa-close"></i> Reject</a>
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