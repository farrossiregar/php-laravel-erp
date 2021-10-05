<div class="row">
    <div class="col-md-2">
        <input type="date" class="form-control" wire:model="date" />
    </div>

<!--     
    <div class="col-md-1">                
        <select class="form-control" wire:model="year">
            <option value=""> --- Year --- </option>
            @foreach(\App\Models\EmployeeNoc::select('year')->groupBy('year')->get() as $item) 
            <option>{{$item->year}}</option>
            @endforeach 
        </select>
    </div> -->


    
    <div class="col-md-2">
        <!-- <a href="#" data-toggle="modal" data-target="#modal-contractregistrationflow-input" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Input New Opportunity')}}</a> -->
    </div>
    
    
    
    <style>
        td {
            text-align: center;
        }
    </style>
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped table-bordered m-b-0 c_list">
                <thead>
                    <tr>
                        <th rowspan="2" class="align-middle">No</th>
                        <th rowspan="2" class="text-center align-middle">Remarks</th>
                        <th rowspan="2" class="text-center align-middle">Action</th>
                        <th rowspan="2" class="text-center align-middle">Date Created</th> 
                        
                        <th rowspan="2" class="text-center align-middle">ID Business Opportunity</th>
                        <th rowspan="2" class="text-center align-middle">Status</th>
                        <th rowspan="2" class="text-center align-middle">Contract</th>
                        <th rowspan="2" class="text-center align-middle">Project Code - Sub Project Code</th>
                        <th rowspan="2" class="text-center align-middle">PO Amount</th>
                        <th rowspan="2" class="text-center align-middle">Contract Duration</th>

                        <th colspan="6" class="text-center">Approved Cost Analysis</th>
                        <th colspan="2" class="text-center">Budget Preparation</th>

                        <th rowspan="2" class="align-middle">Resource Preparation</th>
                        <th colspan="3" class="text-center">Kick Off Meeting & Socialization</th>
                        


                    </tr>
                    <tr>

                        <th class="text-center align-middle">Tools Budget</th>
                        <th class="text-center align-middle">Vehicle Budget</th>
                        <th class="text-center align-middle">Resource Budget</th>
                        <th class="text-center align-middle">Office Base</th>
                        <th class="text-center align-middle">Opex Budget</th>
                        <th class="text-center align-middle">Timeline</th>

                        <th class="text-center align-middle">Budget Preparation</th>
                        <th class="text-center align-middle">Revenue</th>

                        <th class="text-center align-middle">Kickoff Meeting</th>
                        <th class="text-center align-middle">Org Chart</th>
                        <th class="text-center align-middle">Team Dimensioning & Structure</th>

                    </tr>
                </thead>
                <tbody>
                   
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            @if(check_access('duty-roster.audit'))
                                <input type="checkbox"  wire:click="checkdata({{ $item->id }})" wire:model="data_id.{{ $item->id }}" />
                            @else
                                @if($item->remarks == '1')
                                    <a href="javascript:;" class="btn btn-danger"><i class="fa fa-close"></i></a>
                                @else
                                    <a href="javascript:;" class="btn btn-success"><i class="fa fa-check"></i></a>
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($item->contract && $item->ca_tools_budget && $item->ca_vehicle_budget && $item->ca_resource_budget && $item->ca_office_base && $item->ca_opex_budget && $item->timeline && $item->budget_preparation && $item->revenue && $item->resource_preparation && $item->kickof && $item->org_chart && $item->team_dimension)
                                @if($item->status == '' || $item->status == null)
                                    <a href="javascript:;" wire:click="$emit('modalclosecontract','{{ $item->id }}')" class="btn btn-info"><i class="fa fa-check"></i> Close Contract</a>
                                @endif
                            @endif

                            <a href="javascript:;" wire:click="$emit('modaledit','{{ $item->id }}')" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                        </td>
                        <td>
                            @if($item->status == null || $item->status == '')
                                <label class="badge badge-warning" data-toggle="tooltip" title="On Going">On Going</label>
                            @endif

                            @if($item->status == 1)
                                <label class="badge badge-success" data-toggle="tooltip" title="Closed">Closed</label>
                            @endif
                        </td>
                        <td>{{ $item->id_bo }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            @if($item->contract)
                                <a href="<?php echo asset('storage/contract_registration_flow/Contract/'.$item->contract.''); ?>" data-toggle="tooltip" title="Download Contract"><i class="fa fa-download"></i> {{__('Download Contract')}}</a>
                            @else
                                <!-- if(check_access('po-tracking-ms.import-pds') && $item->status == '3') -->
                                    <a href="javascript:;"  wire:click="$emit('modalimportcontract','{{ $item->id }}')" title="Upload" class="btn btn-primary"><i class="fa fa-upload"></i> </a>
                                <!-- endif -->
                            @endif
                         
                        </td>
                        <td>{{ $item->project_code }} - {{ $item->sub_project_code }}</td>
                        <td>{{ $item->po_amount }}</td>
                        <td>{{ $item->contract_duration }}</td>

                        <td>
                            @if($item->ca_tools_budget)
                                <a href="<?php echo asset('storage/contract_registration_flow/Tools_Budget/'.$item->ca_tools_budget.''); ?>" data-toggle="tooltip" title="Download Tools Budget"><i class="fa fa-download"></i> {{__('Download Tools Budget')}}</a>
                            @else
                                @if($item->contract)
                                    <!-- if(check_access('po-tracking-ms.import-pds') && $item->status == '3') -->
                                        <a href="javascript:;"  wire:click="$emit('modaluploadpds','{{ $item->id }}')" title="Upload" class="btn btn-primary"><i class="fa fa-upload"></i> </a>
                                    <!-- endif -->
                                @endif
                            @endif
                            
                        </td>
                        <td>
                            @if($item->ca_vehicle_budget)
                                <a href="<?php echo asset('storage/contract_registration_flow/Vehicle_Budget/'.$item->ca_vehicle_budget.''); ?>" data-toggle="tooltip" title="Download Vehicle Budget"><i class="fa fa-download"></i> {{__('Download Vehicle Budget')}}</a>
                            @else
                                @if($item->contract)
                                    <!-- if(check_access('po-tracking-ms.import-pds') && $item->status == '3') -->
                                        <a href="javascript:;"  wire:click="$emit('modaluploadpds','{{ $item->id }}')" title="Upload" class="btn btn-primary"><i class="fa fa-upload"></i> </a>
                                    <!-- endif -->
                                @endif
                            @endif
                            
                        </td>
                        <td>
                            @if($item->ca_resource_budget)
                                <a href="<?php echo asset('storage/contract_registration_flow/Resource_Budget/'.$item->ca_resource_budget.''); ?>" data-toggle="tooltip" title="Download Resource Budget"><i class="fa fa-download"></i> {{__('Download Resource Budget')}}</a>
                            @else
                                @if($item->contract)
                                    <!-- if(check_access('po-tracking-ms.import-pds') && $item->status == '3') -->
                                        <a href="javascript:;"  wire:click="$emit('modaluploadpds','{{ $item->id }}')" title="Upload" class="btn btn-primary"><i class="fa fa-upload"></i> </a>
                                    <!-- endif -->
                                @endif
                            @endif
                   
                        </td>
                        <td>
                            @if($item->ca_office_base)
                                <a href="<?php echo asset('storage/contract_registration_flow/Office_Base/'.$item->ca_office_base.''); ?>" data-toggle="tooltip" title="Download Office Base"><i class="fa fa-download"></i> {{__('Download Office Base')}}</a>
                            @else
                                @if($item->contract)
                                    <!-- if(check_access('po-tracking-ms.import-pds') && $item->status == '3') -->
                                        <a href="javascript:;"  wire:click="$emit('modaluploadpds','{{ $item->id }}')" title="Upload" class="btn btn-primary"><i class="fa fa-upload"></i> </a>
                                    <!-- endif -->
                                @endif
                            @endif
                            
                        </td>
                        <td>
                            @if($item->opex_budget)
                                <a href="<?php echo asset('storage/contract_registration_flow/Opex_Budget/'.$item->opex_budget.''); ?>" data-toggle="tooltip" title="Download Opex Budget"><i class="fa fa-download"></i> {{__('Download Opex Budget')}}</a>
                            @else
                                @if($item->contract)
                                    <!-- if(check_access('po-tracking-ms.import-pds') && $item->status == '3') -->
                                        <a href="javascript:;"  wire:click="$emit('modaluploadpds','{{ $item->id }}')" title="Upload" class="btn btn-primary"><i class="fa fa-upload"></i> </a>
                                    <!-- endif -->
                                @endif
                            @endif
                            
                        </td>
                        <td>
                            @if($item->timeline)
                                <a href="<?php echo asset('storage/contract_registration_flow/Timeline/'.$item->timeline.''); ?>" data-toggle="tooltip" title="Download Timeline"><i class="fa fa-download"></i> {{__('Download Timenline')}}</a>
                            @else
                                @if($item->contract)
                                    <!-- if(check_access('po-tracking-ms.import-pds') && $item->status == '3') -->
                                        <a href="javascript:;"  wire:click="$emit('modaluploadpds','{{ $item->id }}')" title="Upload" class="btn btn-primary"><i class="fa fa-upload"></i> </a>
                                    <!-- endif -->
                                @endif
                            @endif
                            
                        </td>

                        <td>{{ $item->budget_preparation }}</td>
                        <td>{{ $item->revenue }}</td>

                        <td>{{ $item->resource_preparation }}</td>

                        <td>{{ $item->kickof }}</td>
                        <td>{{ $item->org_chart }}</td>
                        <td>{{ $item->team_dimension }}</td>
                        <!-- <td>
                            
                            @if(check_access('duty-roster.approve'))
                                @if($item->status == '')
                                    <a href="javascript:;" wire:click="$emit('modalwonbo','{{ $item->id }}')" class="btn btn-success"><i class="fa fa-check"></i> Won</a>
                                    <a href="javascript:;" wire:click="$emit('modalfailedbo','{{ $item->id }}')" class="btn btn-danger"><i class="fa fa-close"></i> Failed</a>
                                @endif

                            @endif

                            @if(check_access('duty-roster.import'))
                                @if($item->status == '0')
                                    
                                @endif
                            @endif
                        </td>  -->
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>