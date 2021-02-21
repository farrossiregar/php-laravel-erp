@section('title', __('PO Tracking Data Detail'))
@section('parentPageTitle', 'Home')

<br><br><br>
<div class="row clearfix">
    <div class="col-lg-8">
        <div class="card">
            <div class="header row">
                <div class="col-md-12">
                    <b><h4>PT. HUAWEI TECH INVESTMENT</h4></b>
                    <b><h4>ENGINEERING SERVICE ACCEPTANCE REPORT</h4></b>
                </div>
                <table class="table table-striped m-b-0 c_list">
                    <tr>
                        <th>Project Name</th>                               
                        <th></th>   
                        <th>Acceptance</th>                               
                        <th></th>  
                    </tr>

                    <tr>
                        <th>Project Code</th>                               
                        <th></th>   
                        <th>Subcontractor Name</th>                               
                        <th></th>  
                    </tr>

                    <tr>
                        <th>PO NO</th>                               
                        <th></th>   
                        <th>Subcontractor No</th>                               
                        <th></th>  
                    </tr>
                    <tr>
                        <th>Payment</th>                               
                        <th></th>   
                        <th</th>                               
                        <th></th>  
                    </tr>

                    
                </table>
            </div>
            <div class="body pt-0">
                <div class="row">

                    <div class="col-md-12">
                        <br><br><br>
                        <div class="table-responsive">
                            <h4>ESAR</h4>
                            <table class="table table-striped m-b-0 c_list">
                                <thead>
                                    <tr>
                                        <th>No</th>                               
                                        <th>Site ID</th>  
                                        <th>Site Name</th> 
                                        <th>Description</th>  
                                        <th>UOM</th>  
                                        <th>PO Qty</th>  
                                        <th>Actual Qty</th>  
                                        <th>Start Date on PO</th>  
                                        <th>End Date on PO</th>  
                                        <th>Remarks</th>  
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
                                    </tr>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <br />
                
            </div>

            
           
            
            <div class="body pt-0">
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
            </div>   
                                   
        </div>
    </div>
</div>



<div class="modal fade bd-example-modal-lg" id="modal-preview-duplicate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:sitetracking.duplicateupdate />

        </div>
    </div>
</div>




@section('page-script')
Livewire.on('preview-duplicate',()=>{
    $("#modal-preview-duplicate").modal('hide');
});

@endsection
