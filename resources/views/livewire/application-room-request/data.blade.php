<div class="row">
    <div class="col-md-2">
        <input type="date" class="form-control" wire:model="date" />
    </div>
    <div class="col-md-2">
        <a href="#" data-toggle="modal" data-target="#modal-roomrequest-importapprequest" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('App Request')}}</a>
    </div>
    
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Detail Request</th> 
                        <th>Date</th> 
                        <th>Purpose</th> 
                        <th>Status</th> 
                        <th>Requested By / Department</th> 
                        <th>Date Request</th> 
                        <th>Action</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{$item->request_room_detail}}</td>
                        <td>{{date('d-M-Y',strtotime($item->created_at))}}</td>
                        <td>{{ $item->purpose }}</td>
                        <td>
                            @if($item->status == '1')
                                <label class="badge badge-warning" data-toggle="tooltip" title="Waiting PMG Approval">Waiting PMG Approval</label>
                            @endif

                            @if($item->status == '2')
                                <label class="badge badge-success" data-toggle="tooltip" title="Approved">Approved</label>
                            @endif

                            @if($item->status == '0')
                                <label class="badge badge-danger" data-toggle="tooltip" title="{{ $item->note }}">Decline</label>
                            @endif

                            @if($item->status == '' || $item->status == 'null')
                                <label class="badge badge-warning" data-toggle="tooltip" title="Waiting to Approve">Waiting to Approve</label>
                            @endif
                        </td> 
                        <td>
                            {{ $item->employee_name }} / {{ $item->departement }}
                        </td>
                        <td>{{ date_format(date_create($item->created_at), 'd M Y') }}</td>
                        <td>
                            @if(check_access('application-room-request.manager-approval'))
                                @if($item->status == '' || $item->status == null)
                                    <a href="javascript:;" wire:click="$emit('modalapproveroomrequest','{{ $item->id }}')" data-toggle="modal" data-target="#modal-app-approve" class="badge badge-success"><i class="fa fa-check"></i> Approve</a>
                                    <a href="javascript:;" wire:click="$emit('modaldeclineroomrequest','{{ $item->id }}')" class="badge badge-danger"><i class="fa fa-close"></i> Decline</a>
                                @endif
                            @endif

                            @if(check_access('application-room-request.pmg-approval'))
                                @if($item->status ==1)
                                    <a href="javascript:;" wire:click="$emit('modalapproveroomrequest','{{ $item->id }}')" class="btn btn-success"><i class="fa fa-check"></i> Approve</a>
                                    <a href="javascript:;" wire:click="$emit('modaldeclineroomrequest','{{ $item->id }}')" class="btn btn-danger"><i class="fa fa-close"></i> Decline</a>
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