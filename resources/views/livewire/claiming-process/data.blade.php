<div class="row">
    <div class="col-md-2">
        <input type="date" class="form-control" wire:model="date" />
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

    <div class="col-md-2">
        <input type="text" class="form-control" wire:model="name" />
    </div>


    @if(check_access('asset-request.hq-user') || check_access('asset-request.regional-logistic-admin'))
    <!-- <div class="col-md-1" style="margin: 0 10px;">
        <a href="javascript:;" wire:click="$emit('modalclaimticket')" class="btn btn-info"><i class="fa fa-plus"></i> Claiming Request </a>
    </div>   -->
    @endif
    
    
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>

                    <tr>
                        <th class="align-middle">No</th>
                        <th class="align-middle">Status</th> 
                        <th class="align-middle">Claim</th> 
                        <th class="align-middle">Date Create</th>
                        <th class="align-middle">Ticket ID</th> 
                        <th class="align-middle">User Request</th> 
                        <th class="align-middle">NIK</th> 
                        <th class="align-middle">Project</th> 
                        <th class="align-middle">Region</th> 
                        <th class="align-middle">Ticket Type</th> 
                        <th class="align-middle">Transfer Receipt</th> 
                    </tr>
                   
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <?php
                                $dataclaim = \App\Models\ClaimingProcess::where('ticket_id', $item->ticket_id)->first();
                            ?>
                            @if($dataclaim)
                                <a href="javascript:;" wire:click="$emit('modalapprovalhistoryclaimingprocess','{{ $dataclaim->ticket_id }}')">
                                    @if($dataclaim->status == '3')
                                        <label class="badge badge-success" data-toggle="tooltip" title="Claim Request is Approved by FA">Approved by FA</label>
                                    @endif

                                    @if($dataclaim->status == '2')
                                        <label class="badge badge-success" data-toggle="tooltip" title="Claim Request is Approved by GA">Approved by GA</label>
                                    @endif

                                    @if($dataclaim->status == '1')
                                        <label class="badge badge-success" data-toggle="tooltip" title="Claim Request is Approved by Department Manager">Approved by Department Manager</label>
                                    @endif

                                    @if($dataclaim->status == '0')
                                        <label class="badge badge-danger" data-toggle="tooltip" title="{{$item->note}}">Decline</label>
                                    @endif

                                    @if($dataclaim->status == '' || $item->status == 'null')
                                        <label class="badge badge-warning" data-toggle="tooltip" title="Waiting to Approve">Waiting to Approve</label>
                                    @endif
                                </a>
                            @endif
                        </td>
                        <td>
                            
                            <?php
                                $dataclaim = \App\Models\ClaimingProcess::where('ticket_id', $item->ticket_id)->first();
                            ?>
                            @if(\App\Models\ClaimingProcess::where('ticket_id', $item->ticket_id)->first())
                                <label class="badge badge-success" data-toggle="tooltip" title="claimed">Claimed</label>

                                @if(check_access('claiming-process.department-manager'))
                                    @if($dataclaim->status == '')
                                    dept
                                    <a href="javascript:;" wire:click="$emit('modalapproveclaimingprocess',['{{ $item->ticket_id }}', '1'])"><i class="fa fa-check " style="color: #22af46;"></i></a>
                                    <a href="javascript:;" wire:click="$emit('modaldeclineclaimingprocess',['{{ $item->ticket_id }}', '1'])"><i class="fa fa-close " style="color: #de4848;"></i></a>
                                    @endif

                                @endif

                                @if(check_access('claiming-process.ga'))
                                    @if($dataclaim->status == '1')
                                    ga
                                    <a href="javascript:;" wire:click="$emit('modalapproveclaimingprocess',['{{ $item->ticket_id }}', '2'])"><i class="fa fa-check " style="color: #22af46;"></i></a>
                                    <a href="javascript:;" wire:click="$emit('modaldeclineclaimingprocess',['{{ $item->ticket_id }}', '2'])"><i class="fa fa-close " style="color: #de4848;"></i></a>
                                    @endif

                                @endif

                                @if(check_access('claiming-process.fa'))
                                    @if($dataclaim->status == '2')
                                    fa
                                    <a href="javascript:;" wire:click="$emit('modalapproveclaimingprocess',['{{ $item->ticket_id }}', '3'])"><i class="fa fa-check " style="color: #22af46;"></i></a>
                                    <a href="javascript:;" wire:click="$emit('modaldeclineclaimingprocess',['{{ $item->ticket_id }}', '3'])"><i class="fa fa-close " style="color: #de4848;"></i></a>
                                    @endif

                                @endif
                            @else
                                <a href="javascript:;" wire:click="$emit('modalclaimticket', '{{$item->id}}')"><i class="fa fa-edit " style="color: #f3ad06;"></i></a>
                            @endif
                        </td>
                        <td>{{ date_format(date_create($item->created_at), 'd M Y') }}</td>
                        <td><b>{{ strtoupper($item->ticket_id) }}</b></td>
                        <td>{{ $item->name }}</td>

                        <td>{{ $item->nik }}</td>
                        <td>{{ $item->project }}</td>
                        <td>{{ $item->region }}</td>
                        <td>
                            <?php
                                if($item->ticket_type == '1'){
                                    $tickettype = 'Hotel - Flight';
                                }else{
                                    $tickettype = 'Hotel';
                                }
                            ?>
                            <a href="javascript:;" wire:click="$emit('modaldetailticket','{{ $item->id }}')"><?php echo $tickettype;?></a>
                        </td>
                        <td>
                            <a href="javascript:;" wire:click="$emit('modalimportreceipt', '{{$item->ticket_id}}')"><i class="fa fa-edit " style="color: #f3ad06;"></i></a>
                        </td>
                    </tr>
                
                    
                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>