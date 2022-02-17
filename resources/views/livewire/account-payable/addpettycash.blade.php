@section('title', __('Accident Report'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="tab-content">      
                <div class="header row">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Update Request Petty Cash </h5>
                </div>

                <div class="body pt-0">
                    <div class="form-group">
                        <form wire:submit.prevent="save">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                                                              

                                        <div class="col-md-6 form-group">
                                            <label>Department</label>
                                            <select onclick="" class="form-control" wire:model="department">
                                                <option value=""> --- Department --- </option>
                                                @foreach(\App\Models\Department::orderBy('id', 'desc')->get() as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- <div class="col-md-12" >
                                            <div class="row  form-group" style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px 0; width: 100%; margin: auto; margin-bottom: 10px;">
                                                <br>
                                                <div class="col-md-12 form-group">
                                                    <h5>Advance</h5>
                                                </div>
                                                <br> -->

                                                <div class="col-md-6 form-group">
                                                    <label>Advance Request No </label>
                                                    <input type="text" class="form-control" placeholder="Dept/YearMonth/Req No" wire:model="advance_req_no">
                                                
                                                    @error('advance_req_no')
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
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label>Advance Nominal </label>
                                                    <input type="number" class="form-control" wire:model="advance_nominal">
                                                
                                                    @error('advance_nominal')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label>Advance Date </label>
                                                    <input type="date" class="form-control" value="<?php echo date('d/m/Y'); ?>" wire:model="advance_date">
                                                
                                                    @error('advance_date')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>
                                            <!-- </div>
                                        </div> -->

                                        <!-- <div class="col-md-12" >
                                            <div class="row  form-group" style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px 0; width: 100%; margin: auto; margin-bottom: 10px;">
                                                <br>
                                                <div class="col-md-12 form-group">
                                                    <h5>Settlement</h5>
                                                </div>
                                                <br> -->

                                                <div class="col-md-6 form-group">
                                                    <label>Settlement Date </label>
                                                    <input type="date" class="form-control" wire:model="settlement_date">
                                                
                                                    @error('settlement_date')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label>Settlement Nominal </label>
                                                    <input type="number" class="form-control" wire:model="settlement_nominal">
                                                
                                                    @error('settlement_nominal')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label>Total Settlement </label>
                                                    <input type="number" class="form-control" wire:model="total_settlement">
                                                
                                                    @error('total_settlement')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>
                                            <!-- </div>
                                        </div> -->


                                        

                                       

                                        <div class="col-md-6 form-group">
                                            <label>Cash Transaction No </label>
                                            <input type="text" class="form-control" placeholder="001/Date/Month/Year/CashOut" wire:model="cash_transaction_no">
                                           
                                            @error('advance_date')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        

                                        <div class="col-md-6 form-group">
                                            <label>Description </label>
                                            <textarea name="" id="" cols="30" rows="4" class="form-control" wire:model="description"></textarea>
                                           
                                            @error('settlement_date')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        

                                        <div class="col-md-6 form-group">
                                            <label>Difference </label>
                                            <input type="number" class="form-control" wire:model="difference">
                                           
                                            @error('difference')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        
                                        <!-- <div class="col-md-12" >
                                            <div class="row  form-group" style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px 0; width: 100%; margin: auto; margin-bottom: 10px;">
                                                <br>
                                                <div class="col-md-12 form-group">
                                                    <h5>Recorded</h5>
                                                </div>
                                                <br> -->

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
                                            <!-- </div>
                                        </div> -->
                                        

                                        <div class="col-md-6 form-group">
                                            <label>Attachment Document for Settlement</label>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <input type="file" class="form-control" wire:model="file">
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="<?php echo asset('storage/Account_Payable/Petty_Cash/'.$doc_settlement) ?>" target="_blank"><i class="fa fa-download"></i> Download</a>
                                                </div>
                                            </div>
                                           
                                            @error('leader')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <!-- 

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