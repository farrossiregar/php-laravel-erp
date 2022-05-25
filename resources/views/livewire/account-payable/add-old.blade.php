<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="tab-content">      
                <div class="header row">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Request Account Payable </h5>
                </div>
                <div class="body pt-0">
                    <div class="form-group">
                        <form wire:submit.prevent="save">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label>Employee Name</label>
                                            <input list="petty_cash_category1" class="form-control"  wire:model="employee_name" readonly>
                                            @error('employee_name')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Project</label>
                                            <input type="text" class="form-control" wire:model="project" readonly/>
                                            @error('employee_id')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Position</label>
                                            <input type="text" class="form-control" wire:model="position" readonly/>
                                            @error('position')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Departement</label>
                                            <input type="text" wire:model="department" class="form-control" readonly/>
                                            @error('department')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Request Type</label>
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
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Sub Request Type</label>
                                            <select onclick="" class="form-control" wire:model="subrequest_type">
                                                @if($request_type == '1')
                                                    <option value=""> --- Sub Request Type (Petty Cash) --- </option>
                                                    <!-- <option value="1">Petty Cash Team HR</option>
                                                    <option value="2">Petty Cash Team PL</option>
                                                    <option value="3">Petty Cash Team GA</option> -->
                                                    <option value="4">Petty Cash Team IT</option>
                                                    <option value="5">Petty Cash TOC</option>
                                                    <option value="6">Petty Cash Finance</option>
                                                    <option value="7">Petty Cash PA (CEO)</option>

                                                    @foreach(\App\Models\RequestDetailOption::where('id_request_type', '1')->get() as $item)
                                                        <option value="{{ $item->id_detail_request_option }}">{{ $item->request_detail_option }}</option>
                                                    @endforeach
                                                @endif

                                                @if($request_type == '2')
                                                <option value=""> --- Sub Request Type (Weekly Opex) --- </option>
                                                <option value="1">Opex Region</option>
                                                <option value="2">Opex Comcase</option>
                                                <option value="3">Police Report</option>

                                                @foreach(\App\Models\RequestDetailOption::where('id_request_type', '2')->get() as $item)
                                                    <option value="{{ $item->id_detail_request_option }}">{{ $item->request_detail_option }}</option>
                                                @endforeach
                                                
                                                @endif

                                                @if($request_type == '3')
                                                <option value=""> --- Sub Request Type (Other Opex) --- </option>
                                                <option value="1">Consumable Material</option>
                                                <option value="2">Service / Maintenance (Include Tools)</option>
                                                <option value="3">Rapid / Swab</option>
                                                <option value="4">Opex Training</option>
                                                <option value="5">Addwork</option>

                                                @foreach(\App\Models\RequestDetailOption::where('id_request_type', '3')->get() as $item)
                                                    <option value="{{ $item->id_detail_request_option }}">{{ $item->request_detail_option }}</option>
                                                @endforeach

                                                @endif

                                                @if($request_type == '4')
                                                <option value=""> --- Sub Request Type (Rectification) --- </option>
                                                <option value="1">Rectif E2E</option>
                                                <option value="2">Rectif STP</option>
                                                <option value="3">Rectif Car Track</option>
                                                <option value="4">Rectif H3I</option>
                                                <option value="5">Reimburse Solar Genset</option>
                                                <option value="6">Reimburse Electricity</option>

                                                @foreach(\App\Models\RequestDetailOption::where('id_request_type', '4')->get() as $item)
                                                    <option value="1">{{ $item->request_detail_option }}</option>
                                                @endforeach

                                                @endif

                                                @if($request_type == '5')
                                                <option value=""> --- Sub Request Type (Subcont) --- </option>
                                                <option value="1">Subcont</option>

                                                @foreach(\App\Models\RequestDetailOption::where('id_request_type', '5')->get() as $item)
                                                    <option value="{{ $item->id_detail_request_option }}">{{ $item->request_detail_option }}</option>
                                                @endforeach


                                                @endif

                                                @if($request_type == '6')
                                                <option value=""> --- Sub Request Type (Site Keeper) --- </option>
                                                <option value="1">Huawei</option>
                                                <option value="2">Imbas Petir</option>

                                                @foreach(\App\Models\RequestDetailOption::where('id_request_type', '6')->get() as $item)
                                                    <option value="{{ $item->id_detail_request_option }}">{{ $item->request_detail_option }}</option>
                                                @endforeach

                                                @endif

                                                @if($request_type == '7')
                                                <option value=""> --- Sub Request Type (HQ Adminstartion) --- </option>
                                                <option value="1">BPJS Teragakerjaan</option>
                                                <option value="2">BPJS Kesehatan</option>
                                                <option value="3">Life Insurance</option>
                                                <option value="4">Utilities - Electricity</option>
                                                <option value="5">Utilities - Telephone</option>
                                                <option value="6">Utilities - Internet</option>
                                                <option value="7">Application Subscription (IT)</option>
                                                <option value="8">IT/System Purchasing</option>
                                                <option value="9">Staff Claim - Entertainment</option>
                                                <option value="10">Staff Claim - Medical</option>
                                                <option value="11">Staff Claim - Transport</option>
                                                <option value="12">CSR (External & Internal)</option>
                                                <option value="13">Homebase</option>
                                                <option value="14">Office/Warehouse rental</option>
                                                <option value="15">Legal Fee for vehicle</option>
                                                <option value="16">Legal Fee</option>
                                                <option value="17">Notary Fee</option>
                                                <option value="18">Audit ISO</option>
                                                <option value="19">Audit Financial Statement</option>
                                                <option value="20">Appraissal Agent Fee</option>
                                                <option value="21">E-commerce purchasing</option>
                                                <option value="22">All taxes (Finance)</option>
                                                <option value="23">Bank Loan Principle (Finance)</option>
                                                <option value="24">Bank Loan Interest (Finance)</option>
                                                <option value="25">Related/Third Party Loan Principle (Finance)</option>
                                                <option value="26">Related/Third Party Loan Interest (Finance)</option>
                                                <option value="27">Proxy (Finance)</option>
                                                <option value="28">Dividend (Finance)</option>
                                                <option value="29">Deposit (Finance)</option>

                                                @foreach(\App\Models\RequestDetailOption::where('id_request_type', '7')->get() as $item)
                                                    <option value="{{ $item->id_detail_request_option }}">{{ $item->request_detail_option }}</option>
                                                @endforeach

                                                @endif

                                                @if($request_type == '8')
                                                <option value=""> --- Sub Request Type (Payroll) --- </option>
                                                <option value="1">Salary HQ Office</option>
                                                <option value="2">Salary Region / Project</option>

                                                @foreach(\App\Models\RequestDetailOption::where('id_request_type', '8')->get() as $item)
                                                    <option value="{{ $item->id_detail_request_option }}">{{ $item->request_detail_option }}</option>
                                                @endforeach

                                                @endif

                                                @if($request_type == '9')
                                                <option value=""> --- Sub Request Type (Supplier / Vendor) --- </option>
                                                <option value="1">Consumable Material</option>
                                                <option value="2">Inventory</option>
                                                <option value="3">Tools/Project supply</option>
                                                <option value="4">Fixed Assets</option>
                                                <option value="5">Office Supplies</option>
                                                <option value="6">Service/Maintenance</option>
                                                <option value="7">Ownrisk</option>
                                                <option value="8">Ownership</option>
                                                <option value="9">Training</option>
                                                <option value="10">Car Rental (+Personal)</option>
                                                <option value="11">Tools or Equipment Rental</option>
                                                <option value="12">PJK3</option>
                                                <option value="13">Freight/logistic fee</option>

                                                @foreach(\App\Models\RequestDetailOption::where('id_request_type', '9')->get() as $item)
                                                    <option value="{{ $item->id_detail_request_option }}">{{ $item->request_detail_option }}</option>
                                                @endforeach

                                                @endif
                                            </select>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Additional Document </label>
                                            <input type="file" class="form-control" wire:model="file">
                                            @error('file')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Document Type </label>
                                            <input list="doc_id" type="text" class="form-control" wire:model="doc_name">
                                            <datalist id="doc_id" >
                                                <option value="PO">
                                                <option value="Invoice">
                                            </datalist>
                                            @error('doc_name')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>