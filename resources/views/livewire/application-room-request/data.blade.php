<div class="row">
    <div class="col-md-2">
        <input type="date" class="form-control" wire:model="date" />
    </div>

    <!-- <div class="col-md-2">
        <select class="form-control" wire:model="status" >
            <option value="all">-- Status --</option>
            <option value="">Waiting Approval</option>
            <option value="0">Declined</option>
            <option value="1">Waiting PMG Approval</option>
            <option value="2">Approved</option>
        </select>
    </div> -->

    <!-- <div class="col-md-2">
        <select class="form-control" wire:model="type_request" >
            <option value="">-- Type --</option>
            <option value="Room">Room</option>
            <option value="Application">Application</option>
        </select>
    </div> -->

<!--     
    <div class="col-md-1">                
        <select class="form-control" wire:model="year">
            <option value=""> --- Year --- </option>
            @foreach(\App\Models\EmployeeNoc::select('year')->groupBy('year')->get() as $item) 
            <option>{{$item->year}}</option>
            @endforeach 
        </select>
    </div> -->
    
    <!-- <div class="col-md-1" style="margin-right: 5px;">
        <a href="#" data-toggle="modal" data-target="#modal-roomrequest-importroomrequest" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Room Request')}}</a>
    </div> -->

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
                        <th>Type Request</th> 
                        <th>Detail Request</th> 
                        <th>Booking Date Request</th> 
                        <th>Purpose</th> 
                        <th>Participant</th> 
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
                        <td><b>{{ strtoupper($item->type_request) }}</b></td>
                        <td>
                            <?php
                                if($item->request_room_detail == 'server'){
                                    echo 'Ruang Server IT & Jaringan';
                                }

                                if($item->request_room_detail == 'hrd'){
                                    echo 'Ruang HRD';
                                }

                                if($item->request_room_detail == 'finance'){
                                    echo 'Ruang Finance';
                                }

                                if($item->request_room_detail == 'informasi'){
                                    echo 'Tempat Penyimpanan Data & Informasi Sensitif ';
                                }

                                if($item->request_room_detail == 'epl'){
                                    echo 'ePL';
                                }

                                if($item->request_room_detail == 'eopex'){
                                    echo 'eOpex';
                                }
                            ?>
                        </td>
                        <td>
                            @if($item->type_request == 'Room')
                                {{ date_format(date_create($item->start_booking), 'd M Y') }} {{ date_format(date_create($item->start_booking), 'H:i') }} - {{ date_format(date_create($item->end_booking), 'H:i') }}
                            @endif
                        </td>

                        <td>{{ $item->purpose }}</td>
                        <td>{{ $item->participant }}</td>
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
                                    <a href="javascript:;" wire:click="$emit('modalapproveroomrequest','{{ $item->id }}')" class="btn btn-success"><i class="fa fa-check"></i> Approve</a>
                                    <a href="javascript:;" wire:click="$emit('modaldeclineroomrequest','{{ $item->id }}')" class="btn btn-danger"><i class="fa fa-close"></i> Decline</a>
                                @endif
                            @endif

                            @if(check_access('application-room-request.pmg-approval'))
                                @if($item->status == '1')
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