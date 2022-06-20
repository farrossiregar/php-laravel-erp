<div class="row">
    <!-- <div class="col-md-2">
        <input type="date" class="form-control" wire:model="date" />
    </div> -->

    
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


    
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped table-bordered m-b-0 c_list">
                <thead>

                    <tr>
                        <th class="align-middle">No</th>
                        <th class="align-middle">Action</th> 
                        <th class="align-middle">Date Created</th>
                        <th class="align-middle">Transfer Status</th> 
                        <th class="align-middle">Transfer ID</th>
                        <th class="align-middle">Detail Asset</th>
                        <th class="align-middle">Transfer From</th> 
                        <th class="align-middle">Transfer To</th> 
                        <th class="align-middle">Reason for Transfering</th> 
                        <!-- <th class="align-middle">Dana Transfer</th>  -->
                    </tr>
                   
                </thead>
                <tbody>
                    
                    @foreach($data as $key => $item)
                    <tr>
                        <?php
                            $data = \App\Models\AssetTransferRequest::where('id_asset_request', $item->id_asset_request)->first();
                            $check = \App\Models\AssetTransferRequest::where('id_asset_request', $item->id_asset_request)->get();
                        ?>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <!-- if(check_access('asset-transfer-request.ga')) -->
                                @if(count($check) > 0)
                                    @if($data->status == '')
                                        <a href="javascript:;" wire:click="$emit('modalapproveassetrequest',['{{ $item->id }}', '1'])"><i class="fa fa-check " style="color: #22af46;"></i></a>
                                        <a href="javascript:;" wire:click="$emit('modaldeclineassetrequest',['{{ $item->id }}', '1'])"><i class="fa fa-close " style="color: #de4848;"></i></a>
                                    
                                    @endif
                                @endif

                            <!-- endif -->

                            <!-- if(check_access('asset-transfer-request.ga-admin')) -->
                                @if(count($check) < 1)
                                    <a href="javascript:;" wire:click="$emit('modaladdassettransferrequest','{{ $item->id_asset_req }}')" class="btn btn-info"><i class="fa fa-plus"></i> Apply Request </a>
                                @endif
                            <!-- endif -->

                            <!-- if(check_access('asset-transfer-request.ga-admin')) -->
                                @if(@$data->status == '1')
                                    <a href="javascript:;" wire:click="$emit('modaleditassettransferrequest', ['{{ $data->id }}', '{{ $item->id_asset_req }}'])" class="btn btn-info"><i class="fa fa-plus"></i> Transfer </a>
                                @endif
                            <!-- endif -->

                        </td>
                        <td>{{ date_format(date_create($item->created_at), 'd M Y') }}</td>
                        <td>
                            @if($item->status == '2')
                                <label class="badge badge-success" data-toggle="tooltip" title="Transfered">Transfered</label>
                            @endif

                            @if($item->status == '1')
                                <label class="badge badge-success" data-toggle="tooltip" title="Asset Transfer Request is Approved">Approved</label>
                            @endif

                            @if($item->status == '0')
                                <label class="badge badge-danger" data-toggle="tooltip" title="{{$item->note}}">Decline</label>
                            @endif

                            @if($item->status == '' || $item->status == 'null')
                                <label class="badge badge-warning" data-toggle="tooltip" title="Waiting to Approve">Waiting to Approve</label>
                            @endif
                        </td>
                        <td><b>{{ strtoupper($item->transfer_id) }}</b> </td>
                        <td>
                            <a href="javascript:;" wire:click="$emit('modaldetailassetrequest','{{ $item->id_asset_req }}')"><i class="fa fa-eye " style="color: #007bff;"></i></a>
                        </td>
                        
                        <!-- <td>{{ "Rp " . number_format($item->dana_amount,2,',','.') }}</td> -->
                        <!-- <td>{{ "Rp " . number_format($item->amount_transfer,2,',','.') }}</td> -->
                        <td>{{ $item->transfer_from }}</td>
                        <td>{{ $item->transfer_to }}</td>
                        <td>{{ $item->transfer_reason }}</td>
                        
                       
                    </tr>
                    
                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>