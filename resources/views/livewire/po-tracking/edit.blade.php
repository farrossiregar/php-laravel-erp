@section('title', __('PO Tracking Data Detail'))
@section('parentPageTitle', 'Home')

<br><br><br>
<div class="row clearfix">
    <div class="col-lg-8">
        <div class="card">
            <div class="header row">
                <div class="col-md-12">
                    <b><h4>PAYMENT DEDUCTION STATEMENT</h4></b> 
                </div>
                <table class="table table-striped m-b-0 c_list">
                    <tr>
                        <th>Project Name</th>                               
                        <th>{{$data->project_name}}</th>   
                        <th>Contract No</th>                               
                        <th>{{$data->contract_no}}</th>  
                    </tr>

                    <tr>
                        <th>Subcontract No</th>                               
                        <th>{{$data->subcontractor_no}}</th>   
                        <th>PO NO</th>                               
                        <th>{{$data->po_no}}</th>  
                    </tr>

                    <tr>
                        <th>Employer's Name</th>                               
                        <th>{{$data->employers_name}}</th>   
                        <th>Subcontractor's Name</th>                               
                        <th>{{$data->subcontractors_name}}</th>  
                    </tr>
                </table>
            </div>
            <div class="body pt-0">
                <div class="row">
                    <div class="col-md-12">
                        <a href="#" data-toggle="modal" data-target="#modal-potrackingesar-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import PO Tracking ESAR')}}</a>
                        <br><br><br>
                        <div class="table-responsive">
                            
                            <table class="table table-striped m-b-0 c_list">
                                <tr>
                                    <th>Deduction Descriptive</th>                               
                                    <th>Sum</th>   
                                    <th>Note</th>                               
                                </tr>
                                <tr>
                                    <th>Project Quality Deduction</th>                               
                                    <th>{{$data->project_quality_deduction_sum}}</th>   
                                    <th>{{$data->project_quality_deduction_note}}</th>                               
                                </tr>
                                <tr>
                                    <th>Good Deduction</th>                               
                                    <th>{{$data->good_deduction_sum}}</th>   
                                    <th>{{$data->good_deduction_note}}</th>                               
                                </tr>
                                <tr>
                                    <th>Delay Work Deduction</th>                               
                                    <th>{{$data->delay_work_deduction_sum}}</th>   
                                    <th>{{$data->delay_work_deduction_note}}</th>                               
                                </tr>
                                <tr>
                                    <th>VAT10%</th>                               
                                    <th>{{$data->vat_sum}}</th>   
                                    <th>{{$data->vat_note}}</th>                               
                                </tr>
                                <tr>
                                    <th>Total Deduction</th>                               
                                    <th></th>   
                                    <th></th>                               
                                </tr>

                            </table>
                            <br><br><br>
                            <table class="table table-striped m-b-0 c_list">
                                <tr>
                                    <th>Drafter :</th>                               
                                    <th></th>   
                                    <th>Date :</th>                               
                                    <th></th>                               
                                </tr>

                            </table>
                            <br><br><br>
                            <table class="table table-striped m-b-0 c_list">
                                <tr>
                                    <th>PT Huawei</th>                               
                                    <th>Supplier</th>                              
                                </tr>
                            </table>
                            <table class="table table-striped m-b-0 c_list">
                                <tr>
                                    <th>Name :</th>                               
                                    <th></th>   
                                    <th>Position :</th>                               
                                    <th></th>   
                                    <th>Name :</th>                               
                                    <th></th>   
                                    <th>Position :</th>                               
                                    <th></th>                             
                                </tr>
                                <tr>
                                    <th>Signature :</th>                               
                                    <th></th>   
                                    <th>Date :</th>                               
                                    <th></th>   
                                    <th>Signature :</th>                               
                                    <th></th>   
                                    <th>Date :</th>                               
                                    <th></th>                             
                                </tr>

                            </table>
                        </div>
                    </div>

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
