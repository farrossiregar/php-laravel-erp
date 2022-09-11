@section('title', __('PO Tracking Non MS'))
@section('parentPageTitle', 'Huawei')
<div class=" clearfix">
    <div class="card">
        <div class="body">    
            <div class="row">
                <div class="col-md-4">
                    <table class="table table-striped m-b-0 c_list table-nowrap-th">
                        <tr>
                            <th>PO Number</th>
                            <td> : {{$data->po_no}}</td>
                        </tr>
                        <tr>
                            <th>PIC Project</th>
                            <td> : {{$data->pic_project}}</td>
                        </tr>
                        <tr>
                            <th>Sub Region</th>
                            <td> : {{$data->sub_region}}</td>
                        </tr>
                        <tr>
                            <th>PO Amount</th>
                            <td> : {{format_idr($data->po_amount)}}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4">
                    <table class="table table-striped m-b-0 c_list table-nowrap-th">
                        <tr>
                            <th>PR Amount</th>
                            <td> : {{format_idr($data->pr_amount)}}</td>
                        </tr>
                        <tr>
                            <th>Margin</th>
                            <td> : {{$data->margin}}%</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($data->status==0 || $data->status == null || $data->status == '0')
                                    <label class="badge badge-info" data-toggle="tooltip" title="Regional / SM - Waiting PR Submission">Waiting PR Submission</label>
                                @endif
                                @if($data->status==1)
                                    <label class="badge badge-warning" data-toggle="tooltip" title="Finance - Profit >= 30%, Waiting to Transfer Budget">Finance In Review</label>
                                @endif
                                @if($data->status==2)
                                    <label class="badge badge-success" data-toggle="tooltip" title="Finance - Profit >= 30%, Waiting to Transfer Budget">Finance - Approved</label>
                                @endif
                                @if($data->status==3)
                                    <label class="badge badge-danger" data-toggle="tooltip" title="PMG - Revise Request, Profit < 30%">PMG Review</label>
                                @endif
                                @if($data->status==4)
                                    <label class="badge badge-warning" data-toggle="tooltip" title="PMG - Waiting PMG Review under 30%">PMG Review </label>
                                @endif
                                @if($data->status==5)
                                    <label class="badge badge-info" data-toggle="tooltip">Budget Transferred To Project Admin/Finance</label>
                                @endif
                                @if($data->status==6)
                                    <label class="badge badge-info" data-toggle="tooltip">Pending Assignment To Field Team</label>
                                @endif
                                @if($data->status ==7)
                                    <label class="badge badge-info">Ongoing Execution</label>
                                @endif
                                @if($data->status >=8)
                                    <label class="badge badge-info" data-toggle="tooltip">Field Team Submitted</label>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>File Transfer</th>
                            <td> : 
                                @if($data->file_transfer)
                                    <a href="{{asset($data->file_transfer)}}" target="_blank"><i class="fa fa-image"></i> View</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <br />
            <div class="table-responsive">
                <table class="table table-striped m-b-0 c_list table-nowrap-th">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>PO Details</th>
                            <th>PO Aging (day)</th>
                            <th>PO Aging By Category</th>
                            <th>PO Aging By Month</th>
                            <th>PO Month Creation</th>
                            <th>PO Amount</th>
                            <th>PIC Project</th>
                            <th>Project Code ( Internal )</th>
                            <th>Region Code</th>
                            <th>Account</th>
                            <th>Sub Account</th>
                            <th>Project Type</th>
                            <th>Current PIC Handler</th>
                            <th style="background: #9fd99f;">PR No</th>
                            <th style="background: #9fd99f;">Date of Req PR</th>
                            <th style="background: #9fd99f;">Supplier</th>
                            <th style="background: #9fd99f;">PR Amount</th>
                            <th style="background: #9fd99f;">Margin</th>
                            <th style="background: #9fd99f;">Status PR</th>
                            <th>System</th>
                            <th>Change History</th>
                            <th>Rep Office</th>
                            <th>Customer</th>
                            <th>Project Code</th>
                            <th>Site ID</th>
                            <th>Sub Contract No</th>
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
                            <th>Billed QTY</th>
                            <th>QTY Cancel</th>
                            <th>Unit</th>
                            <th>Unit Price</th>
                            <th>Line Amount</th>
                            <th>Center Area</th>
                            <th>Bidding Area</th>
                            <th>Publish Date</th>
                            <th>Acceptance Date</th>
                            <th>Note to Receiver</th>
                            <th>PDS (Categorized it)</th>
                            <th>PDS Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data->items as $k => $item)
                            <tr>
                                <td>{{$k+1}}</td>
                                <td>{{$item->po_detail}}</td>
                                <td>{{$item->po_aging}}</td>
                                <td>{{$item->po_aging_by_category}}</td>
                                <td>{{$item->po_aging_by_month}}</td>
                                <td>{{$item->po_month_creation}}</td>
                                <td>{{format_idr($item->po_amount)}}</td>
                                <td>{{$item->pic_project}}</td>
                                <td>{{$item->project_code}}</td>
                                <td>{{$item->region_code}}</td>
                                <td>{{$item->account_drop_down}}</td>
                                <td>{{$item->sub_account}}</td>
                                <td>{{$item->project_type}}</td>
                                <td>{{$item->current_pic_handler}}</td>
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
                                <td>{{format_idr($item->pr_amount)}}</td>
                                <td>{{$item->margin}}%</td>
                                <td>{{$item->status_pr}}</td>
                                <td>{{$item->system_dropdown}}</td>
                                <td>{{$item->change_history}}</td>
                                <td>{{$item->rep_office}}</td>
                                <td>{{$item->customer}}</td>
                                <td>{{$item->project_code}}</td>
                                <td>{{$item->site_id}}</td>
                                <td>{{$item->sub_contract}}</td>
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
                                <td>{{$item->unit_price}}</td>
                                <td>{{$item->line_amount}}</td>
                                <td>{{$item->center_area}}</td>
                                <td>{{$item->bidding_area}}</td>
                                <td>{{$item->publish_date}}</td>
                                <td>{{$item->acceptance_date}}</td>
                                <td>{{$item->note_to_receiver}}</td>
                                <td>{{$item->pds_category}}</td>
                                <td>{{$item->pds_amount}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <hr />
            <div class="form-group">
                <span wire:loading wire:target="submit_regional,submit_finance_budget">
                    <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                    <span class="sr-only">{{ __('Loading...') }}</span>
                </span>
                <a href="{{route('po-tracking-nonms.huawei')}}" class="mr-2"><i class="fa fa-arrow-left"></i> Back </a>
                @if($is_regional and $data->status==0)
                    <button type="button" wire:click="submit_regional" wire:loading.remove wire:target="submit_regional" class="btn btn-info"><i class="fa fa-check-circle"></i> Submit Request</button>
                @endif
                @if($is_finance and $data->status==1)
                    <button type="button" wire:click="submit_finance_budget" wire:loading.remove wire:target="submit_finance_budget" class="btn btn-info"><i class="fa fa-check-circle"></i> Process Budget</button>
                @endif
                @if($is_finance and $data->status==2)
                    <button type="button" data-toggle="modal" data-target="#modal_finance_transfer_budget" class="btn btn-info"><i class="fa fa-check-circle"></i> Transfer Budget</button>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_finance_transfer_budget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @livewire('po-tracking-nonms.huawei.finance-transfer-budget',['data'=>$data->id])
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
@push('after-scripts')
    <script>
        Livewire.on('regional_set_budget',()=>{
            $("#modal_regional_set_budget").modal('show');
        });
    </script>
@endpush