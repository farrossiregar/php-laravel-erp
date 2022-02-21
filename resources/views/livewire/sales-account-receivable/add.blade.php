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