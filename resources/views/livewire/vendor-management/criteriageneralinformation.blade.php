@section('title', __('Vendor Management - Evaluate General Information'))
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
                <!-- if(!\App\Models\VendorManagementgi::where('id_supplier', $this->selected_id)->get()) -->
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
                                                <?php
                                                    $supptype = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
                                                    // echo $supptype->supplier_category;
                                                    
                                                ?>
                                                    @if($supptype->supplier_category == 'Service - Company')
                                                    <div class="row">
                                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                                            <div class="form-group">
                                                                <label >Company Name :</label>
                                                                <input type="hidden" class="form-control" value="Owner Name" wire:model="service_type1">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                                            <div class="form-group">
                                                                <label >Business Name :</label>
                                                                <input type="hidden" class="form-control" value="Owner Name" wire:model="service_type1">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                                            <div class="form-group">
                                                                <label><b>Business Licence TDP :</b> </label>
                                                                <input type="hidden" class="form-control" value="owner_licence_ktp" wire:model="service_type2">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12" style="margin-bottom: 8px;">
                                                            <div class="form-group">
                                                                <label><b>Business Licence SIUP :</b> </label>
                                                                <input type="hidden" class="form-control" value="owner_licence_npwp" wire:model="service_type3">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12" style="margin-bottom: 8px;">
                                                            <div class="form-group">
                                                                <label><b>Business Licence NPWP :</b> </label>
                                                                <input type="hidden" class="form-control" value="owner_licence_npwp" wire:model="service_type3">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @else
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
                                                    @endif
                                                    
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
                                                    @if($supptype->supplier_category == 'Service - Company')
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                
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
                                                                    
                                                                    <input type="text" class="form-control" wire:model="value46"/>
                                                                    @error('value46')
                                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    
                                                                    <input type="text" class="form-control" wire:model="value47"/>
                                                                    @error('value47')
                                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    
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
                                                                    
                                                                    <input type="text" class="form-control" wire:model="value3"/>
                                                                    @error('owner_licence_npwp')
                                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                
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
                                                                <input type="text" placeholder="Asset" class="form-control" wire:model="value21"/>
                                                                
                                                                @error('value21')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
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
                                                                <input type="text" class="form-control" placeholder="Asset" wire:model="value23"/>
                                                                
                                                                @error('value23')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
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

                                                                <input type="text" class="form-control" placeholder="Asset" wire:model="value25"/>
                                                                
                                                                @error('value25')
                                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
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
