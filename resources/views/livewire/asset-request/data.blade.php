<div class="row">
    <div class="col-md-2">
        <input type="date" class="form-control" wire:model="date" />
    </div>
    <!-- if($is_regional || $is_hq_user) -->
        
        <div class="col-md-5" style="margin: 0 10px;">
        <a href="javascript:;" wire:click="$emit('modaladdassetrequest')" class="btn btn-info"><i class="fa fa-plus"></i> Asset Request </a>
            <a href="javascript:;" data-toggle="modal" data-target="#modal_asset_type" class="btn btn-info"><i class="fa fa-database"></i> Asset Type</a>
        </div>
    <!-- endif -->
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered m-b-0 c_list">
                <thead>
                    <tr>
                        <th class="align-middle">No</th>
                        <th class="align-middle">Action</th> 
                        <th class="align-middle">Date Create</th>
                        <th class="align-middle">Request Status</th> 
                        <th class="align-middle">Project</th> 
                        <th class="align-middle">Region</th> 
                        <th class="align-middle">Location</th> 
                        <th class="align-middle">Dimension</th> 
                        <th class="align-middle">Reference/Link</th> 
                        <th class="align-middle">Asset Type</th> 
                        <th class="align-middle">Asset Name</th> 
                        <th class="align-middle">Dana From</th> 
                        <th class="align-middle"></th> 
                        <th class="align-middle">PR / PO No</th> 
                        @if($is_hq_ga)
                            <th class="align-middle">Dana Amount</th> 
                        @endif
                        <th class="align-middle">Serial Number</th> 
                        <th class="align-middle">Detail</th> 
                        <th class="align-middle">Reason</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                @if($is_hq_ga and $item->status=='')
                                    <a href="javascript:;" wire:click="$emit('modalapproveassetrequest',['{{ $item->id }}', '1'])" class="badge badge-success badge-active"><i class="fa fa-check"></i> approve</a>
                                    <a href="javascript:;" wire:click="$emit('modaldeclineassetrequest',['{{ $item->id }}', '1'])" class="badge badge-danger badge-active"><i class="fa fa-close"></i> reject</a>
                                @endif
                            </td>
                            <td>{{ date_format(date_create($item->created_at), 'd M Y') }}</td>
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
                            <td>{{ \App\Models\ClientProject::where('id', $item->project)->first()->name }}</td>
                            <td>{{ @\App\Models\Region::where('id',$item->region)->first()->region }}</td>
                            <td><a href="javascript:;" wire:click="$emit('modaldetaillocation','{{ $item->id }}')">{{ @\App\Models\DophomebaseMaster::where('id', $item->location)->first()->nama_dop }}</a></td>
                            <td>{{ $item->dimension }}</td>
                            <td><a href="javascript:;" wire:click="$emit('modaldetailimage','{{ $item->id }}')"><i class="fa fa-eye"></i></a></td>
                            <td>
                                {{ \App\Models\AssetsType::where('id', $item->asset_type)->first()->asset_type }}
                                <!-- @if($item->asset_type == '1')
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
                                @endif -->
                            </td>
                            <td>{{ $item->asset_name }}</td>
                            <td>
                                @if($item->dana_from == '')
                                    @if($item->status == '1')
                                        @if($is_hq_ga)
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
                            <td>
                                @if($is_hq_ga)
                                <a href="javascript:;" wire:click="$emit('modalpoprassetrequest','{{ $item->id }}')"><i class="fa fa-plus "></i></a>
                                @endif
                            </td>
                            <td>
                                @foreach(\App\Models\AssetDatabasePoprnumber::where('asset_id', $item->id)->get() as $items)
                                    {{ $items->pr_po_number }}<br />
                                @endforeach
                                
                            </td>
                            @if($is_hq_ga)
                            <td>
                                @foreach(\App\Models\AssetDatabasePoprnumber::where('asset_id', $item->id)->get() as $items)
                                {{ "Rp " . number_format($items->amount,2,',','.') }}<br />
                                @endforeach
                            </td>
                            @endif
                            <!-- if($is_hq_ga)
                                <td>{{ "Rp " . number_format($item->dana_amount,2,',','.') }}</td>
                            endif -->
                            <td><b>{{ strtoupper($item->serial_number) }}</b></td>
                            <td>{{ $item->detail }}</td>
                            <td>{{ $item->reason_request }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_asset_type" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:asset-request.asset-type />
        </div>
    </div>
</div>