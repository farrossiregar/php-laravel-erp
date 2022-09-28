
@section('title', $data->po_number)
@section('parentPageTitle', 'PO Tracking Non MS')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="body pt-0">    
                <div class="row">
                    <div class="table-responsive col-md-4 pt-3">
                        <table class="table m-b-0 c_list table-nowrap-th">
                            <tbody>
                                <tr>
                                    <th>PO No</th>
                                    <td>{{$data->po_number}}</td>
                                </tr>
                                <tr>    
                                    <th>Date PO Release (sc)</th>    
                                    <td>{{date('d-M-Y',strtotime($data->date_po_sc))}}</td>
                                </tr>
                                <tr>
                                    <th>Date PO Release (sys)</th>
                                    <td>{{date('d-M-Y',strtotime($data->date_po_sys))}}</td>
                                </tr>
                                <tr>
                                    <th>Contract Number</th>
                                    <td>{{$data->contract_number}}</td>
                                </tr>
                                <tr>
                                    <th>Contract Date</th>
                                    <td>{{$data->date_contract?date('d-M-Y',strtotime($data->date_contract)):'-'}}</td>
                                </tr>
                                <tr>
                                    <th>BAST Number</th>
                                    <td>
                                        {{$data->bast_number}}
                                        @if($data->bast_file)
                                            <a href="{{asset($data->bast_file)}}"><i class="fa fa-download"></i> Document</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>BAST Date</th>
                                    <td>{{$data->bast_date?date('d-M-Y',strtotime($data->bast_date)):'-'}}</td>
                                </tr>
                                <tr>
                                    <th>BAST Note</th>
                                    <td>{{$data->bast_note}}</td>
                                </tr>
                                @if($is_e2e and $data->status==1)
                                    <tr>
                                        <th>BAST</th>
                                        <td>
                                            <input type="file" wire:model="bast_file" class="form-control"  />
                                            *xls,xlsx,pdf<br />
                                            @error('bast_file')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                            <a href="{{route('po-tracking-nonms.po-generate-bast',['data'=>$data->id])}}" target="_blank"><i class="fa fa-download"></i> Generate BAST</a>
                                        </td>
                                    </tr>
                                @endif
                            </head>
                        </table>
                    </div>
                    <div class="table-responsive col-md-4 pt-3">
                        <table class="table m-b-0 c_list table-nowrap-th">
                            <tbody>
                                <tr>
                                    <th>GR Number</th>
                                    <td>
                                        <input type="text" class="form-control" wire:model="gr_number" />
                                        {{$data->gr_number}}
                                        @if($data->gr_file)
                                            <a href="{{asset($data->gr_file)}}"><i class="fa fa-download"></i> Document</a>
                                        @endif
                                        @error('gr_number')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th>GR Date</th>
                                    <td>
                                        <input type="date" class="form-control" wire:model="gr_date" />
                                        {{$data->gr_date?date('d-M-Y',strtotime($data->gr_date)):'-'}}
                                        @error('gr_date')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                        @enderror
                                    </td>
                                </tr>
                                @if($is_e2e and $data->status==1)
                                    <tr>
                                        <th>GR</th>
                                        <td>
                                            <input type="file" wire:model="gr_file" class="form-control"  />
                                            *xls,xlsx,pdf
                                            @error('gr_file')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </td>
                                    </tr>
                                @endif
                                </tr>
                                    <th>Invoice No</th>
                                    <td>{{$data->invoice_number}}</td>
                                </tr>
                                <tr>
                                    <th>Invoice Date</th>
                                    <td>{{$data->invoice_date?date('d-M-Y',strtotime($data->invoice_date)):'-'}}</td>
                                </tr>
                                </tr>
                                    <th>Payment Date</th>
                                    <td>{{$data->payment_date?date('d-M-Y',strtotime($data->payment_date)):'-'}}</td>
                                </tr>
                                </tr>
                                    <th>Payment Amount</th>
                                    <td>{{format_idr($data->payment_amount)}}</td>
                                </tr>
                                </tr>
                                    <th>Transfer</th>
                                    <td>
                                        @if(isset($data->bukti_transfer))
                                            @foreach($data->bukti_transfer as $bukti_transfer)
                                                <a href="{{asset($bukti_transfer->file)}}" title="Finance - Budget Successfully Transfered" target="_blank"><i class="fa fa-image"></i> </a> 
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Extra Budget</th>
                                    <td>
                                        {{format_idr($data->extra_budget)}}
                                        @if($data->extra_budget) 
                                            @if($data->extra_budget_file)
                                                <a href="{{asset($data->extra_budget_file)}}" target="_blank"><i class="fa fa-image"></i></a>
                                            @else
                                                <a href="javascript:void(0)" class="badge badge-info badge-active" data-toggle="modal" data-target="#modal_upload_bukti_transfer"><i class="fa fa-upload"></i> Bukti Transfer</a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>    
                    </div>
                    <div class="table-responsive col-md-4 pt-3"></div>
                    @if($is_e2e and $data->status==1)
                        <div class="col-md-4">
                            <label>Note</label>
                            <textarea class="form-control" wire:model="bast_note"></textarea>
                        </div>
                    @endif
                </div>
                <div class="table-responsive mt-4">
                    <table class="table table-striped m-b-0 c_list table-nowrap-th">
                        <thead>
                            <tr>
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
                                <th style="background: #9fd99f;">PR No</th>
                                <th style="background: #9fd99f;">Date of Req PR</th>
                                <th style="background: #9fd99f;">Supplier</th>
                                <th style="background: #9fd99f;">PR Amount</th>
                                <th style="background: #9fd99f;">Margin</th>
                                <th style="background: #9fd99f;">Status PR</th>
                                <th>Current PIC Handler</th>
                                <th>System</th>
                                <th>Change History</th>
                                <th>Rep Office</th>
                                <th>Customer</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>{{$data->po_detail}}</td>
                                    <td>{{$data->po_aging}}</td>
                                    <td>{{$data->po_aging_by_category}}</td>
                                    <td>{{$data->po_aging_by_month}}</td>
                                    <td>{{$data->po_month_creation}}</td>
                                    <td>{{format_idr($data->po_amount)}}</td>
                                    <td>{{$data->pic_project}}</td>
                                    <td>{{$data->project_code}}</td>
                                    <td>{{$data->region_code}}</td>
                                    <td>{{$data->account_drop_down}}</td>
                                    <td>{{$data->sub_account}}</td>
                                    <td>{{$data->project_type}}</td>
                                    <td>{{$data->pr_no}}</td>
                                    <td>{{$data->date_of_req_pr?$data->date_of_req_pr : '-'}}</td>
                                    <td>{{$data->supplier?$data->supplier:'-'}}</td>
                                    <td>{{format_idr($data->pr_amount)}}</td>
                                    <td>{{$data->margin}}%</td>
                                    <td>{{$data->status_pr}}</td>
                                    <td>{{$data->sub_account}}</td>
                                    <td>{{$data->current_pic_handler}}</td>
                                    <td>{{$data->system_dropdown}}</td>
                                    <td>{{$data->change_history}}</td>
                                    <td>{{$data->rep_office}}</td>
                                    <td>{{$data->customer}}</td>
                                    <td></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            
                <hr />
                <a href="javascript:void(0)" onclick="history.back()"><i class="fa fa-arrow-left"></i> Back</a>
                @if($is_e2e and $data->status==10)
                    <a href="javascript:void(0)" wire:click="revisi" class="btn btn-danger mx-2"><i class="fa fa-edit"></i> Revisi</a>
                    <a href="javascript:void(0)" wire:click="approve" class="btn btn-success"><i class="fa fa-check-circle"></i> Approve</a>
                @endif
                <span wire:loading>
                    <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                    <span class="sr-only">{{ __('Loading...') }}</span>
                </span>
            </div>
        </div>
    </div>

    <div class="modal fade" wire:ignore.self id="modal_upload_bukti_transfer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-upload"></i> Upload</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="file" wire:model="file_extra_budget" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="upload" class="btn btn-success"><i class="fa fa-check-circle"></i> Submit</button>
                </div>
                <div wire:loading wire:target="upload">
                    <div class="page-loader-wrapper" style="display:block">
                        <div class="loader" style="display:block">
                            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                            <p>Please wait...</p>
                        </div>
                    </div>
                </div>
                <div wire:loading wire:target="file_extra_budget">
                    <div class="page-loader-wrapper" style="display:block">
                        <div class="loader" style="display:block">
                            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                            <p>Please wait...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>