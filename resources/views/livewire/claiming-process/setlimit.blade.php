<div class="row">
    <div class="col-md-2">
        <input type="date" class="form-control" wire:model="date" />
    </div>

    
    <!-- <div class="col-md-2" wire:ignore>
        <select class="form-control" style="width:100%;" wire:model="filterproject">
            <option value=""> --- Project --- </option>
            @foreach(\App\Models\ClientProject::orderBy('id', 'desc')
                                ->where('company_id', Session::get('company_id'))
                                ->where('is_project', '1')
                                ->get() as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
    </div> -->


    @if(check_access('asset-request.hq-user') || check_access('asset-request.regional-logistic-admin'))
    <div class="col-md-1" style="margin: 0 10px;">
        <a href="javascript:;" wire:click="$emit('modaladdlimit')" class="btn btn-info"><i class="fa fa-plus"></i> Set Limit </a>
    </div>  
    @endif
    
    
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>

                    <tr>
                        <th class="align-middle">No</th>
                        <th class="align-middle">Action</th> 
                        <th class="align-middle">Date Create</th>
                        <th class="align-middle">User Access</th> 
                        <th class="align-middle">Limit</th> 
                        
                    </tr>
                   
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    
                    <!-- <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <a href="javascript:;" wire:click="$emit('modalapprovalhistoryassetrequest','{{ $item->id }}')">
                            @if($item->status == '1')
                                <label class="badge badge-success" data-toggle="tooltip" title="Asset Request is Approved">Approved</label>
                            @endif

                            @if($item->status == '0')
                                <label class="badge badge-danger" data-toggle="tooltip" title="{{$item->note}}">Decline</label>
                            @endif
                            </a>

                            @if($item->status == '' || $item->status == 'null')
                                <label class="badge badge-warning" data-toggle="tooltip" title="Waiting to Approve">Waiting to Approve</label>
                            @endif
                        </td>
                        <td>
                            @if(check_access('asset-request.hq-ga'))
                                @if($item->status == '')
                                   
                                    <a href="javascript:;" wire:click="$emit('modalapproveassetrequest',['{{ $item->id }}', '1'])"><i class="fa fa-check " style="color: #22af46;"></i></a>
                                    <a href="javascript:;" wire:click="$emit('modaldeclineassetrequest',['{{ $item->id }}', '1'])"><i class="fa fa-close " style="color: #de4848;"></i></a>
                                @endif

                            @endif


                            
                        </td>
                        <td>{{ date_format(date_create($item->created_at), 'd M Y') }}</td>
                        <td>{{ $item->name }}</td>

                        <td>{{ $item->nik }}</td>
                        <td>{{ $item->project }}</td>
                        <td>{{ $item->region }}</td>

                        <td>
                            @if($item->asset_type == '1')
                                Air Conditioner & Fan
                            @endif

                            @if($item->asset_type == '2')
                                Furniture & Fixture
                            @endif

                            @if($item->asset_type == '3')
                                Computer Equipment
                            @endif

                            @if($item->asset_type == '4')
                                Printer & Device
                            @endif

                        </td>
                        <td>{{ $item->asset_name }}</td>
                        <td>
                            
                                @if($item->dana_from == '')
                                    @if($item->status == '1')
                                        @if(check_access('asset-request.hq-ga'))
                                            <a href="javascript:;" wire:click="$emit('modaleditassetrequest','{{ $item->id }}')"><i class="fa fa-edit " style="color: #f3ad06;"></i></a>
                                        @endif
                                    @endif
                                @else
                                    @if($item->dana_from == '1')
                                        e-PL
                                    @else
                                        Petty Cash
                                    @endif
                                    
                                @endif
                            
                        </td>
                        
                        <td>{{ $item->pr_no }}</td>
                        <td>{{ "Rp " . number_format($item->dana_amount,2,',','.') }}</td>
                        <td><b>{{ strtoupper($item->serial_number) }}</b></td>
                        <td><a href="javascript:;" wire:click="$emit('modaldetaillocation','{{ $item->id }}')">{{ @\App\Models\DophomebaseMaster::where('id', $item->location)->first()->nama_dop }}</a></td>
                        <td>{{ $item->dimension }}</td>
                        <td>{{ $item->detail }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->reason_request }}</td>
                        <td><a href="javascript:;" wire:click="$emit('modaldetailimage','{{ $item->id }}')"><i class="fa fa-eye"></i></a></td>
                    </tr> -->
                    
                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>