@section('title', __('Accident Report'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="tab-content">      
                <div class="header row">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Update Sales Invoice Listing Detail </h5>
                </div>

                <div class="body pt-0">
                    <div class="form-group">
                        <form wire:submit.prevent="save">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label>Kind of Invoice</label>
                                            <input list="kind_invoice" type="text" class="form-control" wire:model="kind_of_invoice">
                                            <datalist id="kind_invoice" >
                                                <option value="MS">
                                                <option value="Rectification">
                                                <option value="Reimbursement">
                                            </datalist>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label>Project</label>
                                                    <input type="text" class="form-control" wire:model="project" />
                                                    @error('employee_id')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label>Region</label>
                                                    <input type="text" class="form-control" wire:model="region" />
                                                    
                                                    @error('date')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Customer Name</label>
                                            <input class="form-control"  wire:model="customer_name" >
                                           

                                            @error('customer_name')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Month </label>
                                                    <select name="" id="" class="form-control" wire:model="month">
                                                        <option value=""> --- Month --- </option>
                                                        @for($i = 1; $i <= 12; $i++)
                                                            <option value="{{$i}}">{{date('F', mktime(0, 0, 0, $i, 10))}}</option>
                                                        @endfor
                                                    </select>
                                                
                                                    @error('period')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">     
                                                    <label>Year </label>           
                                                    <select class="form-control"  wire:model="year" >
                                                        <option value=""> --- Year --- </option>
                                                        <option value="2022">2022</option>
                                                        <option value="2021">2021</option>
                                                        <option value="2020">2020</option>
                                                        <option value="2019">2019</option>
                                                        <option value="2018">2018</option>
                                                        <option value="2017">2017</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Invoice No</label>
                                            <input class="form-control"  wire:model="invoice_no" >
                                           

                                            @error('invoice_no')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Tax Invoice Number (Faktur Pajak)</label>
                                            <input class="form-control"  wire:model="tax_invoice_no" >
                                           

                                            @error('tax_invoice_no')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 form-group">
                                            <label>PO NO </label>
                                            <input type="text" class="form-control" wire:model="po_no">
                                           
                                            @error('po_no')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>PO Date </label>
                                            <input type="date" class="form-control" wire:model="po_date">
                                           
                                            @error('po_date')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label>Invoice Description </label>
                                            <textarea name="" id="" cols="30" rows="4" class="form-control" wire:model="invoice_description"></textarea>
                                           
                                            @error('invoice_description')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <div class="row">
                                                <div class="col-md-4 form-group">
                                                    <label>Currency</label>
                                                    <input type="text" class="form-control" wire:model="currency">
                                                
                                                    @error('currency')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>

                                                <div class="col-md-8 form-group">
                                                    <label>QTY </label>
                                                    <input type="number" class="form-control" wire:model="qty">
                                                
                                                    @error('qty')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label>Price per Unit </label>
                                                    <input type="number" class="form-control" wire:model="price_perunit">
                                                
                                                    @error('price_perunit')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label>Total </label>
                                                    <input type="number" class="form-control" wire:model="total">
                                                
                                                    @error('total')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>TOP </label>
                                            <input type="number" class="form-control" wire:model="top">
                                           
                                            @error('top')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <!-- <div class="col-md-6 form-group">
                                            <label>Schedule  </label>
                                            <input type="number" class="form-control" wire:model="po_no">
                                           
                                            @error('po_no')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div> -->

                                        <!-- <div class="col-md-6 form-group">
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
                                        </div> -->

                                        

                                        <!-- <div class="col-md-6 form-group">
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
                                                <option value="9">Supplier/Vendor</option>
                                                
                                            </select>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Sub Request Type</label>
                                            <select onclick="" class="form-control" wire:model="subrequest_type">
                                                @if($request_type == '1')
                                                <option value=""> --- Sub Request Type (Petty Cash) --- </option>
                                                <option value="1">Petty Cash Team HR</option>
                                                <option value="2">Petty Cash Team PL</option>
                                                <option value="3">Petty Cash Team GA</option>
                                                <option value="4">Petty Cash Team IT</option>
                                                <option value="5">Petty Cash TOC</option>
                                                <option value="6">Petty Cash Finance</option>
                                                <option value="7">Petty Cash PA (CEO)</option>
                                                @endif

                                                @if($request_type == '2')
                                                <option value=""> --- Sub Request Type (Weekly Opex) --- </option>
                                                <option value="1">Opex Region</option>
                                                <option value="2">Opex Comcase</option>
                                                <option value="3">Police Report</option>
                                                @endif

                                                @if($request_type == '3')
                                                <option value=""> --- Sub Request Type (Other Opex) --- </option>
                                                <option value="1">Consumable Material</option>
                                                <option value="2">Service / Maintenance (Include Tools)</option>
                                                <option value="3">Rapid / Swab</option>
                                                <option value="4">Opex Training</option>
                                                <option value="5">Addwork</option>
                                                @endif

                                                @if($request_type == '4')
                                                <option value=""> --- Sub Request Type (Rectification) --- </option>
                                                <option value="1">Rectif E2E</option>
                                                <option value="2">Rectif STP</option>
                                                <option value="3">Rectif Car Track</option>
                                                <option value="4">Rectif H3I</option>
                                                <option value="5">Reimburse Solar Genset</option>
                                                <option value="6">Reimburse Electricity</option>
                                                @endif

                                                @if($request_type == '5')
                                                <option value=""> --- Sub Request Type (Subcont) --- </option>
                                                <option value="1">Subcont</option>
                                                @endif

                                                @if($request_type == '6')
                                                <option value=""> --- Sub Request Type (Site Keeper) --- </option>
                                                <option value="1">Huawei</option>
                                                <option value="2">Imbas Petir</option>
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
                                                
                                                @endif

                                                @if($request_type == '8')
                                                <option value=""> --- Sub Request Type (Payroll) --- </option>
                                                <option value="1">Salary HQ Office</option>
                                                <option value="2">Salary Region / Project</option>
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
                                                @endif
                                            </select>
                                        </div> -->

                                        <!-- <div class="col-md-6 form-group">
                                            <label>Additional Document </label>
                                            <input type="file" class="form-control" wire:model="file">
                                           
                                            @error('leader')
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

                                           
                                            @error('leader')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        
                                         -->
                                        
                                       
                                    </div>
                                </div>
                                
                                <div class="col-md-12 form-group">
                                    <hr />
                                    
                                    <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('after-scripts')
        <script type="text/javascript">
        

        $("input[data-type='currency']").on({
            keyup: function() {
                formatCurrency($(this));
            },
            blur: function() { 
                formatCurrency($(this), "blur");
            }
        });

        function formatNumber(n) {
            return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }


        function formatCurrency(input, blur) {
            var input_val = input.val();
            
            // don't validate empty input
            if (input_val === "") { return; }
            
            // original length
            var original_len = input_val.length;

            // initial caret position 
            var caret_pos = input.prop("selectionStart");
                
            // check for decimal
            if (input_val.indexOf(".") >= 0) {
                var decimal_pos = input_val.indexOf(".");

                // split number by decimal point
                var left_side = input_val.substring(0, decimal_pos);
                var right_side = input_val.substring(decimal_pos);

                // add commas to left side of number
                left_side = formatNumber(left_side);

                // validate right side
                right_side = formatNumber(right_side);
                input_val = "Rp" + left_side;

            } else {
                input_val = formatNumber(input_val);
                input_val = "Rp" + input_val;
            }
            
            input.val(input_val);
            var updated_len = input_val.length;
            caret_pos = updated_len - original_len + caret_pos;
            input[0].setSelectionRange(caret_pos, caret_pos);
        }
        </script>
        @endpush
</div>