<div class="row">
    <div class="col-md-2" wire:ignore>
        <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
    </div>
    <div class="col-md-2">
        <input type="date" class="form-control" wire:model="date" />
    </div>
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
                        <th rowspan="2" class="text-center align-middle">Quotation Number</th>
                        <th rowspan="2" class="text-center align-middle">PO Number</th>
                        <th rowspan="2" class="text-center align-middle" style="background:#d8ffd3 !important">Contract</th>
                        <th rowspan="2" class="text-center align-middle">Note</th>
                        <th rowspan="2" class="text-center align-middle">Date Created</th> 
                        <!-- <th rowspan="2" class="text-center align-middle">Status</th> -->
                        <!-- <th rowspan="2" class="text-center align-middle">Contract</th> -->
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
                        <td>{{ $item->quotation_number }}</td>
                        <td>{{ $item->po_number }}</td>
                        <td>

                        
                            @if($item->status == null || $item->status == '')
                                @if($is_business_dept_access and $item->is_submit_contract ==0)
                                    <label class="badge badge-warning" data-toggle="tooltip" title="On Going">On Going</label>
                                    <a href="javascript:;" wire:click="$emit('modaledit','{{ $item->id }}')" title="Add Contract"><i class="fa fa-plus"></i></a>
                                @else                                
                                    <label class="badge badge-warning" wire:click="$emit('modaledit','{{ $item->id }}')" data-toggle="tooltip" title="On Going">On Going</label>
                                @endif
                            @endif

                            @if($item->status == 1)
                                <label class="badge badge-success" data-toggle="tooltip" title="Closed Project">Closed Project</label>
                            @endif

                            @if($is_business_dept_access)
                                @if($item->contract && $item->ca_tools_budget && $item->ca_vehicle_budget && $item->ca_resource_budget && $item->ca_office_base && $item->ca_opex_budget && $item->ca_timeline && $item->budget_preparation && $item->revenue && $item->resource_preparation && $item->kickof && $item->org_chart && $item->team_dimension)
                                    @if($item->status == '' || $item->status == null)
                                        <a href="javascript:;" wire:click="$emit('modalclosecontract','{{ $item->id }}')" class="text-danger"><i class="fa fa-times"></i></a>
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>{{ $item->remarks }}</td>
                        <td>{{ date_format(date_create($item->date_create), 'd M Y') }}</td>
                        <!-- <td>
                            @if($item->status == null || $item->status == '')
                                <label class="badge badge-warning" data-toggle="tooltip" title="On Going">On Going</label>
                            @endif

                            @if($item->status == 1)
                                <label class="badge badge-success" data-toggle="tooltip" title="Closed Project">Closed Project</label>
                            @endif
                        </td> -->
                        <!-- <td>
                            @if($item->contract)
                                <a href="<?php echo asset('storage/contract_registration_flow/Contract/'.$item->contract); ?>" data-toggle="tooltip" title="Download Contract" class="text-success"><i class="fa fa-check"></i></a>
                            @else
                                @if(check_access('contract-registration-flow.business-dept-access'))
                                    <a href="javascript:;"  wire:click="$emit('modalimportcontract','{{ $item->id }}')" title="Upload" class="text-warning"><i class="fa fa-upload"></i> </a>
                                @endif
                            @endif
                        </td> -->
                        <td>{{ $item->project_code }} - {{ $item->sub_project_code }}</td>
                        <td>{{ $item->po_amount }}</td>
                        <td><label class="badge badge-info" data-toggle="tooltip" title="{{ date_format(date_create($item->start_contract), 'd M Y') }} - {{ date_format(date_create($item->end_contract), 'd M Y') }}">{{ $item->contract_duration }}</label></td>

                        <td>
                            @if($item->ca_tools_budget)
                                <a href="<?php echo asset('storage/contract_registration_flow/Tools_budget/'.$item->ca_tools_budget.''); ?>" data-toggle="tooltip" title="Download Tools Budget" class="text-success"><i class="fa fa-check"></i></a>
                            @else
                                @if($item->contract)
                                    @if(check_access('contract-registration-flow.pmg-access'))
                                        <a href="javascript:;"  wire:click="$emit('modalimporttoolsbudget','{{ $item->id }}')" class="text-warning" title="Upload"><i class="fa fa-upload"></i> </a>
                                    @endif
                                @endif
                            @endif
                            
                        </td>
                        <td>
                            @if($item->ca_vehicle_budget)
                                <a href="<?php echo asset('storage/contract_registration_flow/Vehicle_budget/'.$item->ca_vehicle_budget.''); ?>" data-toggle="tooltip" title="Download Vehicle Budget" class="text-success"><i class="fa fa-check"></i></a>
                            @else
                                @if($item->contract)
                                    @if(check_access('contract-registration-flow.pmg-access'))
                                        <a href="javascript:;"  wire:click="$emit('modalimportvehiclebudget','{{ $item->id }}')" title="Upload" class="text-warning"><i class="fa fa-upload"></i> </a>
                                    @endif
                                @endif
                            @endif
                            
                        </td>
                        <td>
                            @if($item->ca_resource_budget)
                                <a href="<?php echo asset('storage/contract_registration_flow/Resource_Budget/'.$item->ca_resource_budget.''); ?>" data-toggle="tooltip" title="Download Resource Budget" class="text-success"><i class="fa fa-check"></i></a>
                            @else
                                @if($item->contract)
                                    @if(check_access('contract-registration-flow.pmg-access'))
                                        <a href="javascript:;"  wire:click="$emit('modalimportresourcebudget','{{ $item->id }}')" title="Upload" class="text-warning"><i class="fa fa-upload"></i> </a>
                                    @endif
                                @endif
                            @endif
                   
                        </td>
                        <td>
                            @if($item->ca_office_base)
                                <a href="<?php echo asset('storage/contract_registration_flow/Office_base/'.$item->ca_office_base.''); ?>" data-toggle="tooltip" title="Download Office Base" class="text-success"><i class="fa fa-check"></i></a>
                            @else
                                @if($item->contract)
                                    @if(check_access('contract-registration-flow.pmg-access'))
                                        <a href="javascript:;"  wire:click="$emit('modalimportofficebase','{{ $item->id }}')" title="Upload" class="text-warning"><i class="fa fa-upload"></i> </a>
                                    @endif
                                @endif
                            @endif
                            
                        </td>
                        <td>
                            @if($item->ca_opex_budget)
                                <a href="<?php echo asset('storage/contract_registration_flow/Opex_budget/'.$item->ca_opex_budget.''); ?>" data-toggle="tooltip" title="Download Opex Budget" class="text-success"><i class="fa fa-check"></i></a>
                            @else
                                @if($item->contract)
                                    @if(check_access('contract-registration-flow.pmg-access'))
                                        <a href="javascript:;"  wire:click="$emit('modalimportopexbudget','{{ $item->id }}')" title="Upload" class="text-warning"><i class="fa fa-upload"></i> </a>
                                    @endif
                                @endif
                            @endif
                            
                        </td>
                        <td>
                            @if($item->ca_timeline)
                                <a href="<?php echo asset('storage/contract_registration_flow/Timeline/'.$item->ca_timeline.''); ?>" data-toggle="tooltip" title="Download Timeline" class="text-success"><i class="fa fa-check"></i></a>
                            @else
                                @if($item->contract)
                                    @if(check_access('contract-registration-flow.pmg-access'))
                                        <a href="javascript:;"  wire:click="$emit('modalimporttimeline','{{ $item->id }}')" title="Upload" class="text-warning"><i class="fa fa-upload"></i> </a>
                                    @endif
                                @endif
                            @endif
                        </td>

                        <td>
                            @if($item->budget_preparation)
                                <a href="<?php echo asset('storage/contract_registration_flow/Budget_preparation/'.$item->budget_preparation.''); ?>" data-toggle="tooltip" class="text-success" title="Download Budget Preparation"><i class="fa fa-check"></i></a>
                            @else
                                @if($item->ca_tools_budget && $item->ca_vehicle_budget && $item->ca_resource_budget && $item->ca_office_base && $item->ca_opex_budget && $item->ca_timeline)
                                    @if(check_access('contract-registration-flow.finance-access'))
                                        <a href="javascript:;"  wire:click="$emit('modalimportbudgetpreparation','{{ $item->id }}')" class="text-warning" title="Upload"><i class="fa fa-upload"></i> </a>
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($item->revenue)
                                <a href="<?php echo asset('storage/contract_registration_flow/Revenue/'.$item->revenue.''); ?>" data-toggle="tooltip" title="Download Revenue" class="text-success"><i class="fa fa-check"></i></a>
                            @else
                                @if($item->ca_tools_budget && $item->ca_vehicle_budget && $item->ca_resource_budget && $item->ca_office_base && $item->ca_opex_budget && $item->ca_timeline)
                                    @if(check_access('contract-registration-flow.finance-access'))
                                        <a href="javascript:;"  wire:click="$emit('modalimportrevenue','{{ $item->id }}')" title="Upload" class="text-warning"><i class="fa fa-upload"></i> </a>
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($item->resource_preparation)
                                <a href="<?php echo asset('storage/contract_registration_flow/Resource_preparation/'.$item->resource_preparation.''); ?>" data-toggle="tooltip" title="Download Resource Preparation" class="text-success"><i class="fa fa-check"></i></a>
                            @else
                                @if($item->ca_tools_budget && $item->ca_vehicle_budget && $item->ca_resource_budget && $item->ca_office_base && $item->ca_opex_budget && $item->ca_timeline)
                                    @if(check_access('contract-registration-flow.hr-access'))
                                        <a href="javascript:;"  wire:click="$emit('modalimportresourcepreparation','{{ $item->id }}')" title="Upload" class="text-warning"><i class="fa fa-upload"></i></a>
                                    @endif
                                @endif
                            @endif
                            
                        </td>

                        <td>
                            @if($item->kickof)
                                <a href="<?php echo asset('storage/contract_registration_flow/Kickof/'.$item->kickof.''); ?>" data-toggle="tooltip" class="text-success" title="Download Kick Off"><i class="fa fa-check"></i></a>
                            @else
                                @if($item->ca_tools_budget && $item->ca_vehicle_budget && $item->ca_resource_budget && $item->ca_office_base && $item->ca_opex_budget && $item->ca_timeline)
                                    @if(check_access('contract-registration-flow.operations-access'))
                                        <a href="javascript:;"  wire:click="$emit('modalimportkickof','{{ $item->id }}')" title="Upload" class="text-warning"><i class="fa fa-upload"></i> </a>
                                    @endif
                                @endif
                            @endif
                            
                        </td>
                        <td>
                            @if($item->org_chart)
                                <a href="<?php echo asset('storage/contract_registration_flow/Org_chart/'.$item->org_chart.''); ?>" data-toggle="tooltip" title="Download Org Chart" class="text-success"><i class="fa fa-check"></i></a>
                            @else
                                @if($item->ca_tools_budget && $item->ca_vehicle_budget && $item->ca_resource_budget && $item->ca_office_base && $item->ca_opex_budget && $item->ca_timeline)
                                    @if(check_access('contract-registration-flow.operations-access'))
                                        <a href="javascript:;"  wire:click="$emit('modalimportorgchart','{{ $item->id }}')" title="Upload" class="text-warning"><i class="fa fa-upload"></i> </a>
                                    @endif
                                @endif
                            @endif
                            
                        </td>
                        <td>
                            @if($item->team_dimension)
                                <a href="<?php echo asset('storage/contract_registration_flow/Team_dimension/'.$item->team_dimension.''); ?>" data-toggle="tooltip" title="Download Team Dimension" class="text-success"><i class="fa fa-check"></i></a>
                            @else
                                @if($item->ca_tools_budget && $item->ca_vehicle_budget && $item->ca_resource_budget && $item->ca_office_base && $item->ca_opex_budget && $item->ca_timeline)
                                    @if(check_access('contract-registration-flow.operations-access'))
                                        <a href="javascript:;"  wire:click="$emit('modalimportteamdimension','{{ $item->id }}')" title="Upload" class="text-warning"><i class="fa fa-upload"></i> </a>
                                    @endif
                                @endif
                            @endif
                            
                        </td>
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