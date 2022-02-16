@section('title', __('Accident Report'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="tab-content">      
                <div class="header row">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Update Request Weekly Opex </h5>
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

                                        <div class="col-md-12 form-group">
                                            <label>Description </label>
                                            <textarea name="" id="" cols="30" rows="4" class="form-control" wire:model="description"></textarea>
                                           
                                            @error('description')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 form-group">
                                            <label>Budget Opex </label>
                                            <input type="number" class="form-control" wire:model="budget_opex">
                                           
                                            @error('budget_opex')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Previous Balance </label>
                                            <input type="number" class="form-control" wire:model="previous_balance">
                                           
                                            @error('previous_balance')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Total Transfer </label>
                                            <input type="number" class="form-control" wire:model="total_transfer">
                                           
                                            @error('total_transfer')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Transfer Date </label>
                                            <input type="date" class="form-control" wire:model="transfer_date">
                                           
                                            @error('transfer_date')
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
                                            <label>Settlement Date </label>
                                            <input type="date" class="form-control" wire:model="settlement_date">
                                           
                                            @error('settlement_date')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        

                                        <div class="col-md-12 form-group">
                                            <label>Settlement Description </label>
                                            <textarea name="" id="" cols="30" rows="4" class="form-control" wire:model="description"></textarea>
                                           
                                            @error('settlement_date')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        

                                        <div class="col-md-6 form-group">
                                            <label>Settlement Nominal </label>
                                            <input type="number" class="form-control" wire:model="settlement_nominal">
                                           
                                            @error('difference')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Total Settlement </label>
                                            <input type="number" class="form-control" wire:model="total_settlement">
                                           
                                            @error('difference')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                            

                                        <!-- <div class="col-md-6 form-group">
                                            <label>Advance or Not </label>
                                            <select class="form-control" style="width:100%;" wire:model="advance">
                                                <option value=""> --- Advance --- </option>
                                                <option value="1">YES</option>
                                                <option value="0">NO</option>
                                            </select>
                                           
                                            @error('difference')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div> -->

                                        <div class="col-md-6 form-group">
                                            <label>Admin to Team </label>
                                            <input type="number" class="form-control" wire:model="admin_to_team">
                                           
                                            @error('admin_to_team')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Difference (Admin - Team)</label>
                                            <input type="number" class="form-control" wire:model="difference_admin_team">
                                           
                                            @error('difference')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Difference (HQ - Admin)</label>
                                            <input type="number" class="form-control" wire:model="difference_hq_admin">
                                           
                                            @error('difference_hq_admin')
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
                                            <input type="file" class="form-control" wire:model="file">
                                           
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