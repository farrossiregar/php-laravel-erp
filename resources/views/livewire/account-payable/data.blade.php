<div class="row">
    <div class="col-md-1">                
        <select class="form-control" wire:model="filteryear">
            <option value=""> --- Year --- </option>
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
    <div class="col-md-1">
        <a href="javascript:;" data-toggle="modal" data-target="#modal_add" class="btn btn-info"><i class="fa fa-plus"></i> Request AP </a>
    </div>  
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table m-b-0 c_list">
                <thead style="background: #eee;">
                    <tr>
                        <th class="align-middle">No</th>
                        <th class="align-middle">Status</th> 
                        <th class="align-middle">Date Create</th>
                        <th class="align-middle">Cash Transaction No</th>
                        <!-- <th class="align-middle">NIK / Name</th>  -->
                        <!-- <th class="align-middle">Position</th>  -->
                        <!-- <th class="align-middle">Project</th>  -->
                        <th class="align-middle">Request Type</th>
                        <th class="text-center">Additional Document</th> 
                        <th class="align-middle">Description</th> 
                        <th class="text-right">Amount</th> 
                        <th class="align-middle"></th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                @if($item->status==0)
                                    <span class="badge badge-warning">Waiting AP Staff</span>
                                @endif
                                @if($item->status==1)
                                    <span class="badge badge-info">Finance in review</span>
                                @endif
                                @if($item->status==2)
                                    <span class="badge badge-success">Settled</span>
                                @endif
                                @if($item->status==3)
                                    <span class="badge badge-danger" onclick="alert('{{$item->app_staff_note}}')" title="{{$item->app_staff_note}}">Reject</span>
                                @endif
                                @if($item->status==4)
                                    <span class="badge badge-warning">Waiting PMG</span>
                                @endif
                            </td>
                            <td>{{ date_format(date_create($item->created_at), 'd M Y') }}</td>
                            <td>{{ $item->cash_transaction_no }}</td>    
                            <td class="align-middle">
                                @if($item->request_type == 1)
                                    @if($item->update_req == '1')
                                        <a href="javascript:;" wire:click="$emit('modaladdpettycashaccountpayable','{{ $item->id }}')">
                                        Petty Cash
                                        </a>
                                    @else
                                        Petty Cash
                                    @endif
                                    {{isset($item->petty_cash_type->name) ? " / {$item->petty_cash_type->name}" : ''}}
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
                            </td>
                            <td class="text-center">
                                @if($item->additional_doc)
                                    <a href="{{ asset($item->additional_doc)}}" target="_blank"><i class="fa fa-download"></i> {{ strtoupper($item->doc_name) }}</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @php($total=0)
                                @if($item->request_type==1)
                                    @if(isset($item->petty_cash->items))
                                        @php($description_ = [])
                                        @foreach($item->petty_cash->items as $i)
                                            @php($description_[] = $i->description)
                                            @php($total += $i->amount)
                                        @endforeach
                                        {{implode(", ", $description_)}}
                                    @endif
                                @endif
                                @if($item->request_type==2)
                                    @if(isset($item->weekly_opex->items))
                                        @php($description_ = [])
                                        @foreach($item->weekly_opex->items as $i)
                                            @php($description_[] = $i->description)
                                            @php($total += $i->amount)
                                        @endforeach
                                        {{implode(", ", $description_)}}
                                    @endif
                                @endif
                            </td>    
                            <td class="text-right">{{format_idr($total)}}</td>
                            <td>
                                @if($is_pmg and $item->status == 4)
                                    <a href="javascript:void(0)" wire:click="$emit('check_id',{{$item->id}})" class="badge badge-info badge-active" data-toggle="modal" data-target="#modal_process_pmg"><i class="fa fa-check-circle"></i> Process</a>
                                @endif

                                @if($is_apstaff)
                                    @if($item->status == '')
                                        <a href="javascript:;" wire:click="$emit('modalapproveaccountpayable',['{{ $item->id }}', '1'])" class="badge badge-info badge-active"><i class="fa fa-check-circle"></i> Approve</a>
                                        <a href="javascript:;" wire:click="$emit('modaldeclineaccountpayable','{{ $item->id }}')" class="badge badge-danger badge-active"><i class="fa fa-close"></i> Reject</a>
                                    @endif
                                @endif
                                
                                <!-- Revise User -->
                                @if(!check_access('account-payable.fin-spv') || !check_access('account-payable.fin-mngr') || !check_access('account-payable.sr-fin-acc-mngr'))
                                    @if($item->status == '0')
                                        <!-- <a href="javascript:;" wire:click="$emit('modalrevisiaccountpayable','{{ $item->id }}')"><i class="fa fa-edit " style="color: #de4848;"></i></a> -->
                                    @endif
                                @endif
                                
                                @if($is_finance_spv || $is_finance_manager || $is_finance_accounting_manager)
                                    @if($item->status == '1')
                                        <!-- <a href="javascript:;" wire:click="$emit('modalapproveaccountpayable',['{{ $item->id }}', '2'])"><i class="fa fa-check " style="color: #22af46;"></i></a>
                                        <a href="javascript:;" wire:click="$emit('modaldeclineaccountpayable','{{ $item->id }}')"><i class="fa fa-close " style="color: #de4848;"></i></a> -->
                                        <a href="javascript:;" wire:click="$emit('modalapproveaccountpayable',['{{ $item->id }}', '2'])" class="badge badge-info badge-active"><i class="fa fa-check-circle"></i> Approve</a>
                                        <a href="javascript:;" wire:click="$emit('modaldeclineaccountpayable','{{ $item->id }}')" class="badge badge-danger badge-active"><i class="fa fa-close"></i> Reject</a>
                                    @endif
                                @endif

                                @if($item->status == '2')
                                    @if($is_finance_spv)    
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

                                    @if($is_finance_manager)
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

                                    @if($is_finance_accounting_manager)
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:account-payable.add />
        </div>
    </div>
</div>
<div class="modal fade" id="modal_process_pmg" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @livewire('account-payable.pmg-process')
        </div>
    </div>
</div>