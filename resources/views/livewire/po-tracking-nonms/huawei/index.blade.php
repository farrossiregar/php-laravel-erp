@section('title', __('PO Tracking Non MS'))
@section('parentPageTitle', 'Huawei')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#tab_huawei_work_order">Purchase Order</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="tab_huawei_work_order">
                    <div class="header row px-0">
                        <div class="col-md-2">
                            <input type="text" class="form-control" wire:model="keyword" placeholder="Keyword" />
                        </div>
                        <div class="col-md-2">
                            <input type="date" class="form-control" wire:model="date" />
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" wire:model="filter_field_team_id">
                                <option value=""> -- Field Team -- </option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            @if($is_e2e)
                                <a href="#" data-toggle="modal" data-target="#modal-huawei-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import')}}</a>
                            @endif 
                            <span wire:loading>
                                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                                <span class="sr-only">{{ __('Loading...') }}</span>
                            </span>
                        </div>
                    </div>
                    <div class="body pt-0 px-0">    
                        <div class="table-responsive">
                            <table class="table table-striped m-b-0 c_list table-nowrap-th">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th class="text-center">PO Status</th>   
                                        <th>SLO No</th>
                                        <th>PO NO</th>   
                                        <th>PO Detail</th>
                                        <th>PO Aging (day)</th>
                                        <th>PO Aging By Category</th>
                                        <th>PO Aging By Month</th>
                                        <th>PO Month Creation</th>
                                        <th>PO Amount</th>
                                        <th>Margin</th>
                                        <th>PIC Project</th>
                                        <th>Project Code</th>
                                        <th>Region Code</th>
                                        <th>Account</th>
                                        <th>Sub Account</th>
                                        <th>Project Type</th>
                                        <th>PR No</th>
                                        <th>Date of Req PR</th>
                                        <th>Supplier</th>
                                        <th class="text-right">PR Amount</th>
                                        <th>Margin</th>
                                        <th>Status PR</th>
                                        <th>Current PIC Handler</th>
                                        <th>System</th>
                                        <th>Change History</th>
                                        <th>Rep History</th>
                                        <th>Customer</th>
                                        <th>Project Code</th>
                                        <th>Site ID</th>
                                        <th>Sub Contract</th>
                                        <th>PR No</th>
                                        <th>PO Line No</th>
                                        <th>Shipment No</th>
                                        <th>Version No</th>
                                        <th>Item Code</th>
                                        <th>Project Name</th>
                                        <th>Site Code</th>
                                        <th>Site Name</th>
                                        <th>Item Description</th>
                                        <th>Requested QTY</th>
                                        <th>Due QTY</th>
                                        <th>Billed Quantity</th>
                                        <th>Quantity Cancel</th>
                                        <th>Unit</th>
                                        <th class="text-right">Unit Price</th>
                                        <th class="text-right">Line Amount</th>
                                        <th>Center Area</th>
                                        <th>Bidding Area</th>
                                        <th>Publish Date</th>
                                        <th>Acceptance Date</th>
                                        <th>Note to Receiver</th>
                                        <th>PDS ( Categorized it )</th>
                                        <th>PDS Amount</th>
                                        <th>Date Invoice</th>
                                        <th>Invoice No</th>
                                        <th>Line Amount Invoice</th>
                                        <th>Coordinator</th>
                                        <th>Field Team</th>
                                        <th>Scope of Work</th>
                                        <th>Contract No</th>
                                        <th>Contract Date</th>
                                        <th>BAST Number</th>
                                        <th>Work</th>
                                        <th>Project</th>
                                        <th>VAT</th>
                                        <th>WHT</th>
                                        <th>Extra Budget</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $k => $item)
                                        <tr>
                                            <td>{{$k+1}}</td>
                                            <td class="text-center">
                                                @if($item->status==0 || $item->status == null || $item->status == '0')
                                                    <label class="badge badge-info" data-toggle="tooltip" title="Regional / SM - Waiting PR Submission">Waiting PR Submission</label>
                                                @endif
                                                @if($item->status==1)
                                                    <label class="badge badge-warning" data-toggle="tooltip" title="Finance - Profit >= 30%, Waiting to Transfer Budget">Finance In Review</label>
                                                @endif
                                                @if($item->status==2)
                                                    <label class="badge badge-success" data-toggle="tooltip" title="Finance - Profit >= 30%, Waiting to Transfer Budget">Finance - Approved</label>
                                                @endif
                                                @if($item->status==3)
                                                    <label class="badge badge-danger" data-toggle="tooltip" title="PMG - Revise Request, Profit < 30%">PMG Review</label>
                                                @endif
                                                @if($item->status==4)
                                                    <label class="badge badge-warning" data-toggle="tooltip" title="PMG - Waiting PMG Review under 30%">PMG Review </label>
                                                @endif
                                                @if($item->status==5)
                                                    <label class="badge badge-info" data-toggle="tooltip">Budget Transferred To Project Admin/Finance</label>
                                                @endif
                                                @if($item->status==6)
                                                    <label class="badge badge-info" data-toggle="tooltip">Pending Assignment To Field Team</label>
                                                @endif
                                                @if($item->status ==7)
                                                    <label class="badge badge-info">Ongoing Execution</label>
                                                @endif
                                                @if($item->status ==8)
                                                    <label class="badge badge-info" data-toggle="tooltip">Field Team Submitted</label>
                                                @endif
                                                @if($item->status ==9)
                                                    <span class="badge badge-info" title="Waiting BAST Regional">BAST - Regional</span>
                                                @endif
                                                @if($item->status ==10)
                                                    <span class="badge badge-info" title="Waiting Approval BAST Regional">BAST - E2E</span>
                                                @endif
                                                @if($item->status ==11)
                                                    <span class="badge badge-warning" title="Revisi BAST">Revisi</span>
                                                @endif
                                                @if($item->status ==12)
                                                    <span class="badge badge-info" title="Finance Upload Acceptance and Invoice">Finance to Invoice</span>
                                                @endif
                                                @if($item->status ==13)
                                                    <span class="badge badge-success badge-active"><i class="fa fa-check-circle"></i> Invoiced</span>
                                                @endif
                                            </td>
                                            <td>{{$item->slo_no}}</td>
                                            <td>{{$item->po_no}}</td>
                                            <td>{{$item->po_detail}}</td>
                                            <td class="text-center">{{$item->po_aging}}</td>
                                            <td class="text-center">{{$item->po_aging_by_category}}</td>
                                            <td class="text-center">{{$item->po_aging_by_month}}</td>
                                            <td class="text-center">{{$item->po_month_creation}}</td>
                                            <td class="text-right">{{$item->po_amount > 0 ?format_idr($item->po_amount) : '-'}}</td>
                                            <td class="text-center">{{$item->margin > 0 ?format_idr($item->margin) : '-'}}</td>
                                            <td>{{$item->pic_project}}</td>
                                            <td>{{$item->project_code}}</td>
                                            <td>{{$item->region_code}}</td>
                                            <td>{{$item->account_drop_down}}</td>
                                            <td>{{$item->sub_account}}</td>
                                            <td>{{$item->project_type}}</td>
                                            <td>
                                                @if($is_regional)
                                                    <a href="javascript:void(0)" wire:click="$emit('regional_set_budget',{{$item->id}})" title="Edit">
                                                        @if($item->pr_no)
                                                            <span class="text-info"><i class="fa fa-edit"></i></span>        
                                                        @else    
                                                            <span class="badge badge-info badge-active">Request Budget</span>
                                                        @endif
                                                    </a>
                                                @endif
                                                {{$item->pr_no}}
                                            </td>
                                            <td>{{$item->date_of_req_pr?$item->date_of_req_pr : '-'}}</td>
                                            <td>{{$item->supplier?$item->supplier:'-'}}</td>
                                            <td>{{$item->pr_amount > 0 ?format_idr($item->pr_amount) : '-'}}</td>
                                            <td>{{$item->margin}}%</td>
                                            <td>{{$item->status_pr}}</td>
                                            <td>{{$item->current_pic_handler}}</td>
                                            <td>{{$item->system_dropdown}}</td>
                                            <td>{{$item->change_history}}</td>
                                            <td>{{$item->rep_office}}</td>
                                            <td>{{$item->customer}}</td>
                                            <td>{{$item->project_code}}</td>
                                            <td>{{$item->site_id}}</td>
                                            <td>{{$item->sub_contract}}</td>
                                            <td>{{$item->pr_no_integer}}</td>
                                            <td>{{$item->po_line_no}}</td>
                                            <td>{{$item->shipment_no}}</td>
                                            <td>{{$item->version_no}}</td>
                                            <td>{{$item->item_code}}</td>
                                            <td>{{$item->project_name}}</td>
                                            <td>{{$item->site_code}}</td>
                                            <td>{{$item->site_name}}</td>
                                            <td>{{$item->item_description}}</td>
                                            <td>{{$item->request_qty}}</td>
                                            <td>{{$item->due_qty}}</td>
                                            <td>{{$item->billed_qty}}</td>
                                            <td>{{$item->qty_cancel}}</td>
                                            <td>{{$item->unit}}</td>
                                            <td class="text-right">{{$item->unit_price > 0 ?format_idr($item->unit_price) : '-'}}</td>
                                            <td class="text-right">{{$item->line_amount > 0 ?format_idr($item->line_amount) : '-'}}</td>
                                            <td>{{$item->center_area}}</td>
                                            <td>{{$item->bidding_area}}</td>
                                            <td>{{$item->publish_date ? date('d-F-Y',strtotime($item->publish_date)) : '-'}}</td>
                                            <td>{{$item->acceptance_date ? date('d-F-Y',strtotime($item->acceptance_date)) : '-'}}</td>
                                            <td>{{$item->note_to_receiver}}</td>
                                            <td>{{$item->pds_category}}</td>
                                            <td class="text-right">{{$item->pds_amount > 0 ? format_idr($item->pds_amount) : '-'}}</td>
                                            <td>{{$item->date_invoice ? date('d-F-Y',strtotime($item->date_invoice)) : '-'}}</td>
                                            <td>{{$item->invoice_no}}</td>
                                            <td class="text-right">{{$item->line_amount_invoice > 0 ? format_idr($item->line_amount_invoice) : '-'}}</td>
                                            <td>
                                                @if($item->status==5 and $item->coordinator_id =='' and $is_regional)
                                                    <a href="javascript:void(0)" data-target="#modal-select-coordinator" wire:click="$emit('set_id',{{$item->id}})" data-toggle="modal" class="badge badge-info badge-active"><i class="fa fa-plus"></i> coordinator</a>
                                                @else
                                                    {{isset($item->coordinator->name) ? $item->coordinator->nik .' / '. $item->coordinator->name : '-'}}
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->status==6 and $item->field_team_id =='' and $is_regional)
                                                    <a href="javascript:void(0)" data-target="#modal-select-field_team" wire:click="$emit('set_id',{{$item->id}})" data-toggle="modal" class="badge badge-info badge-active"><i class="fa fa-plus"></i> field team</a>
                                                @else
                                                    {{isset($item->field_team->name) ? $item->field_team->nik .' / '. $item->field_team->name : '-'}}
                                                @endif
                                            </td>        
                                            <td>{{$item->scoope_of_work}}</td>    
                                            
                                            <td>{{$item->contract_no}}</td>
                                            <td>{{$item->contract_date?$item->contract_date : '-'}}</td>
                                            <td>
                                                @if($item->status==7 and $is_regional)
                                                    <a href="{{route('po-tracking-nonms.huawei.regional-bast',$item->id)}}" class="badge badge-info badge-active">Create BAST</a>
                                                @endif
                                                {{$item->bast_number}}
                                            </td>
                                            <td>{{$item->works}}</td>
                                            <td>{{isset($item->client_project->name) ? $item->client_project->name : '-'}}</td>
                                            <td class="text-center">{{$item->vat}}</td>
                                            <td class="text-center">{{$item->wht}}</td>
                                            <td>
                                                @if($item->extra_budget)
                                                    {{format_idr($item->extra_budget)}}
                                                @endif
                                                @if($item->extra_budget_file)
                                                    <a href="{{asset($item->extra_budget_file)}}" target="_blank"><i class="fa fa-image"></i></a>
                                                @endif
                                                @if($item->status_extra_budget==1 and $is_finance)
                                                    <a href="javascript:void(0)" class="badge badge-info badge-active" wire:click="$emit('set_id',{{$item->id}})" data-target="#modal_process_extra_budget" data-toggle="modal"><i class="fa fa-check-circle"></i> Acknowledge Extra Budget</a>
                                                @endif
                                                @if($item->status_extra_budget=="" and $is_e2e)
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-extra-budget" wire:click="$emit('set_id',{{$item->id}})" class="badge badge-info badge-active"><i class="fa fa-plus"></i> Extra Budget</a>
                                                @endif
                                                @if($item->status_extra_budget==2)
                                                    <a href="javascript:void(0)" class="text-success" title="Acknowledge"><i class="fa fa-check-circle"></i></a>
                                                @endif
                                            </td>
                                            <td>
                                                @if($is_finance and $item->status==1)
                                                    <a href="javascript:void(0)" wire:click="submit_finance_budget({{$item->id}})" wire:loading.remove wire:target="submit_finance_budget({{$item->id}})" class="badge badge-info badge-active"><i class="fa fa-check-circle"></i> Process Budget</a>
                                                    <span wire:loading wire:target="submit_finance_budget({{$item->id}})">
                                                        <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                                                        <span class="sr-only">{{ __('Loading...') }}</span>
                                                    </span>
                                                @endif
                                                @if($is_finance and $item->status==2)
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#modal_finance_transfer_budget" wire:click="$emit('set_id',{{$item->id}})" class="badge badge-info badge-active"><i class="fa fa-check-circle"></i> Transfer Budget</a>
                                                @endif
                                                @if($item->status==10 and $is_e2e)
                                                    <a href="{{route('po-tracking-nonms.huawei.e2e-bast',$item->id)}}" class="badge badge-info badge-active"><i class="fa fa-arrow-right"></i> Review BAST</a>
                                                @endif
                                                @if($item->status==12 and $is_finance)
                                                    <a href="javascript:void(0)" wire:click="$emit('set_id',{{$item->id}})" data-toggle="modal" data-target="#modal-finance-acceptance-invoice" class="badge badge-info badge-active"><i class="fa fa-arrow-right"></i> Acceptance & Invoice</a>
                                                @endif
                                            </td>








                                            {{--
                                            <td>{{$item->sub_region}}</td>
                                            <td class="text-right">{{format_idr($item->pr_amount)}}</td>
                                            <td>
                                                @if($item->status==5 and $item->coordinator_id =='' and $is_regional)
                                                    <a href="javascript:void(0)" data-target="#modal-select-coordinator" wire:click="$emit('set_id',{{$item->id}})" data-toggle="modal" class="badge badge-info badge-active"><i class="fa fa-plus"></i> coordinator</a>
                                                @else
                                                    {{isset($item->coordinator->name) ? $item->coordinator->nik .' / '. $item->coordinator->name : '-'}}
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->status==6 and $item->field_team_id =='' and $is_regional)
                                                    <a href="javascript:void(0)" data-target="#modal-select-field_team" wire:click="$emit('set_id',{{$item->id}})" data-toggle="modal" class="badge badge-info badge-active"><i class="fa fa-plus"></i> field team</a>
                                                @else
                                                    {{isset($item->field_team->name) ? $item->field_team->nik .' / '. $item->field_team->name : '-'}}
                                                @endif
                                            </td>
                                            <td>{{$item->scoope_of_work}}</td>
                                            <td>{{$item->contract_no}}</td>
                                            <td>{{$item->contract_date?$item->contract_date : '-'}}</td>
                                            <td>
                                                @if($item->status==7 and $is_regional)
                                                    <a href="{{route('po-tracking-nonms.huawei.regional-bast',$item->id)}}" class="badge badge-info badge-active">Create BAST</a>
                                                @endif
                                                {{$item->bast_number}}
                                            </td>
                                            <td>{{$item->bast_date?date('d-M-Y',strtotime($item->bast_date)) : '-'}}</td>
                                            <td>{{$item->gr_number}}</td>
                                            <td>{{$item->gr_date?date('d-M-Y',strtotime($item->gr_date)) : '-'}}</td>
                                            <td>{{$item->works}}</td>
                                            <td>{{isset($item->client_project->name) ? $item->client_project->name : '-'}}</td>
                                            <td class="text-center">{{$item->vat}}</td>
                                            <td class="text-center">{{$item->wht}}</td>
                                            <td>
                                                @if($item->extra_budget)
                                                    {{format_idr($item->extra_budget)}}
                                                @endif
                                                @if($item->extra_budget_file)
                                                    <a href="{{asset($item->extra_budget_file)}}" target="_blank"><i class="fa fa-image"></i></a>
                                                @endif
                                                @if($item->status_extra_budget==1 and $is_finance)
                                                    <a href="javascript:void(0)" class="badge badge-info badge-active" wire:click="$emit('set_id',{{$item->id}})" data-target="#modal_process_extra_budget" data-toggle="modal"><i class="fa fa-check-circle"></i> Acknowledge Extra Budget</a>
                                                @endif
                                                @if($item->status_extra_budget=="" and $is_e2e)
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-extra-budget" wire:click="$emit('set_id',{{$item->id}})" class="badge badge-info badge-active"><i class="fa fa-plus"></i> Extra Budget</a>
                                                @endif
                                                @if($item->status_extra_budget==2)
                                                    <a href="javascript:void(0)" class="text-success" title="Acknowledge"><i class="fa fa-check-circle"></i></a>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->status==10 and $is_e2e)
                                                    <a href="{{route('po-tracking-nonms.huawei.e2e-bast',$item->id)}}" class="badge badge-info badge-active"><i class="fa fa-arrow-right"></i> Review BAST</a>
                                                @endif
                                                @if($item->status==12 and $is_finance)
                                                    <a href="javascript:void(0)" wire:click="$emit('set_id',{{$item->id}})" data-toggle="modal" data-target="#modal-finance-acceptance-invoice" class="badge badge-info badge-active"><i class="fa fa-arrow-right"></i> Acceptance & Invoice</a>
                                                @endif
                                            </td>
                                            --}}


                                            
                                        </tr>
                                    @endforeach 
                                </tbody>
                            </table>
                        </div>
                        <br />
                        {{$data->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewire('po-tracking-nonms.bast')
</div>
@push('after-scripts')
    <script type="text/javascript" src="{{ asset('assets/vendor/select2/js/select2.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}" />
    <script>
        Livewire.on('regional_set_budget',()=>{
            $("#modal_regional_set_budget").modal('show');
        });
    </script>
@endpush
<div class="modal fade" id="modal_process_extra_budget" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @livewire('po-tracking-nonms.huawei.finance-proses-extra-budget')
        </div>
    </div>
</div>
<div class="modal fade" id="modal-extra-budget" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @livewire('po-tracking-nonms.huawei.e2e-extra-budget')
        </div>
    </div>
</div>
<div class="modal fade" id="modal-finance-acceptance-invoice" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @livewire('po-tracking-nonms.huawei.finance-acceptance')
        </div>
    </div>
</div>
<div class="modal fade" id="modal-select-coordinator" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @livewire('po-tracking-nonms.huawei.select-coordinator')
        </div>
    </div>
</div>
<div class="modal fade" id="modal-select-field_team" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @livewire('po-tracking-nonms.huawei.select-fieldteam')
        </div>
    </div>
</div>
<div class="modal fade" id="modal-huawei-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @livewire('po-tracking-nonms.huawei.wo-upload')
        </div>
    </div>
</div>

<div class="modal fade" id="modal_finance_transfer_budget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @livewire('po-tracking-nonms.huawei.finance-transfer-budget')
        </div>
    </div>
</div>
<div class="modal fade" id="modal_regional_set_budget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @livewire('po-tracking-nonms.huawei.regional-set-budget')
        </div>
    </div>
</div>
