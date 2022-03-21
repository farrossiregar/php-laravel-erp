<div>
    <div class="header row px-0">
        <div class="col-md-2">
            <input type="text" class="form-control" wire:model="keyword" placeholder="Keyword" />
        </div>
        <div class="col-md-10">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-potrackingms-importericsson" class="btn btn-info"><i class="fa fa-upload"></i> Upload</a>
            <span wire:loading>
                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                <span class="sr-only">{{ __('Loading...') }}</span>
            </span>
        </div>
    </div>
    <div class="body pt-0 px-0">    
        <div class="table-responsive" style="min-height:200px;">
            <table class="table table-striped m-b-0 c_list table-nowrap-th">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Status</th>
                        <th>PO No</th>    
                        <th>Item Number</th>    
                        <th>PO Line Item</th>
                        <th>Date PO Released</th>
                        <th>Type</th>
                        <th>Item Description</th>
                        <th>Period</th>
                        <th>Region</th>
                        <th>Last Status</th>
                        <th>No BAST</th>
                        <th>Qty PO</th>
                        <th>Qty PO Penagihan 60%</th>
                        <th>GAP 100% - 60%</th>
                        <th>Actual Qty</th>
                        <th>PM W/PNCHLST</th>
                        <th>PM NY ACVH</th>
                        <th>Site PO Deduct</th>
                        <th>Price / Unit</th>
                        <th>PO Amount Actual</th>
                        <th>PO Amount After Deduct</th>
                        <th>Penalty</th>
                        <th>Amount Penalty</th>
                        <th>NO CN</th>
                        <th>Date Submit CN</th>
                        <th>Date BAST Approval</th>
                        <th>Date BAST Approval by System</th>
                        <th>Date GR Req</th>
                        <th>No GR</th>
                        <th>Date GR Share</th>
                        <th>Invoice Amount</th>
                        <th>No Invoice</th>
                        <th>Invoice Date</th>
                        <th>Payment Date</th>
                        <th>Date BAST Approval 2</th>
                        <th>Date BAST Approval by System 2</th>
                        <th>Date GR Req 2</th>
                        <th>No GR 2</th>
                        <th>Date GR Share 2</th>
                        <th>No Invoice Part 2</th>
                        <th>Invoice Date Part 2</th>
                        <th>Invoice Amount Part 2</th>
                        <th>QTY Site Hold</th>
                        <th>Type</th>
                        <th>Amount Hold Payment</th>
                        <th>Closing Site</th>
                        <th>No Bast</th>
                        <th>Claim</th>
                        <th>Date Approval Bast</th>
                        <th>Date Approved by System</th>
                        <th>Req GR</th>
                        <th>GR No</th>
                        <th>Date GR Number Share</th>
                        <th>No Invoice</th>
                        <th>Invoice Date</th>
                        <th>Last Status Claim Hold Payment</th>
                        <th>Amount Closing Site Hold Payment</th>
                        <th>No BAST</th>
                        <th>Closing Site</th>
                        <th>Claim</th>
                        <th>Last Status Backlog H1</th>
                        <th>No GR</th>
                        <th>Date GR Share</th>
                        <th>No Invoice Backlog H1</th>
                        <th>Date Inoice Backlog H1</th>
                        <th>Amount Closing site Backlog H1</th>
                    </tr>
                </head>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td></td>
                        <td>{{ $item->po_no }}</td>
                        <td>{{ $item->item_number }}</td>
                        <td>{{ $item->po_line_item }}</td>
                        <td>{{ $item->date_po_release }}</td>
                        <td>{{ $item->type }}</td>
                        <td>{{ $item->item_description }}</td>
                        <td>{{ $item->period }}</td>
                        <td>{{ $item->region }}</td>
                        <td>{{ $item->last_status }}</td>
                        <td>{{ $item->no_bast }}</td>
                        <td>{{ $item->qty_po }}</td>
                        <td>{{ $item->qty_po_penagihan_60 }}</td>
                        <td>{{ $item->gap_100_60 }}</td>
                        <td>{{ $item->actual_qty }}</td>
                        <td>{{ $item->pm_w }}</td>
                        <td>{{ $item->pm_ny }}</td>
                        <td>{{ $item->site_po_deduction }}</td>
                        <td>{{ $item->price_unit }}</td>
                        <td>{{ $item->po_amount_actual }}</td>
                        <td>{{ $item->po_amount_after_deduction }}</td>
                        <td>{{ $item->penalty }}</td>
                        <td>{{ $item->amount_penalty }}</td>
                        <td>{{ $item->no_cn }}</td>
                        <td>{{ $item->date_submit_cn }}</td>

                        <td>{{ $item->date_bast_approval }}</td>
                        <td>{{ $item->date_bast_approval_system }}</td>
                        <td>{{ $item->date_gr_req }}</td>
                        <td>{{ $item->no_gr }}</td>
                        <td>{{ $item->date_gr_share }}</td>
                        <td>{{ $item->invoice_amount }}</td>
                        <td>{{ $item->no_inv }}</td>
                        <td>{{ $item->inv_date }}</td>

                        <td>{{ $item->payment_date }}</td>

                        <td>{{ $item->date_bast_approval2 }}</td>
                        <td>{{ $item->date_bast_approval_system2 }}</td>
                        <td>{{ $item->date_gr_req2 }}</td>
                        <td>{{ $item->no_gr2 }}</td>
                        <td>{{ $item->date_gr_share2 }}</td>
                        <td>{{ $item->invoice_amount2 }}</td>
                        <td>{{ $item->no_inv2 }}</td>
                        <td>{{ $item->inv_date2 }}</td>

                        <td>{{ $item->qty_site_hold }}</td>
                        <td>{{ $item->type2 }}</td>
                        <td>{{ $item->amount_hold_payment }}</td>
                        <td>{{ $item->closing_site }}</td>
                        <td>{{ $item->no_bast2 }}</td>
                        <td>{{ $item->claim }}</td>

                        <td>{{ $item->date_bast_approval3 }}</td>
                        <td>{{ $item->date_bast_approval_system3 }}</td>
                        <td>{{ $item->req_gr }}</td>
                        <td>{{ $item->gr_number }}</td>
                        <td>{{ $item->date_gr_number_share }}</td>
                        <td>{{ $item->no_inv3 }}</td>
                        <td>{{ $item->inv_date3 }}</td>

                        <td>{{ $item->status_claim_hold_payment }}</td>
                        <td>{{ $item->amount_closing_site_hold_payment }}</td>

                        <td>{{ $item->no_bast3 }}</td>
                        <td>{{ $item->closing_site2 }}</td>
                        <td>{{ $item->claim2 }}</td>
                        <td>{{ $item->status_backlog_h1 }}</td>
                        <td>{{ $item->no_gr3 }}</td>
                        <td>{{ $item->date_gr_share3 }}</td>
                        <td>{{ $item->no_inv_backlog_h1 }}</td>
                        <td>{{ $item->date_inv_backlog_h1 }}</td>
                        <td>{{ $item->amount_closing_site_backlog_h1 }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modal_upload_ericsson" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <form wire:submit.prevent="save">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-upload"></i> Upload Ericsson</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="file" class="form-control" name="file" wire:model="file" />
                        @error('file')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info close-modal"><i class="fa fa-upload"></i> Upload</button>
                </div>
                <!-- <div wire:loading>
                    <div class="page-loader-wrapper" style="display:block">
                        <div class="loader" style="display:block">
                            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                            <p>Please wait...</p>
                        </div>
                    </div>
                </div> -->
            </form>
            </div>
        </div>
    </div>

</div>  