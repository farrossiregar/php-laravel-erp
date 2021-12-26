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
        <a href="javascript:;" wire:click="$emit('modaladdassetrequest')" class="btn btn-info"><i class="fa fa-plus"></i> Asset Request </a>
    </div>  
    @endif
    
    
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>

                    <tr>
                        <th class="align-middle">No</th>
                        <th class="align-middle">Status</th> 
                        <th class="align-middle">Action</th> 
                        <th class="align-middle">Date Create</th>
                        <th class="align-middle">User Request</th> 
                        <th class="align-middle">NIK</th> 
                        <th class="align-middle">Project</th> 
                        <th class="align-middle">Region</th> 
                        <th class="align-middle">Asset Type</th> 
                        <th class="align-middle">Asset Name</th> 
                        <th class="align-middle">Dana From</th> 
                        <th class="align-middle">PR No</th> 
                        <th class="align-middle">Dana Amount</th> 
                        <th class="align-middle">Location</th> 
                        <th class="align-middle">Dimension</th> 
                        <th class="align-middle">Detail</th> 
                        <th class="align-middle">Qty</th>
                        <th class="align-middle">Reason</th> 
                        <th class="align-middle">Reference/Link</th> 
                    </tr>
                   
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                          
                            @if($item->status == '1')
                                <label class="badge badge-success" data-toggle="tooltip" title="Asset Request is Approved">Approved</label>
                            @endif

                            @if($item->status == '0')
                                <label class="badge badge-danger" data-toggle="tooltip" title="{{$item->note}}">Decline</label>
                            @endif

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

                        <td>{{ $item->asset_type }}</td>
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
                        <td>Rp,{{ format_idr($item->dana_amount) }}</td>
                        <td><a href="javascript:;" wire:click="$emit('modaldetaillocation','{{ $item->id }}')">{{ @\App\Models\DophomebaseMaster::where('id', $item->location)->first()->nama_dop }}</a></td>
                        <td>{{ $item->dimension }}</td>
                        <td>{{ $item->detail }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->reason_request }}</td>
                        <!-- <td>{{ $item->reference_pic }}{{ $item->link }}</td> -->
                        <td><a href="javascript:;" wire:click="$emit('modaldetailimage','{{ $item->id }}')"><i class="fa fa-eye"></i></a></td>
                    </tr>
                    <!-- <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            @if($item->status == '2')
                                <label class="badge badge-success" data-toggle="tooltip" title="Hotel & Flight Request is Approved by HQ GA">Approved by HQ GA</label>
                            @endif

                            @if($item->status == '1')
                                <label class="badge badge-success" data-toggle="tooltip" title="Hotel & Flight Request is Approved by L1 Manager">Approved by L1 Manager</label>
                            @endif

                            @if($item->status == '0')
                                <label class="badge badge-danger" data-toggle="tooltip" title="{{$item->note}}">Decline</label>
                            @endif

                            @if($item->status == '' || $item->status == 'null')
                                <label class="badge badge-warning" data-toggle="tooltip" title="Waiting to Approve">Waiting to Approve</label>
                            @endif
                        </td>
                        <td>
                            @if(check_access('hotel-flight-ticket.l1-manager'))
                                @if($item->status == '')
                                   
                                    <a href="javascript:;" wire:click="$emit('modalapprovehotelflightticket',['{{ $item->id }}', '1'])"><i class="fa fa-check " style="color: #22af46;"></i></a>
                                    <a href="javascript:;" wire:click="$emit('modaldeclinehotelflightticket',['{{ $item->id }}', '1'])"><i class="fa fa-close " style="color: #de4848;"></i></a>
                                @endif

                            @endif

                            @if(check_access('hotel-flight-ticket.hq-ga'))
                                @if($item->status == '1')
                                   
                                    <a href="javascript:;" wire:click="$emit('modalapprovehotelflightticket',['{{ $item->id }}', '2'])"><i class="fa fa-check " style="color: #22af46;"></i></a>
                                    <a href="javascript:;" wire:click="$emit('modaldeclinehotelflightticket',['{{ $item->id }}', '2'])"><i class="fa fa-close " style="color: #de4848;"></i></a>
                                @endif
                            @endif

                            @if(check_access('hotel-flight-ticket.hq-ga'))
                                @if($item->status == '2')
                                <a href="javascript:;" wire:click="$emit('modaledithotelflightticket','{{ $item->id }}')"><i class="fa fa-edit " style="color: #f3ad06;"></i></a>
                                    
                                @endif
                            @endif
                        </td>
                        <td>{{ date_format(date_create($item->created_at), 'd M Y') }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->nik }}</td>
                        <td>{{ $item->project }}</td>
                        <td>{{ $item->region }}</td>
                        <td>
                            <?php
                                if($item->ticket_type == '1'){
                                    echo 'Hotel - Flight';
                                }else{
                                    echo 'Hotel';
                                }
                            ?>
                        </td>
                        <td>{{ $item->category }}</td>
                        
                        <td>
                            <?php
                                if($item->attachment != '' || $item->attachment != NULL){
                                    echo '<a href="'.asset('storage/hotel_flight_ticket/'.$item->attachment.'').'" target="_blank"><i class="fa fa-download"></i></a>';
                                }
                            ?>
                        </td>
                        <td>{{ $item->meeting_location }}</td>
                        <td>{{ date_format(date_create($item->date), 'd M Y') }}</td>

                        <td><?php if($item->flight_price){ echo 'Rp,'.format_idr($item->flight_price); }else{ echo ''; } ?></td>
                        <td>{{ $item->departure_airport }} <?php if($item->departure_time){ echo '- '.date_format(date_create($item->departure_time), 'H:i'); }else{ echo ''; } ?></td>
                        <td>{{ $item->arrival_airport }} <?php if($item->arrival_time){ echo '- '.date_format(date_create($item->arrival_time), 'H:i'); }else{ echo ''; } ?></td>
                        <td>{{ $item->airline }}</td>
                        <td>{{ $item->agency }}</td>
                        <td>
                            <?php
                                if($item->confirmation_flight != '' || $item->confirmation_flight != NULL){
                                    echo '<a href="'.asset('storage/hotel_flight_ticket/'.$item->confirmation_flight.'').'" target="_blank"><i class="fa fa-download"></i></a>';
                                }
                            ?>
                        </td>

                        <td>Rp,{{ format_idr($item->hotel_price) }}</td>
                        <td>{{ $item->hotel_name }}</td>
                        <td>{{ $item->hotel_location }}</td>
                        
                    </tr> -->
                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>