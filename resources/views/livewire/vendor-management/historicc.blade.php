<div class="row">
    <div class="col-md-8">
        <div class="row">
            <!-- <form wire:submit.prevent="save"> -->
                @csrf
                <div class="col-md-12">
                    <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px;">
                        
                        <?php
                            // $check_data = \App\Models\VendorManagement::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->get();
                            //  print_r($check_data);
                            
                        ?>
                        <div class="row">
                            <div class="col-md-4 form-group">
                            
                                <h5>Commercial Compliance</h5> 
                            </div>
                            
                        </div>
                        <hr>
                        <div class="row">
                        
                            <div class="col-md-4">
                                <label>Price Compliance <span style="padding: 3px 7px; background-color: #007bff; border-radius: 10px; color: white; font-size: 12px;"  tabindex="0" data-toggle="tooltip" title="Score : High (>30% = 0), Medium (10%-20% = 20), Low (< 10% = 50)">?</span> :</label>
                                
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <?php
                                            $get_data = \App\Models\VendorManagementcc::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '1')->first();    
                                            $count = $get_data['value'];     
                                            // echo $count; 
                                        ?>
                                        <select name="" id="" class="form-control" >
                                            <option value=""></option>
                                            <option <?php if($count == "50"){ echo 'selected'; } ?> value="50">Low (< 10% )</option>
                                            <option <?php if($count == '20'){ echo 'selected'; } ?> value="20">Medium ( 10% s/d 30% )</option>
                                            <option <?php if($count == '0'){ echo 'selected'; } ?> value="0">High (> 30% )</option>
                                        </select>
                                        
                                        @error('value1')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <?php
                                            $get_data = \App\Models\VendorManagementcc::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '1')->first();    
                                            $count = $get_data['note'];      
                                        ?>
                                        <input type="text" min='0' max="100" class="form-control" placeholder="{{$count}}" wire:model="note1"/>
                                        @error('note1')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                        @enderror
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-md-4">
                                <label>Lead Time Compliance <span style="padding: 3px 7px; background-color: #007bff; border-radius: 10px; color: white; font-size: 12px;"  tabindex="0" data-toggle="tooltip" title="Score : High (>30% = 0), Medium (10%-20% = 20), Low (< 10% = 50)">?</span> :</label>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <?php
                                            $get_data = \App\Models\VendorManagementcc::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '2')->first();    
                                            $count = $get_data['value'];     
                                            // echo $count; 
                                        ?>
                                        <select name="" id="" class="form-control">
                                            <option value=""></option>
                                            <option <?php if($count == "0"){ echo 'selected'; } ?> value="0">Low</option>
                                            <option <?php if($count == "10"){ echo 'selected'; } ?> value="10">Medium</option>
                                            <option <?php if($count == "30"){ echo 'selected'; } ?> value="30">High</option>
                                        </select>
                                        
                                        @error('value2')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <?php
                                            $get_data = \App\Models\VendorManagementcc::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '2')->first();    
                                            $count = $get_data['note'];     
                                            // echo $count; 
                                        ?>
                                        <input type="text" min='0' max="100" class="form-control" placeholder="{{$count}}" wire:model="note2"/>
                                        @error('note2')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                        @enderror
                                    </div>
                                </div>
                                
                            </div>

                            <div class="col-md-4">
                                <label>Payment Term Compliance <span style="padding: 3px 7px; background-color: #007bff; border-radius: 10px; color: white; font-size: 12px;"  tabindex="0" data-toggle="tooltip" title="Score : High = 30, Medium = 10, Low = 0">?</span> :</label>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <?php
                                            $get_data = \App\Models\VendorManagementcc::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '3')->first();    
                                            $count = $get_data['value'];   
                                            
                                        ?>
                                        <select name="" id="" class="form-control" >
                                            <option value=""></option>
                                            <option <?php if($count == "0"){ echo 'selected'; } ?> value="0">Low ( >=45 days )</option>
                                            <option <?php if($count == "10"){ echo 'selected'; } ?> value="10">Medium ( 30 days )</option>
                                            <option <?php if($count == "20"){ echo 'selected'; } ?> value="20">High ( < 15 days )</option>
                                        </select>
                                        
                                        @error('value3')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <?php
                                            $get_data = \App\Models\VendorManagementcc::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '3')->first();    
                                            $count = $get_data['note'];     
                                        ?>
                                        <input type="text" class="form-control" placeholder="{{$count}}" wire:model="note3"/>
                                        @error('note3')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                        @enderror
                                    </div>
                                </div>
                                
                            </div>

                            <div class="col-md-4">
                                <label>Special Requirement <span style="padding: 3px 7px; background-color: #007bff; border-radius: 10px; color: white; font-size: 12px;"  tabindex="0" data-toggle="tooltip" title="">?</span> :</label>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        
                                        <?php
                                            $get_data = \App\Models\VendorManagementcc::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '4')->first();    
                                            $count = $get_data['value'];   
                                            
                                        ?>
                                        <input type="number" min='0' max="50" class="form-control" placeholder="{{$count}}" wire:model="value4"/>
                                        
                                        @error('value4')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <?php
                                            $get_data = \App\Models\VendorManagementcc::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '4')->first();    
                                            $count = $get_data['note'];   
                                            
                                        ?>
                                        <input type="text" min='0' max="100" class="form-control" placeholder="{{$count}}"  wire:model="note4"/>
                                        @error('note4')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                        @enderror
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                     
                        
                    </div>
                </div> 
                
            <!-- </form> -->
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 180px;">
                    <div class="row">
                        <div class="col-md-9 form-group">
                            <h5>Total Score</h5>
                        </div>
                        <!-- <div class="col-md-3">
                            
                        </div> -->
                    </div>
                    
                    <hr>
                    <h1 style="font-size: 65px">
                        {{ @$value1 + @$value2 + @$value3 + @$value4 }}
                    </h1>
                </div>
            </div>
            <div class="col-md-12">
                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 180px;">
                    <h5>Price Compliance</h5>
                    <hr>
                    <h1 style="font-size: 50px">
                        {{ @$value1 }}
                    </h1>
                </div>
            </div>

            <div class="col-md-12">
                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 180px;">
                    <h5>Lead Time Compliance</h5>
                    <hr>
                    <h1 style="font-size: 50px">
                        {{ @$value2 }}
                    </h1>
                </div>
            </div>

            <div class="col-md-12">
                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 180px;">
                    <h5>Payment Term Compliance</h5>
                    <hr>
                    <h1 style="font-size: 50px">
                        {{ @$value3 }}
                    </h1>
                </div>
            </div>

            <div class="col-md-12">
                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 180px;">
                    <h5>Special Requirement</h5>
                    <hr>
                    <h1 style="font-size: 50px">
                        {{ @$value4 }}
                    </h1>
                </div>
            </div>
        </div>
        
    </div>
    
</div>