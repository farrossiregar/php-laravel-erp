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
            </div>
            <div class="body pt-0">
                <div class="row">
                    <div class="col-md-12">
                        <a href="#" data-toggle="modal" data-target="#modal-potrackingesar-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import PO Tracking ESAR')}}</a>
                        <br><br><br>
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
                                        <th>QTY Cancel</th>  
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
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        
                                    </tr>
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
