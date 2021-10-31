<div class="row">
    <div class="col-md-8">
        <div class="row">
            <!-- <form wire:submit.prevent="save"> -->
                <!-- csrf -->
                <div class="col-md-12">
                    <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px;">
                        
                        
                        <div class="row">
                            <div class="col-md-4 form-group">
                            
                                <h5>Quality Management</h5> 
                            </div>
                            
                        </div>
                        <hr>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <label>Company Structure - Organization, Diagram</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <?php
                                        $get_data = \App\Models\VendorManagementehs::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '1')->first();    
                                        $count = $get_data['value'];   
                                        
                                    ?>
                                    <select name="" id="" class="form-control">
                                        <option <?php if($count == ""){ echo 'selected'; } ?> value=""></option>
                                        <option <?php if($count == "1"){ echo 'selected'; } ?> value="1">Have</option>
                                        <option <?php if($count == "0"){ echo 'selected'; } ?> value="0">Not Have</option>
                                    </select>
                                    
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label>Project Management - Organization, Diagram or Process</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <?php
                                        $get_data = \App\Models\VendorManagementehs::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '2')->first();    
                                        $count = $get_data['value'];   
                                        
                                    ?>
                                    <select name="" id="" class="form-control" >
                                        <option <?php if($count == ""){ echo 'selected'; } ?> value=""></option>
                                        <option <?php if($count == "1"){ echo 'selected'; } ?> value="1">Have</option>
                                        <option <?php if($count == "0"){ echo 'selected'; } ?> value="0">Not Have</option>
                                    </select>
                                    
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label>Quality Management - Diagram or Process</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <?php
                                        $get_data = \App\Models\VendorManagementehs::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '3')->first();    
                                        $count = $get_data['value'];   
                                        
                                    ?>
                                    <select name="" id="" class="form-control" >
                                        <option <?php if($count == ""){ echo 'selected'; } ?> value=""></option>
                                        <option <?php if($count == "1"){ echo 'selected'; } ?> value="1">Have</option>
                                        <option <?php if($count == "0"){ echo 'selected'; } ?> value="0">Not Have</option>
                                    </select>
                                    
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label>Training Management - Diagram or Process</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <?php
                                        $get_data = \App\Models\VendorManagementehs::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '4')->first();    
                                        $count = $get_data['value'];   
                                        
                                    ?>
                                    <select name="" id="" class="form-control" >
                                        <option <?php if($count == ""){ echo 'selected'; } ?> value=""></option>
                                        <option <?php if($count == "1"){ echo 'selected'; } ?> value="1">Have</option>
                                        <option <?php if($count == "0"){ echo 'selected'; } ?> value="0">Not Have</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label>Project Reporting - Diagram or Process</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <?php
                                        $get_data = \App\Models\VendorManagementehs::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '5')->first();    
                                        $count = $get_data['value'];   
                                        
                                    ?>
                                    <select name="" id="" class="form-control" >
                                        <option <?php if($count == ""){ echo 'selected'; } ?> value=""></option>
                                        <option <?php if($count == "1"){ echo 'selected'; } ?> value="1">Have</option>
                                        <option <?php if($count == "0"){ echo 'selected'; } ?> value="0">Not Have</option>
                                    </select>
                                    
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label>Documentation management - Diagram or Process</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <?php
                                        $get_data = \App\Models\VendorManagementehs::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '6')->first();    
                                        $count = $get_data['value'];   
                                        
                                    ?>
                                    <select name="" id="" class="form-control" >
                                        <option <?php if($count == ""){ echo 'selected'; } ?> value=""></option>
                                        <option <?php if($count == "1"){ echo 'selected'; } ?> value="1">Have</option>
                                        <option <?php if($count == "0"){ echo 'selected'; } ?> value="0">Not Have</option>
                                    </select>
                                    
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label>Others</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <?php
                                        $get_data = \App\Models\VendorManagementehs::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '7')->first();    
                                        $count = $get_data['value'];   
                                        
                                    ?>
                                    <select name="" id="" class="form-control" >
                                        <option <?php if($count == ""){ echo 'selected'; } ?> value=""></option>
                                        <option <?php if($count == "1"){ echo 'selected'; } ?> value="1">Have</option>
                                        <option <?php if($count == "0"){ echo 'selected'; } ?> value="0">Not Have</option>
                                    </select>
                                    
                                </div>
                            </div>

                        </div>

                        
                        
                    </div>

                    <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px;">
                        
                        
                        <div class="row">
                            <div class="col-md-4 form-group">
                            
                                <h5>EHS</h5> 
                            </div>
                            
                        </div>
                        <hr>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <label>Working at High (TKPK TK1)</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <?php
                                        $get_data = \App\Models\VendorManagementehs::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '8')->first();    
                                        $count = $get_data['value'];   
                                        
                                    ?>
                                    <input type="number" class="form-control" placeholder="{{$count}}" wire:model="value8">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label>Working at High (TKBT TK2)</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <?php
                                        $get_data = \App\Models\VendorManagementehs::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '9')->first();    
                                        $count = $get_data['value'];   
                                        
                                    ?>
                                    <input type="number" class="form-control" placeholder="{{$count}}" wire:model="value9">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label>Basic Electrical</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <?php
                                        $get_data = \App\Models\VendorManagementehs::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '10')->first();    
                                        $count = $get_data['value'];   
                                        
                                    ?>
                                    <input type="number" class="form-control" placeholder="{{$count}}" wire:model="value10">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label>First Aid </label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <?php
                                        $get_data = \App\Models\VendorManagementehs::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '11')->first();    
                                        $count = $get_data['value'];   
                                        
                                    ?>
                                    <input type="number" class="form-control" placeholder="{{$count}}" wire:model="value11">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label>K3</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <?php
                                        $get_data = \App\Models\VendorManagementehs::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '12')->first();    
                                        $count = $get_data['value'];   
                                        
                                    ?>
                                    <input type="number" class="form-control" placeholder="{{$count}}" wire:model="value12">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label>Huawei Pass ID - L0 </label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <?php
                                        $get_data = \App\Models\VendorManagementehs::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '13')->first();    
                                        $count = $get_data['value'];   
                                        
                                    ?>
                                    <input type="number" class="form-control" placeholder="{{$count}}" wire:model="value13">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label>Huawei Pass ID - L1</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <?php
                                        $get_data = \App\Models\VendorManagementehs::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '14')->first();    
                                        $count = $get_data['value'];   
                                        
                                    ?>
                                    <input type="number" class="form-control" placeholder="{{$count}}" wire:model="value14">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label>Others … </label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                <?php
                                        $get_data = \App\Models\VendorManagementehs::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '15')->first();    
                                        $count = $get_data['value'];   
                                        
                                    ?>
                                    <input type="number" class="form-control" placeholder="{{$count}}" wire:model="value15">
                                </div>
                            </div>

                            

                        </div>

                        
                        
                    </div>
                    
                    <div class="col-md-12">
                        <div class="row">
                            <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
                        </div>
                        
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
                        
                    </h1>
                </div>
            </div>

            <div class="col-md-12">
                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                    <h5>Company Structure</h5>
                    <hr>
                    <h1 style="font-size: 50px">
                    
                    </h1>
                </div>
            </div>
            <div class="col-md-12">
                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                    <h5>Quality Management</h5>
                    <hr>
                    <h1 style="font-size: 50px">
                    
                    </h1>
                </div>
            </div>

            <div class="col-md-12">
                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                    <h5>Training Management</h5>
                    <hr>
                    <h1 style="font-size: 50px">
                        
                    </h1>
                </div>
            </div>

            <div class="col-md-12">
                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                    <h5>Project Reporting</h5>
                    <hr>
                    <h1 style="font-size: 50px">
                        
                    </h1>
                </div>
            </div>

            <div class="col-md-12">
                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                    <h5>Documentation Management</h5>
                    <hr>
                    <h1 style="font-size: 50px">
                    
                    </h1>
                </div>
            </div>

            <div class="col-md-12">
                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                    <h5>Cerificate Category</h5>
                    <hr>
                    <h1 style="font-size: 50px">
                    
                    </h1>
                </div>
            </div>

            

        </div>
        
    </div>
    
</div>