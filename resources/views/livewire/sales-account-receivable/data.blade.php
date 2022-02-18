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

    
    <div class="col-md-1" style="margin: 0 10px;">
        <a href="javascript:;" wire:click="$emit('modaladdaccountpayable')" class="btn btn-info"><i class="fa fa-plus"></i> Request AP </a>
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
                        <th rowspan="2" class="align-middle">User</th> 
                        <th rowspan="2" class="align-middle">Position</th> 
                        <th rowspan="2" class="align-middle">Project</th> 

                        <th rowspan="2" class="align-middle">Request Type</th> 
                        <!-- <th rowspan="2" class="align-middle">Sub Request Type</th>                          -->
                        
                        <th rowspan="2" class="align-middle">Additional Document</th> 
                        <th rowspan="2" class="align-middle">Detail Payment</th> 
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
                        <td>
                            @if(check_access('account-payable.pmg'))
                                @if($item->status == '')
                                   
                                    <a href="javascript:;" wire:click="$emit('modalapproveaccountpayable',['{{ $item->id }}', '1'])"><i class="fa fa-check " style="color: #22af46;"></i></a>
                                    <a href="javascript:;" wire:click="$emit('modaldeclineaccountpayable','{{ $item->id }}')"><i class="fa fa-close " style="color: #de4848;"></i></a>
                                @endif

                            @endif

                            <!-- Revise User -->
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

                            <!-- if(check_access('account-payable.sr-fin-acc-mngr')) -->
                                @if($item->status == '2')

                                    @if(check_access('account-payable.fin-spv'))    
                                        @if($item->request_type == '1')
                                            @if(!\App\Models\AccountPayablePettycash::where('id_master', $item->id)->first())
                                                <a href="javascript:;" wire:click="$emit('modaladdpettycashaccountpayable','{{ $item->id }}')"><i class="fa fa-edit " style="color: #22af46;"></i></a>
                                            @endif
                                        @endif

                                        @if($item->request_type == '2')
                                            @if(!\App\Models\AccountPayableWeeklyopex::where('id_master', $item->id)->first())
                                                <a href="javascript:;" wire:click="$emit('modaladdweeklyopexaccountpayable','{{ $item->id }}')"><i class="fa fa-edit " style="color: #22af46;"></i></a>
                                            @endif
                                        @endif

                                        @if($item->request_type == '3')
                                            @if(!\App\Models\AccountPayableOtheropex::where('id_master', $item->id)->first())
                                                <a href="javascript:;" wire:click="$emit('modaladdotheropexaccountpayable','{{ $item->id }}')"><i class="fa fa-edit " style="color: #22af46;"></i></a>
                                            @endif
                                        @endif
                                    @endif


                                    @if(check_access('account-payable.fin-mngr'))
                                        @if($item->request_type == '4')
                                            @if(!\App\Models\AccountPayableRectification::where('id_master', $item->id)->first())
                                                <a href="javascript:;" wire:click="$emit('modaladdrectificationaccountpayable','{{ $item->id }}')"><i class="fa fa-edit " style="color: #22af46;"></i></a>
                                            @endif
                                        @endif

                                        @if($item->request_type == '5')
                                            @if(!\App\Models\AccountPayableSubcont::where('id_master', $item->id)->first())
                                                <a href="javascript:;" wire:click="$emit('modaladdsubcontaccountpayable','{{ $item->id }}')"><i class="fa fa-edit " style="color: #22af46;"></i></a>
                                            @endif
                                        @endif

                                        @if($item->request_type == '6')
                                            @if(!\App\Models\AccountPayableSitekeeper::where('id_master', $item->id)->first())
                                                <a href="javascript:;" wire:click="$emit('modaladdsitekeeperaccountpayable','{{ $item->id }}')"><i class="fa fa-edit " style="color: #22af46;"></i></a>
                                            @endif
                                        @endif
                                    @endif

                                    @if(check_access('account-payable.sr-fin-acc-mngr'))
                                        @if($item->request_type == '7')
                                            @if(!\App\Models\AccountPayableHqadministration::where('id_master', $item->id)->first())
                                                <a href="javascript:;" wire:click="$emit('modaladdhqadministrationaccountpayable','{{ $item->id }}')"><i class="fa fa-edit " style="color: #22af46;"></i></a>
                                            @endif
                                        @endif

                                        @if($item->request_type == '8')
                                            @if(!\App\Models\AccountPayablePayroll::where('id_master', $item->id)->first())
                                                <a href="javascript:;" wire:click="$emit('modaladdpayrollaccountpayable','{{ $item->id }}')"><i class="fa fa-edit " style="color: #22af46;"></i></a>
                                            @endif
                                        @endif

                                        @if($item->request_type == '9')
                                            @if(!\App\Models\AccountPayableSuppliervendor::where('id_master', $item->id)->first())
                                                <a href="javascript:;" wire:click="$emit('modaladdsuppliervendoraccountpayable','{{ $item->id }}')"><i class="fa fa-edit " style="color: #22af46;"></i></a>
                                            @endif
                                        @endif
                                            
                                    @endif

                                @endif
                            <!-- endif -->
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
                        
                        <td class="align-middle">
                            <b>
                            @if($item->request_type == '1')
                                @if($item->update_req == '1')
                                    <a href="javascript:;" wire:click="$emit('modaladdpettycashaccountpayable','{{ $item->id }}')">
                                    Petty Cash
                                    </a>
                                @else
                                    Petty Cash
                                @endif
                            @endif
                            @if($item->request_type == '2')
                                @if($item->update_req == '1')
                                    <a href="javascript:;" wire:click="$emit('modaladdweeklyopexaccountpayable','{{ $item->id }}')">
                                    Weekly Opex
                                    </a>
                                @else
                                    Weekly Opex
                                @endif
                            @endif
                            @if($item->request_type == '3')
                                @if($item->update_req == '1')
                                    <a href="javascript:;" wire:click="$emit('modaladdotheropexaccountpayable','{{ $item->id }}')">
                                    Other Opex
                                    </a>
                                @else
                                    Other Opex
                                @endif
                            @endif
                            @if($item->request_type == '4')
                                @if($item->update_req == '1')
                                    <a href="javascript:;" wire:click="$emit('modaladdrectificationaccountpayable','{{ $item->id }}')">
                                    Rectification
                                    </a>
                                @else
                                    Rectification
                                @endif
                            @endif
                            @if($item->request_type == '5')
                                @if($item->update_req == '1')
                                    <a href="javascript:;" wire:click="$emit('modaladdsubcontaccountpayable','{{ $item->id }}')">
                                    Subcont
                                    </a>
                                @else
                                    Subcont
                                @endif
                            @endif
                            @if($item->request_type == '6')
                                @if($item->update_req == '1')
                                    <a href="javascript:;" wire:click="$emit('modaladdsitekeeperaccountpayable','{{ $item->id }}')">
                                        Site Keeper
                                    </a>
                                @else
                                    Site Keeper
                                @endif
                            @endif
                            @if($item->request_type == '7')
                                @if($item->update_req == '1')
                                    <a href="javascript:;" wire:click="$emit('modaladdhqadministrationaccountpayable','{{ $item->id }}')">
                                        HQ Administration
                                    </a>
                                @else
                                    HQ Administration
                                @endif
                            @endif
                            @if($item->request_type == '8')
                                @if($item->update_req == '1')
                                    <a href="javascript:;" wire:click="$emit('modaladdpayrollaccountpayable','{{ $item->id }}')">
                                        Payroll
                                    </a>
                                @else
                                    Payroll
                                @endif
                            @endif
                            @if($item->request_type == '9')
                                @if($item->update_req == '1')
                                    <a href="javascript:;" wire:click="$emit('modaladdsuppliervendoraccountpayable','{{ $item->id }}')">
                                        Supplier/Vendor
                                    </a>
                                @else
                                    Supplier/Vendor
                                @endif
                            @endif
                            </b>
                            
                            <br>

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
                        <td><a href="<?php echo asset('storage/Account_Payable/'.$item->additional_doc) ?>" target="_blank"><i class="fa fa-download"></i> {{ strtoupper($item->doc_name) }}</a></td>
                        <td>
                            @if(check_access('account-payable.treasury'))
                                @if($item->bank_account_name != '' && $item->bank_account_number != '' && $item->bank_name != '')
                                    <a href="javascript:;" wire:click="$emit('modaltreasuryaccountpayable','{{ $item->id }}')"><i class="fa fa-eye " style="color: #17a2b8;"></i></a>
                                @else
                                    <a href="javascript:;" wire:click="$emit('modaltreasuryaccountpayable','{{ $item->id }}')"><i class="fa fa-edit" style="color: #22af46;"></i></a>
                                @endif
                            @endif
                        </td>
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