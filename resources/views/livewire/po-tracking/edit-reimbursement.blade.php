@section('title', __('PO Tracking Data Detail'))
@section('parentPageTitle', 'Home')

<br><br><br>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-12">
                    <b><h4>PO Tracking Reimbursement</h4></b> 
                    
                </div>
                <div class="col-md-2">
                    <select class="form-control" name="month" wire:model="month">
                        <option value=""> --- Month --- </option>
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-control" name="region" wire:model="region">
                        <option value=""> --- Region --- </option>
                        @foreach(\App\Models\Region::orderBy('region','ASC')->get() as $region)
                        <option value="{{$region->region_code}}">{{$region->region}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-control" name="project" wire:model="project">
                        <option value=""> --- Project --- </option>
                        <option value="">Project Name</option>
                    </select>
                </div>
            </div>
            <div class="body pt-0">
                <div class="row">
                    <div class="col-md-12">
                        <!-- <a href="#" data-toggle="modal" data-target="#modal-potrackingesar-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import PO Tracking ESAR')}}</a> -->
                        <br>
                        <div class="table-responsive">
                            
                            <table class="table table-striped m-b-0 c_list">
                                <thead>
                                    <tr>
                                        <th>No</th>                               
                                        <th>ID</th>  
                                        <th>Change History</th> 
                                        <th>Rep Office</th>  
                                        <th>Customer</th>  
                                        <th>Project Name</th>  
                                        <th>Project Code</th>  
                                        <th>Site ID</th>  
                                        <th>Sub Contract NO</th>  
                                        <th>PR NO</th>  
                                        <th>Sales Contract NO</th>  
                                        <th>PO Status</th>  
                                        <th>PO NO</th>  
                                        <th>Site Code</th>  
                                        <th>Site Name</th>  
                                        <th>PO Line NO</th>  
                                        <th>Shipment NO</th>  
                                        <th>Item Description</th>  
                                        <th>Requested QTY</th>  
                                        <th>Unit</th>  
                                        <th>Unit Price</th>  
                                        <th>Center Area</th>  
                                        <th>Start Date</th>  
                                        <th>End Date</th>  
                                        <th>Billed QTY</th>  
                                        <th>Due QTY</th>  
                                        <th>QTY Cancel</th>  
                                        <th>Item Code</th>  
                                        <th>Version NO</th>  
                                        <th>Line Amount</th>  
                                        <th>Bidding Area</th>  
                                        <th>Tax Rate</th>  
                                        <th>Currency</th>  
                                        <th>Ship To</th>  
                                        <th>Engineering Code</th>  
                                        <th>Engineering Name</th>  
                                        <th>Payment Terms</th>  
                                        <th>Category</th>  
                                        <th>Payment Method</th>  
                                        <th>Product Category</th>  
                                        <th>Bill To</th>  
                                        <th>Subproject Code</th>  
                                        <th>Expired Date</th>  
                                        <th>Publish Date</th>  
                                        <th>Acceptance Date</th>  
                                        <th>FF Buyer</th>  
                                        <th>Note to Receiver</th>  
                                        <th>Fob Lookup Code</th>  
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->po_reimbursement_id }}</td>
                                        <td>{{ $item->change_history }}</td>
                                        <td>{{ $item->rep_office }}</td>
                                        <td>{{ $item->customer }}</td>
                                        <td>{{ $item->project_name }}</td>
                                        <td>{{ $item->project_code }}</td>
                                        <td>{{ $item->site_id }}</td>
                                        <td>{{ $item->sub_contract_no }}</td>
                                        <td>{{ $item->pr_no }}</td>
                                        <td>{{ $item->sales_contract_no }}</td>
                                        <td>{{ $item->po_status }}</td>
                                        <td>{{ $item->po_no }}</td>
                                        <td>{{ $item->site_code }}</td>
                                        <td>{{ $item->site_name }}</td>
                                        <td>{{ $item->po_line_no }}</td>
                                        <td>{{ $item->shipment_no }}</td>
                                        <td>{{ $item->item_description }}</td>
                                        <td>{{ $item->requested_qty }}</td>
                                        <td>{{ $item->unit }}</td>
                                        <td>{{ $item->unit_price }}</td>
                                        <td>{{ $item->center_area }}</td>
                                        <td>{{ $item->start_date }}</td>
                                        <td>{{ $item->end_date }}</td>
                                        <td>{{ $item->billed_qty }}</td>
                                        <td>{{ $item->due_qty }}</td>
                                        <td>{{ $item->qty_cancel }}</td>
                                        <td>{{ $item->item_code }}</td>
                                        <td>{{ $item->version_no }}</td>
                                        <td>{{ $item->line_amount }}</td>
                                        <td>{{ $item->bidding_area }}</td>
                                        <td>{{ $item->tax_rate }}</td>
                                        <td>{{ $item->currency }}</td>
                                        <td>{{ $item->ship_to }}</td>
                                        <td>{{ $item->engineering_code }}</td>
                                        <td>{{ $item->engineering_name }}</td>
                                        <td>{{ $item->payment_terms }}</td>
                                        <td>{{ $item->category }}</td>
                                        <td>{{ $item->payment_method }}</td>
                                        <td>{{ $item->product_category }}</td>
                                        <td>{{ $item->bill_to }}</td>
                                        <td>{{ $item->subproject_code }}</td>
                                        <td>{{ $item->expire_date }}</td>
                                        <td>{{ $item->publish_date }}</td>
                                        <td>{{ $item->acceptance_date }}</td>
                                        <td>{{ $item->ff_buyer }}</td>
                                        <td>{{ $item->note_to_receiver }}</td>
                                        <td>{{ $item->fob_lookup_code }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                
                <br />
                
            </div>

            
           
            
            <!-- <div class="body pt-0">
                <div class="row">
                   <div class="col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="1" >
                            <label class="form-check-label" for="flexRadioDefault1">
                                Approve
                            </label>
                        </div>
                        <br>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="2" >
                            <label class="form-check-label" for="flexRadioDefault2">
                                Reject
                            </label>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div href="#" class="btn btn-primary" onclick="approvesitelisttracking()"><i class="fa fa-search"></i>Submit</div>
                    </div>
                </div>
            </div>    -->
                                   
        </div>
    </div>
</div>



<div class="modal fade" id="modal-potrackingesar-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <livewire:po-tracking.importesar />
        </div>
    </div>
</div>




@section('page-script')
Livewire.on('preview-duplicate',()=>{
    $("#modal-preview-duplicate").modal('hide');
});

@endsection
