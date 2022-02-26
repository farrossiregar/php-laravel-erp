<div class="row">
    <!-- <div class="col-md-2">
        <input type="date" class="form-control" wire:model="date" />
    </div> -->

    <div class="col-md-1">                
        <select class="form-control" wire:model="filteryear">
            <option value=""> --- Year --- </option>
            <option value="2022">2022</option>
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

    <div class="col-md-2 form-group">
        
        <select onclick="" class="form-control" wire:model="request_type">
            <option value=""> --- Request Type --- </option>
            <option value="1">Petty Cash</option>
            <option value="2">Weekly Opex</option>
            <option value="3">Other Opex</option>
            <option value="4">Rectification</option>
            <option value="5">Subcont</option>
            <option value="6">Site Keeper</option>
            <option value="7">HQ Administration</option>
            <option value="8">Payroll</option>
            <option value="9">Supplier/Vendor</option>
            
        </select>
    </div>

    @if(check_access('sales-account-receivable.e2e'))
    <div class="col-md-1" style="margin: 0 10px;">
        <a href="javascript:;" wire:click="$emit('modaladdaccountpayable')" class="btn btn-info"><i class="fa fa-plus"></i> Invoice Listing </a>
    </div>  
    @endif
    
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-bordered table-striped m-b-0 c_list">
                <thead>

                    <tr>
                        <th rowspan="2" class="align-middle">No</th>
                        <th rowspan="2" class="align-middle">Status</th> 
                        <!-- <th rowspan="2" class="align-middle">Action</th>  -->
                        <th rowspan="2" class="align-middle">Date Create</th>
                        <th rowspan="2" class="align-middle">Customer Name</th> 
                        <th rowspan="2" class="align-middle" style="text-align:center;">Project</th> 
                        <th rowspan="2" class="align-middle" style="text-align:center;">Invoice</th> 
                        <th rowspan="2" class="align-middle">Period</th> 
                        <th rowspan="2" class="align-middle" style="text-align:center;">PO</th> 
                        <th rowspan="2" class="align-middle">Payment</th> 
                        <th rowspan="2" class="align-middle">Aging</th> 
                        <th rowspan="2" class="align-middle">Sales Invoice</th> 
                        <th rowspan="2" class="align-middle">Credit Note</th> 
                        
                    </tr>
                   
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            @if($item->status == '2')
                                <?php
                                    if($item->request_type == '1' || $item->request_type == '2' || $item->request_type == '3'){
                                        $fin_app = 'Finance Supervisor';
                                    }

                                    if($item->request_type == '4' || $item->request_type == '5' || $item->request_type == '6'){
                                        $fin_app = 'Finance Manager';
                                    }

                                    if($item->request_type == '7' || $item->request_type == '8' || $item->request_type == '9'){
                                        $fin_app = 'Sr Finance & Acc Manager';
                                    }
                                ?>
                                <label class="badge badge-success" data-toggle="tooltip" title="Account Payable Request is Approved by {{$fin_app}}">Approved by {{$fin_app}}</label>
                            @endif

                            @if($item->status == '1')
                                <label class="badge badge-success" data-toggle="tooltip" title="Account Payable Request is Approved by PMG">Approved by PMG</label>
                            @endif

                            @if($item->status == '0')
                                <label class="badge badge-danger" data-toggle="tooltip" title="{{$item->note}}">Decline</label>
                            @endif

                            @if($item->status == '' || $item->status == 'null')
                                <label class="badge badge-warning" data-toggle="tooltip" title="Waiting to Approve">Waiting to Approve</label>
                            @endif
                        </td>
                        <!-- <td>
                            @if(check_access('account-payable.pmg'))
                                @if($item->status == '')
                                   
                                    <a href="javascript:;" wire:click="$emit('modalapproveaccountpayable',['{{ $item->id }}', '1'])"><i class="fa fa-check " style="color: #22af46;"></i></a>
                                    <a href="javascript:;" wire:click="$emit('modaldeclineaccountpayable','{{ $item->id }}')"><i class="fa fa-close " style="color: #de4848;"></i></a>
                                @endif

                            @endif

                            
                            @if(!check_access('account-payable.fin-spv') || !check_access('account-payable.fin-mngr') || !check_access('account-payable.sr-fin-acc-mngr'))
                                @if($item->status == '0')
                                    <a href="javascript:;" wire:click="$emit('modalrevisiaccountpayable','{{ $item->id }}')"><i class="fa fa-edit " style="color: #de4848;"></i></a>
                                @endif
                            @endif
                            

                            
                            @if(check_access('account-payable.fin-spv') || check_access('account-payable.fin-mngr') || check_access('account-payable.sr-fin-acc-mngr'))
                                @if($item->status == '1')
                                   
                                    <a href="javascript:;" wire:click="$emit('modalapproveaccountpayable',['{{ $item->id }}', '2'])"><i class="fa fa-check " style="color: #22af46;"></i></a>
                                    <a href="javascript:;" wire:click="$emit('modaldeclineaccountpayable','{{ $item->id }}')"><i class="fa fa-close " style="color: #de4848;"></i></a>
                                @endif
                            @endif
                        </td> -->
                        <td>{{ date_format(date_create($item->created_at), 'd M Y') }}</td>
                        <td>
                            {{ $item->cust_name }}
                        </td>
                        <td style="text-align:center;" class="align-middle">
                            <b>{{ $item->project_name }}</b><br>
                            {{ $item->region }}
                        </td>
                        <td style="text-align:center;" class="align-middle">
                            <b>{{ $item->invoice_no }}</b><br>
                            {{ $item->tax_invoice_no }}
                        </td>
                        <td><b>{{ date('F', mktime(0, 0, 0, $item->month, 10)) }} {{ $item->year }}</b></td>
                        <td style="text-align:center;" >
                            <b>{{ $item->po_no }}</b><br>
                            {{ date_format(date_create($item->po_date), 'd M Y') }}
                        </td>
                        <td>
                            @if(check_access('sales-account-receivable.treasury'))
                                <a href="javascript:;" wire:click="$emit('modaltreasuryaccountpayable','{{ $item->id }}')"><i class="fa fa-edit" style="color: #22af46;"></i></a>
                            @endif
                        </td>
                        <td>
                            @if(check_access('sales-account-receivable.acc'))
                                <a href="javascript:;" wire:click="$emit('modaltreasuryaccountpayable','{{ $item->id }}')"><i class="fa fa-edit" style="color: #22af46;"></i></a>
                            @endif
                        </td>
                        <td>
                            <a href="#" wire:click="exportsalesinvoice({{ $item->id }})" title="Export Sales Invoice" ><i style="color: #17a2b8;" class="fa fa-download"></i> </a>
                        </td>
                        <td>
                            <a href="#" wire:click="exportcreditnote({{ $item->id }})" title="Export Credit Note" ><i style="color: #17a2b8;" class="fa fa-download"></i> </a>
                        </td>
                        
                        <!-- 
                        <td>
                            

                            
                        </td>
                        
                        <td>{{ date_format(date_create($item->created_at), 'd M Y') }}</td>
                        <td class="align-middle">
                            <b>{{ $item->name }}</b><br>
                            {{ $item->nik }}
                        </td>
                        <td>
                            <b>{{ @\App\Models\Department::where('id', \App\Models\Employee::where('nik', $item->nik)->first()->department_id)->first()->name }}</b><br>
                            {{ @\App\Models\UserAccess::where('id', $item->position)->orderBy('id', 'asc')->first()->name }}
                        </td>
                        
                        <td class="align-middle">
                            <b>{{ $item->project }}</b><br>
                            {{ $item->region }}
                        </td>
                        
                        <td><a href="<?php echo asset('storage/Account_Payable/'.$item->additional_doc) ?>" target="_blank"><i class="fa fa-download"></i> {{ strtoupper($item->doc_name) }}</a></td>
                        <td>
                            @if(check_access('account-payable.treasury'))
                                @if($item->bank_account_name != '' && $item->bank_account_number != '' && $item->bank_name != '')
                                    <a href="javascript:;" wire:click="$emit('modaltreasuryaccountpayable','{{ $item->id }}')"><i class="fa fa-eye " style="color: #17a2b8;"></i></a>
                                @else
                                    <a href="javascript:;" wire:click="$emit('modaltreasuryaccountpayable','{{ $item->id }}')"><i class="fa fa-edit" style="color: #22af46;"></i></a>
                                @endif
                            @endif
                        </td> -->
                        <!-- 
                        

                        <td><?php if($item->flight_price){ echo 'Rp,'.format_idr($item->flight_price); }else{ echo ''; } ?></td>
                       
                         -->
                        
                    </tr>
                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>