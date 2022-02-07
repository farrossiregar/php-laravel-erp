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
        <a href="javascript:;" wire:click="$emit('modaladdhotelflight')" class="btn btn-info"><i class="fa fa-plus"></i> Request Account Payable </a>
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
                        <!-- <th rowspan="2" class="align-middle">Ticket ID</th> -->
                        <th rowspan="2" class="align-middle">User</th> 
                        <th rowspan="2" class="align-middle">Position</th> 
                        <th rowspan="2" class="align-middle">NIK</th> 
                        <!-- <th rowspan="2" class="align-middle">Company Name</th>  -->
                        <th rowspan="2" class="align-middle">Project</th> 
                        <th rowspan="2" class="align-middle">Region</th> 
                        <!-- <th rowspan="2" class="align-middle">Ticket Type</th> 
                        <th rowspan="2" class="align-middle">Category</th> 
                        
                        <th rowspan="2" class="align-middle">Attachment</th> 
                        <th rowspan="2" class="align-middle">Meeting Location</th> 
                        <th rowspan="2" class="align-middle">Date</th> 
                        <th colspan="6" class="text-center align-middle">Flight Detail</th>
                        <th colspan="3" class="text-center align-middle">Hotel Detail</th>  -->

                        <th rowspan="2" class="align-middle">Request Type</th> 
                        <th rowspan="2" class="align-middle">Sub Request Type</th>                         
                        <th rowspan="2" class="align-middle">Approved By</th> 
                        <th rowspan="2" class="align-middle">Additional Document</th> 
                        <th rowspan="2" class="align-middle">Detail Payment</th> 
                    </tr>
                    <!-- <tr>
                      
                        <th class="text-center align-middle">Price</th> 
                        <th class="text-center align-middle">Departure</th> 
                        <th class="text-center align-middle">Arrival</th> 
                        <th class="text-center align-middle">Airline</th> 
                        <th class="text-center align-middle">Agency</th> 
                        <th class="text-center align-middle">Confirmation Flight</th> 
                        

                        <th class="text-center align-middle">Price</th> 
                        <th class="text-center align-middle">Name</th> 
                        <th class="text-center align-middle">Location</th> 
                        
                    </tr> -->
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
                        <!-- <td><b>{{ strtoupper($item->ticket_id) }}</b></td> -->
                        <td>{{ $item->name }}</td>
                        <td>{{ \App\Models\UserAccess::where('id', $item->position)->orderBy('id', 'asc')->first()->name }}</td>
                        <td>{{ $item->nik }}</td>
                        <td>{{ $item->project }}</td>
                        <td>{{ $item->region }}</td>
                        <td>
                            
                            @if($item->request_type == '1')
                                Petty Cash
                            @endif
                            @if($item->request_type == '2')
                                Weekly Opex
                            @endif
                            @if($item->request_type == '3')
                                Other Opex
                            @endif
                            @if($item->request_type == '4')
                                Rectification
                            @endif
                            @if($item->request_type == '5')
                                Subcont
                            @endif
                            @if($item->request_type == '6')
                                Site Keeper
                            @endif
                            @if($item->request_type == '7')
                                HQ Administration
                            @endif
                            @if($item->request_type == '8')
                                Payroll
                            @endif
                            @if($item->request_type == '9')
                                Supplier/Vendor
                            @endif
                        </td>
                        <td>

                            @if($item->request_type == '1')
                                
                                @if($item->subrequest_type == '1')
                                    Petty Cash Team HR
                                @endif
                                @if($item->subrequest_type == '2')
                                    Petty Cash Team PL
                                @endif
                                @if($item->subrequest_type == '3')
                                    Petty Cash Team GA
                                @endif
                                @if($item->subrequest_type == '4')
                                    Petty Cash Team IT
                                @endif
                                @if($item->subrequest_type == '5')
                                    Petty Cash TOC
                                @endif
                                @if($item->subrequest_type == '6')
                                    Petty Cash Finance
                                @endif
                                @if($item->subrequest_type == '7')
                                    Petty Cash PA (CEO)
                                @endif
                            @endif
                            @if($item->request_type == '2')
                                Weekly Opex
                                @if($item->subrequest_type == '1')
                                    Opex Region
                                @endif
                                @if($item->subrequest_type == '2')
                                    Opex Comcase
                                @endif
                                @if($item->subrequest_type == '3')
                                    Police Report
                                @endif
                            @endif
                            @if($item->request_type == '3')
                                Other Opex
                                
                                @if($item->subrequest_type == '1')
                                    Consumable Material
                                @endif
                                @if($item->subrequest_type == '2')
                                    Service / Maintenance (Include Tools)
                                @endif
                                @if($item->subrequest_type == '3')
                                    Rapid / Swab
                                @endif
                                @if($item->subrequest_type == '4')
                                    Opex Training
                                @endif
                                @if($item->subrequest_type == '5')
                                    Addwork
                                @endif
                            @endif
                            @if($item->request_type == '4')
                                Rectification
                                @if($item->subrequest_type == '1')
                                    Rectif E2E
                                @endif
                                @if($item->subrequest_type == '2')
                                    Rectif STP
                                @endif
                                @if($item->subrequest_type == '3')
                                    Rectif Car Track
                                @endif
                                @if($item->subrequest_type == '4')
                                    Rectif H3I
                                @endif
                                @if($item->subrequest_type == '5')
                                    Reimburse Solar Genset
                                @endif
                                @if($item->subrequest_type == '6')
                                    Reimburse Electricity
                                @endif
                            @endif
                            @if($item->request_type == '5')
                                Subcont
                                @if($item->subrequest_type == '1')
                                    Subcont
                                @endif
                            @endif
                            @if($item->request_type == '6')
                                Site Keeper
                                @if($item->subrequest_type == '1')
                                    Huawei
                                @endif
                                @if($item->subrequest_type == '2')
                                    Imbas Petir
                                @endif
                            @endif
                            @if($item->request_type == '7')
                                HQ Administration
                                @if($item->subrequest_type == '1')
                                    BPJS Teragakerjaan
                                @endif
                                @if($item->subrequest_type == '2')
                                    BPJS Kesehatan
                                @endif
                                @if($item->subrequest_type == '3')
                                    Life Insurance
                                @endif
                                @if($item->subrequest_type == '4')
                                    Utilities - Electricity
                                @endif
                                @if($item->subrequest_type == '5')
                                    Utilities - Telephone
                                @endif
                                @if($item->subrequest_type == '6')
                                    Utilities - Internet
                                @endif
                                @if($item->subrequest_type == '7')
                                    Application Subscription (IT)
                                @endif
                                @if($item->subrequest_type == '8')
                                    IT/System Purchasing
                                @endif
                                @if($item->subrequest_type == '9')
                                    Staff Claim - Entertainment
                                @endif
                                @if($item->subrequest_type == '10')
                                    Staff Claim - Medical
                                @endif
                                @if($item->subrequest_type == '11')
                                    Staff Claim - Transport
                                @endif
                                @if($item->subrequest_type == '12')
                                    CSR (External & Internal)
                                @endif
                                @if($item->subrequest_type == '13')
                                    Homebase
                                @endif
                                @if($item->subrequest_type == '14')
                                    Office/Warehouse rental
                                @endif
                                @if($item->subrequest_type == '15')
                                    Legal Fee for vehicle
                                @endif
                                @if($item->subrequest_type == '16')
                                    Legal Fee
                                @endif
                                @if($item->subrequest_type == '17')
                                    Notary Fee
                                @endif
                                @if($item->subrequest_type == '18')
                                    Audit ISO
                                @endif
                                @if($item->subrequest_type == '19')
                                    Audit Financial Statement
                                @endif
                                @if($item->subrequest_type == '20')
                                    Appraissal Agent Fee
                                @endif
                                @if($item->subrequest_type == '21')
                                    E-commerce purchasing
                                @endif
                                @if($item->subrequest_type == '22')
                                    All taxes (Finance)
                                @endif
                                @if($item->subrequest_type == '23')
                                    Bank Loan Principle (Finance)
                                @endif
                                @if($item->subrequest_type == '24')
                                    Bank Loan Interest (Finance)
                                @endif
                                @if($item->subrequest_type == '25')
                                    Related/Third Party Loan Principle (Finance)
                                @endif
                                @if($item->subrequest_type == '26')
                                    Related/Third Party Loan Interest (Finance)
                                @endif
                                @if($item->subrequest_type == '27')
                                    Proxy (Finance)
                                @endif
                                @if($item->subrequest_type == '28')
                                    Dividend (Finance)
                                @endif
                                @if($item->subrequest_type == '29')
                                    Deposit (Finance)
                                @endif
                            @endif
                            @if($item->request_type == '8')
                                Payroll
                                @if($item->subrequest_type == '1')
                                    Salary HQ Office
                                @endif
                                @if($item->subrequest_type == '2')
                                    Salary Region / Project
                                @endif
                            @endif
                            @if($item->request_type == '9')
                                Supplier/Vendor
                                
                                @if($item->subrequest_type == '1')
                                    Consumable Material
                                @endif
                                @if($item->subrequest_type == '2')
                                    Inventory
                                @endif
                                @if($item->subrequest_type == '3')
                                    Tools/Project supply
                                @endif
                                @if($item->subrequest_type == '4')
                                    Fixed Assets
                                @endif
                                @if($item->subrequest_type == '5')
                                    Office Supplies
                                @endif
                                @if($item->subrequest_type == '6')
                                    Service/Maintenance
                                @endif
                                @if($item->subrequest_type == '7')
                                    Ownrisk
                                @endif
                                @if($item->subrequest_type == '8')
                                    Ownership
                                @endif
                                @if($item->subrequest_type == '9')
                                    Training
                                @endif
                                @if($item->subrequest_type == '10')
                                    Car Rental (+Personal)
                                @endif
                                @if($item->subrequest_type == '11')
                                    Tools or Equipment Rental
                                @endif
                                @if($item->subrequest_type == '12')
                                    PJK3
                                @endif
                                @if($item->subrequest_type == '13')
                                    Freight/logistic fee
                                @endif
                            @endif
                        </td>
                        <td></td>
                        <td><a href="{{ $item->additional_doc }}"><i class="fa fa-download">{{ $item->doc_name }}</i></a></td>
                        <td></td>
                        <!-- <td>
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
                        <td>{{ $item->hotel_location }}</td> -->
                        
                    </tr>
                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>