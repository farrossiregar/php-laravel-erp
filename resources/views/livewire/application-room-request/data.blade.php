<div>
    <div class="row">
        <div class="col-md-2">
            <input type="date" class="form-control" wire:model="date" />
        </div>
        <div class="col-md-2">
            <a href="#" data-toggle="modal" data-target="#modal-roomrequest-importapprequest" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('App Request')}}</a>
        </div>
    </div>
    <div class="card mt-2">
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Application</th> 
                        <th>Date</th> 
                        <th>Purpose</th> 
                        <th>Status</th> 
                        <th>Requested By / Department</th> 
                        <th>Note</th>
                        <th></th> 
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

                            @if($item->status == 3)
                                <label class="badge badge-danger" data-toggle="tooltip" title="{{ $item->note }}">Decline</label>
                            @endif

                            @if($item->status == 0)
                                <label class="badge badge-warning" data-toggle="tooltip" title="Waiting to Approve">Waiting to Approve</label>
                            @endif
                        </td> 
                        <td>
                            {{ $item->employee_name }} / {{ $item->departement }}
                        </td>
                        <td>{{$item->note}}</td>
                        <td>
                            @if($item->status == 0 and $is_manager_approval)
                                <a href="javascript:;" wire:click="set_id({{$item->id}})" data-toggle="modal" data-target="#modal-approve-manager" class="badge badge-success badge-active"><i class="fa fa-check"></i> Proccess</a>
                            @endif
                            @if($item->status ==1 and $is_pmg_approval)
                                <a href="javascript:;" wire:click="set_id({{$item->id}})" data-toggle="modal" data-target="#modal-proccess-pmg" class="badge badge-success badge-active"><i class="fa fa-check"></i> Proccess</a>
                            @endif
                        </td> 
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modal-approve-manager" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="approve_manager">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-check"></i> Approve Request</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <p>Approve Application & Room Request ?</p>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" wire:model="note" placeholder="Note"></textarea>
                            @error('note')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="approve_manager" class="btn btn-success"><i class="fa fa-check"></i> Approve</button>
                        <button type="button" wire:click="reject_manager" class="btn btn-danger"><i class="fa fa-times"></i> Decline</button>
                    </div>
                    <!-- <div wire:loading>
                        <div class="page-loader-wrapper" style="display:block">
                            <div class="loader" style="display:block">
                                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                                <p>Please wait...</p>
                            </div>
                        </div>
                    </div> -->
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-proccess-pmg" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="proccess_pmg">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-check"></i> Proccess Request</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <p>Proccess Application Request ?</p>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" wire:model="note" placeholder="Note"></textarea>
                            @error('note')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" wire:click="approve_pmg"><i class="fa fa-check"></i> Approve</button>
                        <button type="button" class="btn btn-danger" wire:click="reject_pmg"><i class="fa fa-times"></i> Reject</button>
                    </div>
                    <!-- <div wire:loading>
                        <div class="page-loader-wrapper" style="display:block">
                            <div class="loader" style="display:block">
                                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                                <p>Please wait...</p>
                            </div>
                        </div>
                    </div> -->
                </form>
            </div>
        </div>
    </div>

</div>