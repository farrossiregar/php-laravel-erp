<div class="row">
    <!-- <div class="col-md-2">
        <input type="date" class="form-control" wire:model="date" />
    </div> -->

    <div class="col-md-1">                
        <select class="form-control" wire:model="filteryear">
            <option value=""> --- Year --- </option>
            <option value="2021">2021</option>
            <option value="2020">2020</option>
            <option value="2019">2019</option>
            <option value="2018">2018</option>
            <option value="2017">2017</option>
        </select>
    </div>
    <div class="col-md-2" wire:ignore>
        <select class="form-control" style="width:100%;" wire:model="filtermonth">
            <option value=""> --- Month --- </option>
            @for($i = 1; $i <= 12; $i++)
                <option value="{{$i}}">{{date('F', mktime(0, 0, 0, $i, 10))}}</option>
            @endfor
        </select>
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


    
    <div class="col-md-1" style="margin: 0 10px;">
        <a href="javascript:;" wire:click="$emit('modaladdhotelflight')" class="btn btn-info"><i class="fa fa-plus"></i> Ticket Request </a>
    </div>  
    
    
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-bordered table-striped m-b-0 c_list">
                <thead>

                    <tr>
                        <th rowspan="2" class="align-middle">No</th>
                        <th rowspan="2" class="align-middle">Status</th> 
                        <th rowspan="2" class="align-middle">Action</th> 
                        <th rowspan="2" class="align-middle">Date Create</th>
                        <th rowspan="2" class="align-middle">Ticket ID</th>
                        <th rowspan="2" class="align-middle">User</th> 
                        <th rowspan="2" class="align-middle">Position</th> 
                        <th rowspan="2" class="align-middle">NIK</th> 
                        <!-- <th rowspan="2" class="align-middle">Company Name</th>  -->
                        <th rowspan="2" class="align-middle">Project</th> 
                        <th rowspan="2" class="align-middle">Region</th> 
                        <th rowspan="2" class="align-middle">Ticket Type</th> 
                        <th rowspan="2" class="align-middle">Category</th> 
                        
                        <th rowspan="2" class="align-middle">Attachment</th> 
                        <th rowspan="2" class="align-middle">Meeting Location</th> 
                        <th rowspan="2" class="align-middle">Date</th> 
                        <th colspan="6" class="text-center align-middle">Flight Detail</th>
                        <th colspan="3" class="text-center align-middle">Hotel Detail</th> 
                    </tr>
                    <tr>
                      
                        <th class="text-center align-middle">Price</th> 
                        <th class="text-center align-middle">Departure</th> 
                        <th class="text-center align-middle">Arrival</th> 
                        <th class="text-center align-middle">Airline</th> 
                        <th class="text-center align-middle">Agency</th> 
                        <th class="text-center align-middle">Confirmation Flight</th> 
                        

                        <th class="text-center align-middle">Price</th> 
                        <th class="text-center align-middle">Name</th> 
                        <th class="text-center align-middle">Location</th> 
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
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
                        <td><b>{{ strtoupper($item->ticket_id) }}</b></td>
                        <td>{{ $item->name }}</td>
                        <td>{{ \App\Models\UserAccess::where('id', $item->position)->orderBy('id', 'asc')->first()->name }}</td>
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
                        <td>
                            @if($item->category == '1')
                                Training
                            @elseif($item->category == '2')
                                Meeting
                            @else
                                {{ $item->category }}
                            @endif
                        </td>
                        
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
                        
                    </tr>
                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>