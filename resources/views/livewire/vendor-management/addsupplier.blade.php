@section('title', __('Vendor Management - Input'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="tab-content">      
                <div class="header row">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Add Supplier</h5>
                </div>

                <div class="body pt-0">
                    
                    <div class="form-group">
                        <form wire:submit.prevent="save">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <input type="text" class="form-control" placeholder="Search Supplier Name"  wire:model="suppliername"/>
                                        @error('project_name')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="table table-striped m-b-0 c_list">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Supplier Name</th> 
                                                        <th>Supplier PIC</th> 
                                                        <th>Price Offer</th> 
                                                        <th>Initial</th> 
                                                        <th>Evaluation</th> 
                                                        <th>Action</th> 
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($datasupplier as $key => $item)
                                                    <tr>
                                                        <td>{{$key + 1}}</td>
                                                        <td>{{ $item->supplier_name }}</td> 
                                                        <td>{{ $item->supplier_pic }}</td> 
                                                        <td>Rp, {{ format_idr($item->price_offer) }}</td> 
                                                        <td>
                                                            @if($item->initial)
                                                                <a href="javascript:;" title="Upload">
                                                                    <label class="badge badge-success"  style="cursor: pointer;" data-toggle="tooltip" title="<?php echo $item->initial; ?>" >{{ $item->initial }}</label>
                                                                </a>
                                                            @else
                                                                <label class="badge badge-danger" data-toggle="tooltip" title="0">0</label>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($item->scoring)
                                                                <a href="javascript:;"  title="Upload">
                                                                    <label class="badge badge-success"  style="cursor: pointer;" data-toggle="tooltip" title="<?php echo $item->scoring; ?>" >{{ $item->scoring }}</label>
                                                                </a>
                                                            @else
                                                                <label class="badge badge-danger" data-toggle="tooltip" title="0">0</label>
                                                            @endif
                                                        </td> 
                                                        <td>
                                                            <a href="" wire:click="choosesupp({{ $item->id }}, {{$supptype}}, {{$project_id}})"><i class="fa fa-search" style="color: #007bff;"></i></a>
                                                        </td> 
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- <div class="col-md-6 form-group">
                                            <input type="text" class="form-control" placeholder="Search Supplier Name"  wire:model="project_name"/>
                                            @error('project_name')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <select class="form-control" wire:model="project_category">
                                                <option value="">-- Category --</option>
                                                <option value="sites">Service - Company</option>
                                                <option value="team">Service - Individual</option>
                                                <option value="km">Material/Tools Supplier</option>
                                            </select>
                                            @error('project_category')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div> -->
                                  
                                        <!-- <div class="col-md-12 form-group">
                                            <label>Region</label>
                                            <select class="form-control" wire:model="region" required>
                                                <option value="">-- Region --</option>
                                                @foreach(\App\Models\Region::orderBy('id', 'desc')->get() as $item)
                                                <option value="{{ $item->region }}">{{ $item->region }}</option>
                                                @endforeach
                                            </select>
                                            @error('region')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <div class="row">
                                                <div class="col-md-8 form-group">
                                                    <label>Quantity</label>
                                                    <input type="number" class="form-control" wire:model="qty" required/>
                                                    @error('qty')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label>Unit</label>
                                                    <select class="form-control" wire:model="unit">
                                                        <option value="">-- Unit --</option>
                                                        <option value="sites">Sites</option>
                                                        <option value="team">Team</option>
                                                        <option value="km">KM</option>
                                                    </select>
                                                    @error('unit')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                        </div> -->
                                        <!-- <div class="col-md-6 form-group">
                                            <label>Price / Unit (IDR)</label>
                                          
                                            <input type="text" class="form-control" name="currency-field" id="currency-field" value="" data-type="currency" wire:model="price_or_unit" required placeholder="Rp1,000,000">
                                            @error('price_or_unit')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Estimated Revenue (IDR)</label>
                                           
                                            <input type="text" class="form-control" name="currency-field" id="currency-field" value="" data-type="currency" wire:model="estimate_revenue" required placeholder="Rp1,000,000">
                                            @error('estimate_revenue')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div> -->
                                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                                        <script>

                                            // Jquery Dependency

                                            
                                            $("input[data-type='currency']").on({
                                                keyup: function() {
                                                formatCurrency($(this));
                                                },
                                                blur: function() { 
                                                formatCurrency($(this), "blur");
                                                }
                                            });


                                            function formatNumber(n) {
                                                // format number 1000000 to 1,234,567
                                                return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                                            }


                                            function formatCurrency(input, blur) {
                                                var input_val = input.val();
                                                if (input_val === "") { return; }
                                                var original_len = input_val.length;
                                                var caret_pos = input.prop("selectionStart");
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
                                                
                                                // send updated string to input
                                                input.val(input_val);

                                                // put caret back in the right position
                                                var updated_len = input_val.length;
                                                caret_pos = updated_len - original_len + caret_pos;
                                                input[0].setSelectionRange(caret_pos, caret_pos);
                                            }



                                        </script>
                             
                                        <!-- <div class="col-md-6 form-group">
                                            <label>Start Duration</label>
                                            <input type="date" class="form-control" wire:model="startdate" required/>
                                            @error('startdate')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>End Duration</label>
                                            <input type="date" class="form-control" wire:model="enddate" required/>
                                            @error('enddate')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div> -->
                                   
                                       
                                        
                                       
                                       
                                    </div>
                                </div>
                                
                                <!-- <div class="col-md-12 form-group">
                                    <hr />
                                    
                                    <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
                                </div> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>