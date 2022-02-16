@section('title', __('Accident Report'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="tab-content">      
                <div class="header row">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Update Request Payroll </h5>
                </div>

                <div class="body pt-0">
                    <div class="form-group">
                        <form wire:submit.prevent="save">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
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

                                        <div class="col-md-6 form-group">
                                            <label>Project Code</label>
                                            <input type="text" class="form-control" style="width:100%;" wire:model="" readonly>
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
                                                    <select class="form-control" wire:model="year">
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
                                            <label>Number of Employee </label>
                                            <input type="text" class="form-control" wire:model="employee_number">
                                           
                                            @error('employee_number')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Basic Salary </label>
                                            <input type="number" class="form-control" wire:model="basic_salary">
                                           
                                            @error('basic_salary')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Pulse Allowance </label>
                                            <input type="text" class="form-control" wire:model="pulse_allowance">
                                           
                                            @error('pulse_allowance')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Position Allowance </label>
                                            <input type="text" class="form-control" wire:model="position_allowance">
                                           
                                            @error('position_allowance')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Homebase Allowance </label>
                                            <input type="text" class="form-control" wire:model="homebase_allowance">
                                           
                                            @error('homebase_allowance')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Transport Allowance </label>
                                            <input type="text" class="form-control" wire:model="transport_allowance">
                                           
                                            @error('transport_allowance')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Motor Allowance </label>
                                            <input type="text" class="form-control" wire:model="motor_allowance">
                                           
                                            @error('motor_allowance')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Overtime Allowance </label>
                                            <input type="text" class="form-control" wire:model="overtime_allowance">
                                           
                                            @error('overtime_allowance')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Refund PPH21 </label>
                                            <input type="text" class="form-control" wire:model="refund_pph21">
                                           
                                            @error('refund_pph21')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Staff Claim </label>
                                            <input type="text" class="form-control" wire:model="staff_claim">
                                           
                                            @error('staff_claim')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Incentive </label>
                                            <input type="text" class="form-control" wire:model="incentive">
                                           
                                            @error('incentive')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Jamsostek Payable </label>
                                            <input type="text" class="form-control" wire:model="jamsostek_payable">
                                           
                                            @error('jamsostek_payable')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Jamsostek Payable - JP 1%</label>
                                            <input type="text" class="form-control" wire:model="jamsostek_payable_jp">
                                           
                                            @error('jamsostek_payable_jp')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>BPJS Kesehatan</label>
                                            <input type="text" class="form-control" wire:model="bpjs_kesehatan">
                                           
                                            @error('bpjs_kesehatan')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>PPH21</label>
                                            <input type="text" class="form-control" wire:model="pph21">
                                           
                                            @error('pph21')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Piutang</label>
                                            <input type="text" class="form-control" wire:model="piutang">
                                           
                                            @error('piutang')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Own Risk</label>
                                            <input type="text" class="form-control" wire:model="own_risk">
                                           
                                            @error('own_risk')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Unpaid Leave</label>
                                            <input type="text" class="form-control" wire:model="unpaid_leave">
                                           
                                            @error('unpaid_leave')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Pinalty</label>
                                            <input type="text" class="form-control" wire:model="pinalty">
                                           
                                            @error('pinalty')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>THP</label>
                                            <input type="text" class="form-control" wire:model="thp">
                                           
                                            @error('thp')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 form-group">
                                            <label>Cash Transaction No </label>
                                            <input type="text" class="form-control" placeholder="001/Date/Month/Year/CashOut" wire:model="cash_transaction_no">
                                           
                                            @error('cash_transaction_no')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Attachment Data from HR</label>
                                            <input type="file" class="form-control" wire:model="file">
                                           
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