@section('title', __('Accident Report'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="tab-content">      
                <div class="header row">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-eye"></i> Detail Request</h5>
                </div>

                <div class="body pt-0">
                    <div class="form-group">
                        <form wire:submit.prevent="save">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label>Employee Name</label>
                                            <input list="petty_cash_category1" class="form-control"  wire:model="employee_name" readonly>
                                           

                                            @error('employee_name')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Project</label>
                                            <input type="text" class="form-control" wire:model="project" readonly/>
                                            @error('employee_id')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Region</label>
                                            <input type="text" class="form-control" wire:model="region" readonly/>
                                            
                                            @error('date')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-12 form-group">
                                            <label>Date </label>
                                            <input type="date" class="form-control" wire:model="date" readonly>
                                           
                                            @error('leader')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
<!-- 
                                        <div class="col-md-12 form-group">
                                            <label>Ticket Type</label>
                                            <select onclick="" class="form-control" wire:model="ticket_type">
                                                <option value=""> --- Ticket Type --- </option>
                                                <option value="1">Hotel & Flight</option>
                                                <option value="2">Hotel only</option>
                                                
                                            </select>
                                            @error('employee_id')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div> -->

                                        

                                        <div class="col-md-12 form-group">
                                            <label>Meeting Location</label>
                                            <!-- <input type="text" class="form-control" wire:model="meeting_location"> -->
                                            <textarea name="" id="" cols="30" rows="2" class="form-control" wire:model="meeting_location" readonly></textarea>
                                            @error('leader')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <hr>
                                        <br>

                                        <!-- <div class="col-md-12 form-group">
                                            <label>Category</label>
                                            <select onclick="" class="form-control" wire:model="project">
                                                <option value=""> --- Ticket Type --- </option>
                                                <option value="1">Hotel & Flight</option>
                                                <option value="2">Hotel only</option>
                                                
                                            </select>
                                            @error('employee_id')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div> -->

                                        @if($tickettype == true)
                                        <div class="row">
                                            <div class="col-md-12" >
                                                <div class="row  form-group" style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px 0; width: 95%; margin: auto;">
                                                    <br>
                                                    <div class="col-md-12">
                                                        <h5>Flight Information</h5>
                                                    </div>
                                                    <hr>
                                                    <div class="col-md-6 form-group">
                                                        <label>Departure Airport</label>
                                                        <input type="text" class="form-control" wire:model="departure_airport" readonly>
                                                    
                                                        @error('departure_airport')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6 form-group">
                                                        <label>Arrival Airport</label>
                                                        <input type="text" class="form-control" wire:model="arrival_airport" readonly>
                                                    
                                                        @error('arrival_airport')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6 form-group">
                                                        <label>Departure Time</label>
                                                        <input type="time" class="form-control" wire:model="departure_time">
                                                    
                                                        @error('departure_time')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6 form-group">
                                                        <label>Arrival Time</label>
                                                        <input type="time" class="form-control" wire:model="arrival_time">
                                                    
                                                        @error('arrival_time')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6 form-group">
                                                        <label>Airline</label>
                                                        <input type="text" class="form-control" wire:model="airline">
                                                    
                                                        @error('airline')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6 form-group">
                                                        <label>Agency</label>
                                                        <input type="text" class="form-control" wire:model="agency">
                                                    
                                                        @error('agency')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-12 form-group">
                                                        <label>Flight Price</label>
                                                        <input type="text" class="form-control" wire:model="flight_price">
                                                    
                                                        @error('flight_price')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-12 form-group">
                                                        <label>Confirmation Flight</label>
                                                        <input type="file" class="form-control" name="file" wire:model="file" />
                                                    
                                                        @error('leader')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <br>
                                        
                                        @endif


                                        <div class="row">
                                            <div class="col-md-12" >
                                                <div class="row" style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px 0; width: 95%; margin: auto;">
                                                    <br>
                                                    <div class="col-md-12">
                                                        <h5>Hotel Information</h5>
                                                    </div>
                                                    <hr>
                                                    <div class="col-md-6 form-group">
                                                        <label>Hotel Price</label>
                                                        <input type="text" class="form-control" wire:model="hotel_price">
                                                    
                                                        @error('hotel_price')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6 form-group">
                                                        <label>Hotel Name</label>
                                                        <input type="text" class="form-control" wire:model="hotel_name">
                                                    
                                                        @error('hotel_name')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-12 form-group">
                                                        <label>Hotel Location</label>
                                                        <!-- <input type="text" class="form-control" wire:model="departure_airport"> -->
                                                        <textarea name="" id="" cols="30" rows="2" class="form-control" wire:model="hotel_location"></textarea>
                                                        @error('hotel_location')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                       

                                       

                                        <!-- <div class="col-md-6 form-group">
                                            <label>Start Plan Schedule</label>
                                            <input type="time" class="form-control" wire:model="start_time_plan">
                                           
                                            @error('leader')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>End Plan Schedule</label>
                                            <input type="time" class="form-control"  wire:model="end_time_plan">
                                           
                                            @error('leader')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
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