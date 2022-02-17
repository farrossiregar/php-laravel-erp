@section('title', __('Accident Report'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="tab-content">      
                <div class="header row">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Update Request Supplier Vendor </h5>
                </div>

                <div class="body pt-0">
                    <div class="form-group">
                        <form wire:submit.prevent="save">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        
                                        <div class="col-md-6 form-group">
                                            <label>Request Detail Option </label>
                                            <input type="text" class="form-control" wire:model="request_detail_option">
                                           
                                            @error('request_type')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Project </label>
                                            <select class="form-control" style="width:100%;" wire:model="project_code">
                                                <option value=""> --- Project --- </option>
                                                @foreach(\App\Models\ClientProject::orderBy('id', 'desc')
                                                                    ->where('company_id', Session::get('company_id'))
                                                                    ->where('is_project', '1')
                                                                    ->get() as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- <div class="col-md-6 form-group">
                                            <label>Project Code</label>
                                            <input type="text" class="form-control" style="width:100%;" wire:model="" readonly>
                                        </div> -->

                                        <div class="col-md-6 form-group">
                                            <label>Invoice NO </label>
                                            <input type="text" class="form-control" wire:model="invoice_no">
                                           
                                            @error('invoice_no')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Invoice Date </label>
                                            <input type="date" class="form-control" wire:model="invoice_date">
                                           
                                            @error('invoice_date')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 form-group">
                                            <label>TOP </label>
                                            <input type="text" class="form-control" wire:model="top">
                                           
                                            @error('top')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Due Date </label>
                                            <input type="date" class="form-control" wire:model="due_date">
                                           
                                            @error('due_date')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Supplier / Vendor Name </label>
                                            <input type="text" class="form-control" wire:model="supplier_vendor_name">
                                           
                                            @error('supplier_vendor_name')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>PR NO </label>
                                            <input type="text" class="form-control" wire:model="pr_no">
                                           
                                            @error('pr_no')
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

                                        <div class="col-md-12 form-group">
                                            <label>Description </label>
                                            <textarea name="" id="" cols="30" rows="4" class="form-control" wire:model="description"></textarea>
                                           
                                            @error('description')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>QTY</label>
                                            <input type="number" class="form-control" wire:model="qty">
                                           
                                            @error('qty')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Unit Price</label>
                                            <input type="number" class="form-control" wire:model="unit_price">
                                           
                                            @error('unit_price')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Shipping Price</label>
                                            <input type="number" class="form-control" wire:model="shipping_price">
                                           
                                            @error('shipping_price')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Total Price</label>
                                            <input type="number" class="form-control" wire:model="total_price">
                                           
                                            @error('total_price')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Other Cost</label>
                                            <input type="number" class="form-control" wire:model="other_cost">
                                           
                                            @error('other_cost')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>VAT</label>
                                            <input type="text" class="form-control" wire:model="vat">
                                           
                                            @error('vat')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 form-group">
                                            <label>WHT</label>
                                            <input type="text" class="form-control" wire:model="wht">
                                           
                                            @error('wht')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 form-group">
                                            <label>Total Payment</label>
                                            <input type="number" class="form-control" wire:model="total_payment">
                                           
                                            @error('total_payment')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 form-group">
                                            <label>Actual Payment</label>
                                            <input type="number" class="form-control" wire:model="actual_payment">
                                           
                                            @error('actual_payment')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 form-group">
                                            <label>Advance </label>
                                            <select name="" id="" class="form-control" wire:model="advance">
                                                <option value="">-- Advance --</option>
                                                <option value="1">YES</option>
                                                <option value="0">NO</option>
                                            </select>
                                            
                                           
                                            @error('advance')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 form-group">
                                            <label>% Actual Payment</label>
                                            <input type="number" class="form-control" wire:model="percentage_actual_payment">
                                           
                                            @error('percentage_actual_payment')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 form-group">
                                            <label>Actual Transfer Date </label>
                                            <input type="date" class="form-control" wire:model="actual_transfer_date">
                                           
                                            @error('actual_transfer_date')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 form-group">
                                            <label>Cash Transaction No </label>
                                            <input type="text" class="form-control" placeholder="001/Date/Month/Year/CashOut" wire:model="cash_transaction_no">
                                           
                                            @error('advance_date')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>


                                        
                                        <div class="col-md-6 form-group">
                                            <label>Tanggal Narik Data </label>
                                            <input type="date" class="form-control" wire:model="tgl_narik_data">
                                           
                                            @error('tgl_narik_data')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        

                                        <div class="col-md-6 form-group">
                                            <label>AP Amount </label>
                                            <input type="number" class="form-control" wire:model="ap_amount">
                                           
                                            @error('ap_amount')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Requested Document</label>
                                            
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <input type="file" class="form-control" wire:model="request_doc">
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="<?php echo asset('storage/Account_Payable/Supplier_Vendor/'.$request_doc) ?>" target="_blank"><i class="fa fa-download"></i> Download</a>
                                                </div>
                                            </div>
                                           
                                            @error('request_doc')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Payment Voucher Document </label>
                                            <input type="number" class="form-control" wire:model="payment_voucher_doc">
                                           
                                            @error('payment_voucher_doc')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 form-group">
                                            <label>Settlement Document</label>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <input type="file" class="form-control" wire:model="file">
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="<?php echo asset('storage/Account_Payable/Supplier_Vendor/'.$settlement_doc) ?>" target="_blank"><i class="fa fa-download"></i> Download</a>
                                                </div>
                                            </div>
                                           
                                            @error('file')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Account No Recorded </label>
                                            <input type="text" class="form-control" wire:model="account_no_recorded">
                                           
                                            @error('account_no_recorded')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Account Name Recorded </label>
                                            <input type="text" class="form-control" wire:model="account_name_recorded">
                                           
                                            @error('account_name_recorded')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Nominal Recorded </label>
                                            <input type="text" class="form-control" wire:model="nominal_recorded">
                                           
                                            @error('nominal_recorded')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        


                                        <!-- <div class="col-md-6 form-group">
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
                                                    <select class="form-control"  wire:model="year">
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
                                        </div> -->



                                        
                                        

                                        
                                        
                                       
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