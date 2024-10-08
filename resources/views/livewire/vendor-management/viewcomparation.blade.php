@section('title', __('Vendor Management - Input'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="tab-content">      
                <div class="header row">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-eye"></i> Comparation Supplier</h5>
                </div>

                <div class="body pt-0">
                    <div class="form-group">
                        <form wire:submit.prevent="save">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            @if($supplier1_id)
                                            <?php
                                                $supplier1 = get_detail_supplier($supplier1_id);
                                            ?>
                                            <div class="row" style="height: 85px;">
                                                <div class="col-md-12">
                                                    <h4>Rp.{{ format_idr($supplier1['price_offer']) }}</h4>
                                                </div>
                                                <br>
                                                @if($supplier1['scoring'])
                                                    <div class="col-md-12">
                                                        <span class="btn btn-success"><h5>{{ $supplier1['scoring'] }}</h5></span>
                                                    </div>
                                                    
                                                @endif
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            @if($supplier2_id)
                                            <?php
                                                $supplier2 = get_detail_supplier($supplier2_id);
                                            ?>
                                            <div class="row" style="height: 85px;">
                                                <div class="col-md-12">
                                                    <h4>Rp.{{ format_idr($supplier2['price_offer']) }}</h4>
                                                </div>
                                                <br>
                                                @if($supplier2['scoring'])
                                                    <div class="col-md-12">
                                                        <span class="btn btn-success"><h5>{{ $supplier2['scoring'] }}</h5></span>
                                                    </div>
                                                    
                                                @endif
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            @if($supplier3_id)
                                            <?php
                                                $supplier3 = get_detail_supplier($supplier3_id);
                                            ?>
                                            <div class="row" style="height: 85px;">
                                                <div class="col-md-12">
                                                    <h4>Rp.{{ format_idr($supplier3['price_offer']) }}</h4>
                                                </div>
                                                <br>
                                                @if($supplier3['scoring'])
                                                    <div class="col-md-12">
                                                        <span class="btn btn-success"><h5>{{ $supplier3['scoring'] }}</h5></span>
                                                    </div>
                                                    
                                                @endif
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    <br><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            @if($supplier1_id)
                                            <?php
                                                $supplier1 = get_detail_supplier($supplier1_id);
                                            ?>
                                           
                                            <hr>
                                            <br>
                                            <div class="table-responsive">
                                                <b>DETAIL SUPPLIER</b>
                                                <table class="table table-striped m-b-0 c_list">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                        <tr>
                                                            <th>Supplier Name</th>
                                                            <th> : </th>
                                                            <th>{{ $supplier1['supplier_name'] }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>PIC</th>
                                                            <th> : </th>
                                                            <th>{{ $supplier1['supplier_pic'] }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Contact</th>
                                                            <th> : </th>
                                                            <th>{{ $supplier1['supplier_contact'] }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Address</th>
                                                            <th> : </th>
                                                            <th>{{ $supplier1['supplier_address'] }}</th>
                                                        </tr>
                                                       
                                                    </thead>
                                                </table>
                                            </div>
                                            @else
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            
                                            <b>Supplier Belum ditambahkan!</b>
                                            @endif
                                        </div>

                                        <div class="col-md-4">
                                            @if($supplier2_id)
                                            <?php
                                                $supplier2 = get_detail_supplier($supplier2_id);
                                            ?>
                                           
                                            <hr>
                                            <br>
                                            <div class="table-responsive">
                                                <b>DETAIL SUPPLIER </b>
                                                <table class="table table-striped m-b-0 c_list">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                        <tr>
                                                            <th>Supplier Name</th>
                                                            <th> : </th>
                                                            <th>{{ $supplier2['supplier_name'] }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>PIC</th>
                                                            <th> : </th>
                                                            <th>{{ $supplier2['supplier_pic'] }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Contact</th>
                                                            <th> : </th>
                                                            <th>{{ $supplier2['supplier_contact'] }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Address</th>
                                                            <th> : </th>
                                                            <th>{{ $supplier2['supplier_address'] }}</th>
                                                        </tr>
                                                        
                                                    </thead>
                                                </table>
                                            </div>
                                            @else
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            
                                            <b>Supplier Belum ditambahkan!</b>
                                            @endif
                                        </div>

                                        <div class="col-md-4">
                                            @if($supplier3_id)
                                            <?php
                                                $supplier3 = get_detail_supplier($supplier3_id);
                                            ?>
                                            
                                            <hr>
                                            <br>
                                            <div class="table-responsive">
                                                <b>DETAIL SUPPLIER</b>
                                                <table class="table table-striped m-b-0 c_list">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                        <tr>
                                                            <th>Supplier Name</th>
                                                            <th> : </th>
                                                            <th>{{ $supplier3['supplier_name'] }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>PIC</th>
                                                            <th> : </th>
                                                            <th>{{ $supplier3['supplier_pic'] }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Contact</th>
                                                            <th> : </th>
                                                            <th>{{ $supplier3['supplier_contact'] }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Address</th>
                                                            <th> : </th>
                                                            <th>{{ $supplier3['supplier_address'] }}</th>
                                                        </tr>
                                                      
                                                    </thead>
                                                </table>
                                            </div>
                                            @else
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            
                                            <b>Supplier Belum ditambahkan!</b>
                                            @endif
                                        </div>
                                    </div>

                                    <br><br>
                                        
                                    <div class="row">
                                        
                                        <div class="col-md-4">
                                            @if($supplier1_id)
                                            <b>DETAIL SCORE</b>
                                            <table class="table table-striped m-b-0 c_list">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                    <tr>
                                                        <th>General Information</th>
                                                        <th> : </th>
                                                        <th>{{ $supplier1['general_information'] }}</th>
                                                    </tr>
                                                    @if($supplier1['supplier_category'] == 'Service - Company' || $supplier1['supplier_category'] == 'Service - Individual')
                                                    <tr>
                                                        <th>Team Availability</th>
                                                        <th> : </th>
                                                        <th>{{ $supplier1['team_availability_compatibility'] }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Tools & Facilities</th>
                                                        <th> : </th>
                                                        <th>{{ $supplier1['tools_facilities'] }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>EHS & Quality Management</th>
                                                        <th> : </th>
                                                        <th>{{ $supplier1['ehs_quality_management'] }}</th>
                                                    </tr>
                                                    @endif
                                                    <tr>
                                                        <th>Commercial Compliance</th>
                                                        <th> : </th>
                                                        <th>{{ $supplier1['commercial_compliance'] }}</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            @endif
                                        </div>

                                        <div class="col-md-4">
                                            @if($supplier2_id)
                                            <b>DETAIL SCORE</b>
                                            <table class="table table-striped m-b-0 c_list">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                    <tr>
                                                        <th>General Information</th>
                                                        <th> : </th>
                                                        <th>{{ $supplier2['general_information'] }}</th>
                                                    </tr>
                                                    @if($supplier2['supplier_category'] == 'Service - Company' || $supplier2['supplier_category'] == 'Service - Individual')
                                                    <tr>
                                                        <th>Team Availability</th>
                                                        <th> : </th>
                                                        <th>{{ $supplier2['team_availability_compatibility'] }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Tools & Facilities</th>
                                                        <th> : </th>
                                                        <th>{{ $supplier2['tools_facilities'] }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>EHS & Quality Management</th>
                                                        <th> : </th>
                                                        <th>{{ $supplier2['ehs_quality_management'] }}</th>
                                                    </tr>
                                                    @endif
                                                    <tr>
                                                        <th>Commercial Compliance</th>
                                                        <th> : </th>
                                                        <th>{{ $supplier2['commercial_compliance'] }}</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            @endif
                                        </div>

                                        <div class="col-md-4">
                                            @if($supplier3_id)
                                            <b>DETAIL SCORE</b>
                                            <table class="table table-striped m-b-0 c_list">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                    <tr>
                                                        <th>General Information</th>
                                                        <th> : </th>
                                                        <th>{{ $supplier3['general_information'] }}</th>
                                                    </tr>
                                                    @if($supplier3['supplier_category'] == 'Service - Company' || $supplier3['supplier_category'] == 'Service - Individual')
                                                    <tr>
                                                        <th>Team Availability</th>
                                                        <th> : </th>
                                                        <th>{{ $supplier3['team_availability_compatibility'] }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Tools & Facilities</th>
                                                        <th> : </th>
                                                        <th>{{ $supplier3['tools_facilities'] }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>EHS & Quality Management</th>
                                                        <th> : </th>
                                                        <th>{{ $supplier3['ehs_quality_management'] }}</th>
                                                    </tr>
                                                    @endif
                                                    <tr>
                                                        <th>Commercial Compliance</th>
                                                        <th> : </th>
                                                        <th>{{ $supplier3['commercial_compliance'] }}</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="row">
                                        <!-- <div class="col-md-12 form-group">
                                            <label>Supplier Name</label>
                                            <input type="text" class="form-control" wire:model="supplier_name"/>
                                            @error('supplier_name')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Supplier PIC</label>
                                            <input type="text" class="form-control" wire:model="supplier_pic"/>
                                            @error('supplier_pic')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Supplier Contact</label>
                                            <input type="text" class="form-control" wire:model="supplier_contact"/>
                                            @error('supplier_contact')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Supplier Email</label>
                                            <input type="email" class="form-control" wire:model="supplier_email"/>
                                            @error('supplier_email')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Price Offering</label>
                                            <input type="text" class="form-control" wire:model="price_offer"/>
                                            @error('price_offer')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Supplier Address</label>
                                            <textarea class="form-control" wire:model="supplier_address" rows="8" required></textarea>
                                            @error('supplier_address')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div> -->

                                        <!-- <div class="col-md-12 form-group">
                                            <label>Category</label>
                                            <select class="form-control" wire:model="unit">
                                                <option value="">-- Category --</option>
                                                <option value="sites">Service - Company</option>
                                                <option value="team">Service - Individual</option>
                                                <option value="km">Material/Tools Supplier</option>
                                            </select>
                                            @error('unit')
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
<!--                                 
                                <div class="col-md-12 form-group">
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