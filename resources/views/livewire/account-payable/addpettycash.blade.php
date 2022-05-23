@section('title', __('Accident Report'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="tab-content">      
                <div class="header row">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Add Request Petty Cash </h5>
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
                                            <div class="row">
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
                                            </div>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Sub Request Type</label>
                                            <select onclick="" class="form-control" wire:model="subrequest_type">
                                               
                                                <option value=""> --- Sub Request Type (Petty Cash) --- </option>
                                                @foreach(\App\Models\RequestDetailOption::where('id_request_type', '1')->get() as $item)
                                                    <option value="{{ $item->id_detail_request_option }}">{{ $item->request_detail_option }}</option>
                                                @endforeach
                                                <!-- <option value="1">Petty Cash Team HR</option>
                                                <option value="2">Petty Cash Team PL</option>
                                                <option value="3">Petty Cash Team GA</option>
                                                <option value="4">Petty Cash Team IT</option>
                                                <option value="5">Petty Cash TOC</option>
                                                <option value="6">Petty Cash Finance</option>
                                                <option value="7">Petty Cash PA (CEO)</option> -->
                                            </select>
                                        </div>

                                        

                                        <div class="col-md-6 form-group">
                                            <div class="row">
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
                                                        @foreach(\App\Models\AccountPayable::groupBy('doc_name')->get() as $item)
                                                        <option value="{{ $item->doc_name }}">
                                                        @endforeach
                                                    </datalist>
                                                    @error('doc_name')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>
                                            </div>
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

                                        <div class="row">
                                            <div class="col-md-12" >
                                                <div class="row  form-group" style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px 0; width: 96%; margin: auto; margin-bottom: 15px;">
                                                    <br>
                                                    
                                                    <br>
                                                    <div class="col-md-6">
                                                        <h5><u>Advance</u></h5>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <b>Advance Date : </b><?php echo date('d M Y'); ?>
                                                    </div>
                                                    <hr>
                                                    <div class="col-md-6 form-group">
                                                        <label>Advance Request No </label>
                                                        <input type="text" class="form-control" placeholder="Dept/YearMonth/Req No" wire:model="advance_req_no" readonly>
                                                    
                                                        @error('advance_req_no')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>

                                                    

                                                    <div class="col-md-6 form-group">
                                                        <label>Advance Nominal </label>
                                                        <input type="number" class="form-control" wire:model="advance_nominal">
                                                    
                                                        @error('advance_nominal')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>

                                                    <?php
                                                        for($i = 1; $i<=5; $i++){
                                                    ?>
                                                    
                                                    <div class="col-md-12 form-group">
                                                        <label>Description <?php echo $i; ?></label>
                                                        <!-- <textarea name="" id="" cols="30" rows="4" class="form-control" wire:model="description"></textarea> -->
                                                        <input type="text" class="form-control" wire:model="description<?php echo $i; ?>">

                                                        @error('settlement_date')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>

                                                    <?php
                                                        }
                                                    ?>

                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-md-6 form-group">
                                            <label>Cash Transaction No </label>
                                            <input type="text" class="form-control" placeholder="001/Date/Month/Year/CashOut" wire:model="cash_transaction_no" readonly>
                                           
                                            @error('advance_date')
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