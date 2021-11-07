@section('title', __('Vendor Management - Initial General Information'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
    <div class="card">
            <div>
                <br>
            </div>
            <div>
                <br>
            </div>
            <ul class="nav nav-tabs">

            @if(count(\App\Models\VendorManagementgi::select('created_at')->where('id_supplier', $this->selected_id)->get()) < 1)
                
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#newevaluation">New Evaluation</a></li>
                @else
                    @foreach(\App\Models\VendorManagementgi::select('created_at')->where('id_supplier', $this->selected_id)->groupBy(DB::Raw('date(created_at)'))->orderBy(DB::Raw('date(created_at)'), 'desc')->get() as $key => $item)
                        <li class="nav-item"><a class="nav-link  active show" data-toggle="tab" href="#historigi<?php echo date_format(date_create($item->created_at), 'dMY'); ?>">{{ date_format(date_create($item->created_at), 'd M Y') }}<?php if($key == 0){ echo "<span style='color: red;'>*</span>"; } ?></a></li>
                    @endforeach
                @endif
            </ul>
            <div class="tab-content">
            @if(count(\App\Models\VendorManagementgi::select('created_at')->where('id_supplier', $this->selected_id)->get()) < 1)
                <div class="tab-pane active show" id="newevaluation">  
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <form wire:submit.prevent="save">
                                    @csrf
                                    <div class="col-md-12">
                                        <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px;">
                                            <?php
                                                $check_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->get();
                                            ?>
                                            
                                            <div class="row">
                                                <div class="col-md-10 form-group">
                                                    <h5>General Information</h5> 
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                                            <div class="form-group">
                                                                <label >Supplier Owner Name :</label>
                                                                <input type="hidden" class="form-control" value="Owner Name" wire:model="service_type1">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                                            <div class="form-group">
                                                                <label><b>Supplier Owner Licence KTP :</b> </label>
                                                                <input type="hidden" class="form-control" value="owner_licence_ktp" wire:model="service_type2">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12" style="margin-bottom: 8px;">
                                                            <div class="form-group">
                                                                <label><b>Supplier Owner Licence NPWP :</b> </label>
                                                                <input type="hidden" class="form-control" value="owner_licence_npwp" wire:model="service_type3">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                                            <div class="form-group">
                                                                <label>Establish year :</label>
                                                                <input type="hidden" class="form-control" value="est_year" wire:model="service_type4">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12" style="height: 150px; overflow:hidden;">
                                                            <div class="form-group" >
                                                                <label>HQ Address :</label>
                                                                <input type="hidden" class="form-control" value="hq_add" wire:model="service_type5">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12" style="height: 140px; overflow:hidden;">
                                                            <div class="form-group">
                                                            <label>Branch Address :</label>
                                                            <input type="hidden" class="form-control" value="branch_add" wire:model="service_type6">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                                            <div class="form-group">
                                                            <label>Telephone - office :</label>
                                                            <input type="hidden" class="form-control" value="telp_office" wire:model="service_type7">
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                                            <div class="form-group">
                                                                <label>Commercial Contact Name :</label>
                                                                <input type="hidden" class="form-control" value="com_name" wire:model="service_type8">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                                            <div class="form-group">
                                                            <p>Phone / Handphone:</p>
                                                            <input type="hidden" class="form-control" value="com_phone" wire:model="service_type9">
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                                            <div class="form-group">
                                                                <p>Email :</p>
                                                                <input type="hidden" class="form-control" value="com_email" wire:model="service_type10">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                                            <div class="form-group">
                                                            <label>Technical Contact Name :</label>
                                                            <input type="hidden" class="form-control" value="tech_name" wire:model="service_type11">
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                                            <div class="form-group">
                                                            <p>Phone / Handphone:</p>
                                                            <input type="hidden" class="form-control" value="tech_phone" wire:model="service_type12">
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                                            <div class="form-group">
                                                            <p>Email :</p>
                                                            <input type="hidden" class="form-control" value="tech_email" wire:model="service_type13">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                                            <div class="form-group">
                                                                <label>Notas :</label>
                                                                <input type="hidden" class="form-control" value="notas_gi" wire:model="service_type14">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <!-- <?php
                                                                    if(count($check_data) > 0){
                                                                    
                                                                        $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '1')->first();
                                                                        
                                                                        $count = $get_data['value'];      
                                                                ?>
                                                                    <input type="text" wire:change="updatedata('value', '1')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value1"/>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <input type="text" class="form-control" wire:model="value1"/>
                                                                <?php
                                                                    }
                                                                ?> -->
                                                                <input type="text" class="form-control" wire:model="value1"/>
                                                                @error('value1')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <!-- <?php
                                                                    if(count($check_data) > 0){
                                                                        $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '2')->first();
                                                                        $count = $get_data['value'];      
                                                                ?>
                                                                    <input type="text" wire:change="updatedata('value', '2')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value2"/>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <input type="text" class="form-control" wire:model="value2"/>
                                                                <?php
                                                                    }
                                                                ?> -->
                                                                <input type="text" class="form-control" wire:model="value2"/>
                                                                @error('owner_licence_ktp')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <!-- <?php
                                                                    if(count($check_data) > 0){
                                                                        $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '3')->first();
                                                                        $count = $get_data['value'];
                                                                        
                                                                ?>
                                                                    
                                                                    <input type="text" wire:change="updatedata('value', '3')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value3"/>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <input type="text" class="form-control" wire:model="value3"/>
                                                                <?php
                                                                    }
                                                                ?> -->
                                                                <input type="text" class="form-control" wire:model="value3"/>
                                                                @error('owner_licence_npwp')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <!-- <?php
                                                                    if(count($check_data) > 0){
                                                                        $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '4')->first();
                                                                        $count = $get_data['value'];
                                                                        
                                                                ?>
                                                                    
                                                                    <input type="text" wire:change="updatedata('value', '4')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value4"/>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <input type="text" class="form-control" wire:model="value4"/>
                                                                <?php
                                                                    }
                                                                ?> -->
                                                                <input type="text" class="form-control" wire:model="value4"/>
                                                                @error('est_year')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <!-- <?php
                                                                    if(count($check_data) > 0){
                                                                        $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '5')->first();
                                                                        $count = $get_data['value'];
                                                                        
                                                                ?>
                                                                    
                                                                    <textarea wire:change="updatedata('value', '5')"  name="" id="" cols="30" rows="6" placeholder="{{ $count }}" class="form-control" wire:model="value5"><?php echo $count; ?></textarea>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <textarea name="" id="" cols="30" rows="6"  class="form-control" wire:model="value5"></textarea>
                                                                <?php
                                                                    }
                                                                ?> -->
                                                                <textarea name="" id="" cols="30" rows="6"  class="form-control" wire:model="value5"></textarea>
                                                                
                                                                
                                                                @error('hq_add')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <!-- <?php
                                                                    if(count($check_data) > 0){
                                                                        $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '6')->first();
                                                                        $count = $get_data['value'];
                                                                        
                                                                ?>
                                                                    <textarea wire:change="updatedata('value', '6')"  name="" id="" cols="30" rows="6" placeholder="{{ $count }}" class="form-control" wire:model="value6"><?php echo $count; ?></textarea>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <textarea name="" id="" cols="30" rows="6"  class="form-control" wire:model="value6"></textarea>
                                                                <?php
                                                                    }
                                                                ?> -->
                                                                <textarea name="" id="" cols="30" rows="6"  class="form-control" wire:model="value6"></textarea>
                                                                
                                                                @error('branch_add')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <!-- <?php
                                                                    if(count($check_data) > 0){
                                                                        $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '7')->first();
                                                                        $count = $get_data['value'];
                                                                ?>
                                                                    <input wire:change="updatedata('value', '7')" type="text" placeholder="{{ $count }}" class="form-control" wire:model="value7"/>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <input type="text" class="form-control" wire:model="value7"/>
                                                                <?php
                                                                    }
                                                                ?> -->
                                                                <input type="text" class="form-control" wire:model="value7"/>
                                                                
                                                                @error('telp_office')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <!-- <?php
                                                                    if(count($check_data) > 0){
                                                                        $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '8')->first();
                                                                        $count = $get_data['value'];
                                                                ?>
                                                                    <input wire:change="updatedata('value', '8')" type="text" placeholder="{{ $count }}" class="form-control" wire:model="value8"/>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <input type="text" class="form-control" wire:model="value8"/>
                                                                <?php
                                                                    }
                                                                ?> -->
                                                                <input type="text" class="form-control" wire:model="value8"/>
                                                                
                                                                @error('com_name')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <!-- <?php
                                                                    if(count($check_data) > 0){
                                                                        $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '9')->first();
                                                                        $count = $get_data['value'];
                                                                ?>
                                                                    <input wire:change="updatedata('value', '9')" type="text" placeholder="{{ $count }}" class="form-control" wire:model="value9"/>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <input type="text" class="form-control" wire:model="value9"/>
                                                                <?php
                                                                    }
                                                                ?> -->
                                                                <input type="text" class="form-control" wire:model="value9"/>
                                                                @error('com_phone')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <!-- <?php
                                                                    if(count($check_data) > 0){
                                                                        $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '10')->first();
                                                                        $count = $get_data['value'];
                                                                ?>
                                                                    <input wire:change="updatedata('value', '10')" type="email" placeholder="{{ $count }}" class="form-control" wire:model="value10"/>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <input type="text" class="form-control" wire:model="value10"/>
                                                                <?php
                                                                    }
                                                                ?> -->
                                                                <input type="text" class="form-control" wire:model="value10"/>
                                                                
                                                                @error('com_email')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <!-- <?php
                                                                    if(count($check_data) > 0){
                                                                        $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '11')->first();
                                                                        $count = $get_data['value'];
                                                                ?>
                                                                    <input wire:change="updatedata('value', '11')" type="text" placeholder="{{ $count }}" class="form-control" wire:model="value11"/>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <input type="text" class="form-control" wire:model="value11"/>
                                                                <?php
                                                                    }
                                                                ?> -->
                                                                <input type="text" class="form-control" wire:model="value11"/>
                                                                
                                                                @error('tech_name')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <!-- <?php
                                                                    if(count($check_data) > 0){
                                                                        $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '12')->first();
                                                                        $count = $get_data['value'];
                                                                ?>
                                                                    <input wire:change="updatedata('value', '12')" type="text" placeholder="{{ $count }}" class="form-control" wire:model="value12"/>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <input type="text" class="form-control" wire:model="value12"/>
                                                                <?php
                                                                    }
                                                                ?> -->
                                                                <input type="text" class="form-control" wire:model="value12"/>
                                                                @error('tech_phone')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <!-- <?php
                                                                    if(count($check_data) > 0){
                                                                        $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '13')->first();
                                                                        $count = $get_data['value'];
                                                                ?>
                                                                    <input wire:change="updatedata('value', '13')" type="email" placeholder="{{ $count }}" class="form-control" wire:model="value13"/>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <input type="email" min='0' max="100" class="form-control" wire:model="value13"/>
                                                                <?php
                                                                    }
                                                                ?> -->
                                                                <input type="email" min='0' max="100" class="form-control" wire:model="value13"/>
                                                                
                                                                @error('tech_email')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <!-- <?php
                                                                    if(count($check_data) > 0){
                                                                        $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '14')->first();
                                                                        $count = $get_data['value'];
                                                                        
                                                                ?>
                                                                    <textarea wire:change="updatedata('value', '14')"  name="" id="" cols="30" rows="6" placeholder="{{ $count }}" class="form-control" wire:model="value14"><?php echo $count; ?></textarea>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <textarea name="" id="" cols="30" rows="6" class="form-control" wire:model="value14"></textarea>
                                                                <?php
                                                                    }
                                                                ?> -->
                                                                <textarea name="" id="" cols="30" rows="6" class="form-control" wire:model="value14"></textarea>
                                                                
                                                                @error('notas_gi')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            
                                            
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-12">
                                        <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px;">
                                            
                                            
                                            <div class="row">
                                                <div class="col-md-8 form-group">
                                                    <h5>Financial Status</h5> 
                                                </div>
                                                
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <p>Main Customers TOP 3 :</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <!-- <?php
                                                            if(count($check_data) > 0){
                                                                $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '15')->first();
                                                                $count = $get_data['value'];      
                                                        ?>
                                                            <input type="text" wire:change="updatedata('value', '15')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value15"/>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            <input type="text" class="form-control" wire:model="value15"/>
                                                        <?php
                                                            }
                                                        ?> -->
                                                        <input type="text" class="form-control" wire:model="value15"/>
                                                        
                                                        @error('value15')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>Government Clients TOP 3 :</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <!-- <?php
                                                            if(count($check_data) > 0){
                                                                $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '16')->first();
                                                                $count = $get_data['value'];      
                                                        ?>
                                                            <input type="text" wire:change="updatedata('value', '16')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value16"/>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            <input type="text" class="form-control" wire:model="value16"/>
                                                        <?php
                                                            }
                                                        ?> -->
                                                        <input type="text" class="form-control" wire:model="value16"/>
                                                        
                                                        @error('value16')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>Other Customers :</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <!-- <?php
                                                            if(count($check_data) > 0){
                                                                $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '17')->first();
                                                                $count = $get_data['value'];      
                                                        ?>
                                                            <input type="text" wire:change="updatedata('value', '17')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value17"/>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            <input type="text" class="form-control" wire:model="value17"/>
                                                        <?php
                                                            }
                                                        ?> -->
                                                        <input type="text" class="form-control" wire:model="value17"/>
                                                        
                                                        @error('value17')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>2017 Total Invoiced Amount (IDR) :</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <!-- <?php
                                                            if(count($check_data) > 0){
                                                                $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '18')->first();
                                                                $count = $get_data['value'];      
                                                        ?>
                                                            <input type="text" wire:change="updatedata('value', '18')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value18"/>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            <input type="text" class="form-control" wire:model="value18"/>
                                                        <?php
                                                            }
                                                        ?> -->
                                                        <input type="text" class="form-control" wire:model="value18"/>
                                                        
                                                        @error('value18')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>2018 Total Invoiced Amount (IDR) :</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <!-- <?php
                                                            if(count($check_data) > 0){
                                                                $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '19')->first();
                                                                $count = $get_data['value'];      
                                                        ?>
                                                            <input type="text" wire:change="updatedata('value', '19')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value19"/>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            <input type="text" class="form-control" wire:model="value19"/>
                                                        <?php
                                                            }
                                                        ?> -->
                                                        <input type="text" class="form-control" wire:model="value19"/>
                                                        
                                                        @error('value19')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>2019 Total Invoiced Amount (IDR) :</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <!-- <?php
                                                            if(count($check_data) > 0){
                                                                $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '20')->first();
                                                                $count = $get_data['value'];      
                                                        ?>
                                                            <input type="text" wire:change="updatedata('value', '20')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value20"/>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            <input type="text" class="form-control" wire:model="value20"/>
                                                        <?php
                                                            }
                                                        ?> -->
                                                        <input type="text" class="form-control" wire:model="value20"/>
                                                        
                                                        @error('value20')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>Balance 2017 (IDR) :</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <!-- <?php
                                                                    if(count($check_data) > 0){
                                                                        $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '21')->first();
                                                                        $count = $get_data['value'];      
                                                                ?>
                                                                    <input type="text" wire:change="updatedata('value', '21')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value21"/>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <input type="text" class="form-control" wire:model="value21"/>
                                                                <?php
                                                                    }
                                                                ?> -->

                                                                <input type="text" class="form-control" wire:model="value21"/>
                                                                
                                                                @error('value21')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <!-- <?php
                                                                    if(count($check_data) > 0){
                                                                        $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '22')->first();
                                                                        $count = $get_data['value'];      
                                                                ?>
                                                                    <input type="text" wire:change="updatedata('value', '22')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value22"/>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <input type="text" class="form-control" placeholder="Liability" wire:model="value22"/>
                                                                <?php
                                                                    }
                                                                ?> -->
                                                                <input type="text" class="form-control" placeholder="Liability" wire:model="value22"/>
                                                                @error('value22')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-md-4">
                                                    <p>Balance 2018 (IDR) :</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <!-- <?php
                                                                    if(count($check_data) > 0){
                                                                        $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '23')->first();
                                                                        $count = $get_data['value'];      
                                                                ?>
                                                                    <input type="text" wire:change="updatedata('value', '23')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value23"/>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <input type="text" class="form-control" placeholder="Asset" wire:model="value23"/>
                                                                <?php
                                                                    }
                                                                ?> -->
                                                                <input type="text" class="form-control" placeholder="Asset" wire:model="value23"/>
                                                                
                                                                @error('value23')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <!-- <?php
                                                                    if(count($check_data) > 0){
                                                                        $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '24')->first();
                                                                        $count = $get_data['value'];      
                                                                ?>
                                                                    <input type="text" wire:change="updatedata('value', '24')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value24"/>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <input type="text" class="form-control" placeholder="Liability" wire:model="value24"/>
                                                                <?php
                                                                    }
                                                                ?> -->
                                                                <input type="text" class="form-control" placeholder="Liability" wire:model="value24"/>
                                                                
                                                                @error('value24')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>Balance 2019 (IDR) :</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                            <!-- <?php
                                                                    if(count($check_data) > 0){
                                                                        $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '25')->first();
                                                                        $count = $get_data['value'];      
                                                                ?>
                                                                    <input type="text" wire:change="updatedata('value', '25')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value25"/>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <input type="text" class="form-control" placeholder="Asset" wire:model="value25"/>
                                                                <?php
                                                                    }
                                                                ?> -->

                                                                <input type="text" class="form-control" placeholder="Asset" wire:model="value25"/>
                                                                
                                                                @error('value25')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                            <!-- <?php
                                                                    if(count($check_data) > 0){
                                                                        $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '26')->first();
                                                                        $count = $get_data['value'];      
                                                                ?>
                                                                    <input type="text" wire:change="updatedata('value', '26')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value26"/>
                                                                <?php
                                                                    }else{
                                                                ?>
                                                                    <input type="text" class="form-control" placeholder="Liability" wire:model="value26"/>
                                                                <?php
                                                                    }
                                                                ?> -->
                                                                <input type="text" class="form-control" placeholder="Liability" wire:model="value26"/>
                                                                
                                                                @error('value26')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>Notas (Remarks) :</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <!-- <?php
                                                            if(count($check_data) > 0){
                                                                $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '27')->first();
                                                                $count = $get_data['value'];      
                                                        ?>
                                                            <textarea wire:change="updatedata('value', '27')"   name="" id="" cols="30" rows="6" class="form-control" wire:model="value27" placeholder="{{ $count }}">{{ $count }}</textarea>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            
                                                            <textarea name="" id="" cols="30" rows="6" class="form-control" wire:model="value27"></textarea>
                                                        <?php
                                                            }
                                                        ?> -->
                                                        <textarea name="" id="" cols="30" rows="6" class="form-control" wire:model="value27"></textarea>
                                                        
                                                        @error('value27')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-12">
                                        <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px;">
                                            
                                            
                                            <div class="row">
                                                <div class="col-md-8 form-group">
                                                    <h5>Bank Information</h5>
                                                </div>
                                                
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label><b>Finance Contact Name :</b> </label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <!-- <?php
                                                            if(count($check_data) > 0){
                                                                $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '28')->first();
                                                                $count = $get_data['value'];      
                                                        ?>
                                                            <input type="text" wire:change="updatedata('value', '28')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value28"/>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            
                                                            <input type="text" class="form-control" wire:model="value28"/>
                                                        <?php
                                                            }
                                                        ?> -->
                                                        <input type="text" class="form-control" wire:model="value28"/>
                                                        
                                                        @error('fin_name')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>Position :</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <!-- <?php
                                                            if(count($check_data) > 0){
                                                                $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '29')->first();
                                                                $count = $get_data['value'];      
                                                        ?>
                                                            <input type="text" wire:change="updatedata('value', '29')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value29"/>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            
                                                            <input type="text" class="form-control" wire:model="value29"/>
                                                        <?php
                                                            }
                                                        ?> -->

                                                        <input type="text" class="form-control" wire:model="value29"/>
                                                        
                                                        @error('fin_pos')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>Phone Handphone :</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                    <!-- <?php
                                                            if(count($check_data) > 0){
                                                                $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '30')->first();
                                                                $count = $get_data['value'];      
                                                        ?>
                                                            <input type="text" wire:change="updatedata('value', '30')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value30"/>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            
                                                            <input type="text" class="form-control" wire:model="value30"/>
                                                        <?php
                                                            }
                                                        ?> -->
                                                        <input type="text" class="form-control" wire:model="value30"/>
                                                        
                                                        @error('fin_hp')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label><b>Bank Name :</b> </label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <!-- <?php
                                                            if(count($check_data) > 0){
                                                                $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '31')->first();
                                                                $count = $get_data['value'];      
                                                        ?>
                                                            <input type="text" wire:change="updatedata('value', '31')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value31"/>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            
                                                            <input type="text" class="form-control" wire:model="value31"/>
                                                        <?php
                                                            }
                                                        ?> -->
                                                        <input type="text" class="form-control" wire:model="value31"/>
                                                        
                                                        @error('bank_name')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label><b>Bank Address / Branch :</b> </label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <!-- <?php
                                                            if(count($check_data) > 0){
                                                                $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '32')->first();
                                                                $count = $get_data['value'];      
                                                        ?>
                                                            <input type="text" wire:change="updatedata('value', '32')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value32"/>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            
                                                            <input type="text" class="form-control" wire:model="value32"/>
                                                        <?php
                                                            }
                                                        ?> -->
                                                        <input type="text" class="form-control" wire:model="value32"/>
                                                        @error('bank_addr')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label><b>Country :</b> </label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                    <!-- <?php
                                                            if(count($check_data) > 0){
                                                                $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '33')->first();
                                                                $count = $get_data['value'];      
                                                        ?>
                                                            <input type="text" wire:change="updatedata('value', '33')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value33"/>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            
                                                            <input type="text" class="form-control" wire:model="value33"/>
                                                        <?php
                                                            }
                                                        ?> -->

                                                        <input type="text" class="form-control" wire:model="value33"/>
                                                        @error('country')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label><b>Currency :</b> </label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <!-- <?php
                                                            if(count($check_data) > 0){
                                                                $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '34')->first();
                                                                $count = $get_data['value'];      
                                                        ?>
                                                            <input type="text" wire:change="updatedata('value', '34')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value34"/>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            
                                                            <input type="text" class="form-control" wire:model="value34"/>
                                                        <?php
                                                            }
                                                        ?> -->

                                                        <input type="text" class="form-control" wire:model="value34"/>
                                                        @error('curr')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label><b>Bank Account Owner :</b> </label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <!-- <?php
                                                            if(count($check_data) > 0){
                                                                $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '35')->first();
                                                                $count = $get_data['value'];      
                                                        ?>
                                                            <input type="text" wire:change="updatedata('value', '35')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value35"/>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            
                                                            <input type="text" class="form-control" wire:model="value35"/>
                                                        <?php
                                                            }
                                                        ?> -->

                                                        <input type="text" class="form-control" wire:model="value35"/>
                                                        
                                                        @error('bank_acc_owner')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label><b>Bank Account Number :</b> </label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                    <!-- <?php
                                                            if(count($check_data) > 0){
                                                                $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '36')->first();
                                                                $count = $get_data['value'];      
                                                        ?>
                                                            <input type="text" wire:change="updatedata('value', '36')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value36"/>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            
                                                            <input type="text" class="form-control" wire:model="value36"/>
                                                        <?php
                                                            }
                                                        ?> -->

                                                        <input type="text" class="form-control" wire:model="value36"/>
                                                        @error('bank_acc_num')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label><b>Swift Code :</b> </label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <!-- <?php
                                                            if(count($check_data) > 0){
                                                                $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '37')->first();
                                                                $count = $get_data['value'];      
                                                        ?>
                                                            <input type="text" wire:change="updatedata('value', '37')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value37"/>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            
                                                            <input type="text" class="form-control" wire:model="value37"/>
                                                        <?php
                                                            }
                                                        ?> -->

                                                        <input type="text" class="form-control" wire:model="value37"/>
                                                        @error('swift_code')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label><b>Notas :</b> </label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <!-- <?php
                                                            if(count($check_data) > 0){
                                                                $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '38')->first();
                                                                $count = $get_data['value'];      
                                                        ?>
                                                            <textarea wire:change="updatedata('value', '38')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value38"></textarea>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            <textarea name="" id="" cols="30" rows="6" class="form-control" wire:model="value38"></textarea>
                                                            
                                                        <?php
                                                            }
                                                        ?> -->

                                                        <textarea name="" id="" cols="30" rows="6" class="form-control" wire:model="value38"></textarea>
                                                        
                                                        @error('notas_bi')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-12">
                                        <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px;">
                                            
                                            
                                            <div class="row">
                                                <div class="col-md-8 form-group">
                                                    <h5>Human Resource</h5>
                                                </div>
                                                
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <p>Employees Qty (Person) :</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                    <!-- <?php
                                                            if(count($check_data) > 0){
                                                                $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '39')->first();
                                                                $count = $get_data['value'];      
                                                        ?>
                                                            <input type="text" wire:change="updatedata('value', '39')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value39"/>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            
                                                            <input type="text" class="form-control" wire:model="value39"/>
                                                        <?php
                                                            }
                                                        ?>
                                                    -->
                                                        <input type="text" class="form-control" wire:model="value39"/>
                                                        @error('employees_qty')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>High Level (Manager) (Person) :</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <!-- <?php
                                                            if(count($check_data) > 0){
                                                                $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '40')->first();
                                                                $count = $get_data['value'];      
                                                        ?>
                                                            <input type="text" wire:change="updatedata('value', '40')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value40"/>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            
                                                            <input type="text" class="form-control" wire:model="value40"/>
                                                        <?php
                                                            }
                                                        ?> -->

                                                        <input type="text" class="form-control" wire:model="value40"/>
                                                        
                                                        @error('mngr_qty')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>Supervisor (Person) :</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                    <!-- <?php
                                                            if(count($check_data) > 0){
                                                                $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '41')->first();
                                                                $count = $get_data['value'];      
                                                        ?>
                                                            <input type="text" wire:change="updatedata('value', '41')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value41"/>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            
                                                            <input type="text" class="form-control" wire:model="value41"/>
                                                        <?php
                                                            }
                                                        ?> -->
                                                        
                                                        <input type="text" class="form-control" wire:model="value41"/>
                                                        @error('spv_qty')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>Engineer (Person) :</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <!-- <?php
                                                            if(count($check_data) > 0){
                                                                $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '42')->first();
                                                                $count = $get_data['value'];      
                                                        ?>
                                                            <input type="text" wire:change="updatedata('value', '42')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value42"/>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            
                                                            <input type="text" class="form-control" wire:model="value42"/>
                                                        <?php
                                                            }
                                                        ?> -->
                                                        
                                                        <input type="text" class="form-control" wire:model="value42"/>
                                                        @error('engineer_qty')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>Technicians (Person) :</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <!-- <?php
                                                            if(count($check_data) > 0){
                                                                $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '43')->first();
                                                                $count = $get_data['value'];      
                                                        ?>
                                                            <input type="text" wire:change="updatedata('value', '43')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value43"/>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            
                                                            <input type="text" class="form-control" wire:model="value43"/>
                                                        <?php
                                                            }
                                                        ?> -->

                                                        <input type="text" class="form-control" wire:model="value43"/>
                                                        
                                                        @error('tech_qty')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>Administrative (Person) :</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <!-- <?php
                                                            if(count($check_data) > 0){
                                                                $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '44')->first();
                                                                $count = $get_data['value'];      
                                                        ?>
                                                            <input type="text" wire:change="updatedata('value', '44')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value44"/>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            
                                                            <input type="text" class="form-control" wire:model="value44"/>
                                                        <?php
                                                            }
                                                        ?> -->
                                                        <input type="text" class="form-control" wire:model="value44"/>

                                                        @error('adm_qty')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>Others (Person) :</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <!-- <?php
                                                            if(count($check_data) > 0){
                                                                $get_data = \App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->where('id_detail', '45')->first();
                                                                $count = $get_data['value'];      
                                                        ?>
                                                            <input type="text" wire:change="updatedata('value', '45')"  class="form-control" placeholder="{{ $count }}" class="form-control" wire:model="value45"/>
                                                        <?php
                                                            }else{
                                                        ?>
                                                            
                                                            <input type="text" class="form-control" wire:model="value45"/>
                                                        <?php
                                                            }
                                                        ?> -->
                                                        <input type="text" class="form-control" wire:model="value45"/>
                                                        
                                                        @error('other_qty')
                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        
                                    </div>

                                    
                                    <br>
                                    

                                </form>
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
                                            <div class="col-md-3">
                                                
                                            </div>
                                        </div>
                                        
                                        <hr>
                                        <h1 style="font-size: 65px">
                                            <!-- {{ $data['general_information'] }} -->
                                        </h1>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 180px;">
                                        <h5>Complete Licence Score (70)</h5>
                                        <hr>
                                        <h1 style="font-size: 45px">
                                            <!-- {{ $data['ci_complete_licence'] }} -->
                                        </h1>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 180px;">
                                        <h5>Have HQ Office (20)</h5>
                                        <hr>
                                        <h1 style="font-size: 45px">
                                            <!-- {{ $data['ci_hq'] }} -->
                                        </h1>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 180px;">
                                        <h5>Have Branch Office (0)</h5>
                                        <hr>
                                        <h1 style="font-size: 45px">
                                            
                                        </h1>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    
                </div>
                @else
                    @foreach(\App\Models\VendorManagementgi::select('created_at')->where('id_supplier', $this->selected_id)->groupBy(DB::Raw('date(created_at)'))->orderBy(DB::Raw('date(created_at)'), 'desc')->get() as $item)
                    <div class="tab-pane  active show" id="historigi<?php echo date_format(date_create($item->created_at), 'dMY'); ?>">
                        @livewire('vendor-management.historigeneralinformation', ['date' => $item->created_at, 'selected_id' => $this->selected_id])
                    </div>
                    @endforeach
                @endif      
            </div>
        </div>

        
    </div>
</div>
