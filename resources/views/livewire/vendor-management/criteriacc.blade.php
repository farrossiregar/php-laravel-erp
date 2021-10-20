@section('title', __('Vendor Management - Evaluate Commercial Compliance'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div><br></div>
            <div><br></div>
            <div><br></div>
            <div><br></div>
            <div><br></div>
            <div><br></div>
            <div><br></div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px;">
                                    
                                    
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
                                                    <select name="" id="" class="form-control" wire:model="hq_office">
                                                        <option value=""></option>
                                                        <option value="50">Low (< 10% )</option>
                                                        <option value="20">Medium ( 10% s/d 30% )</option>
                                                        <option value="0">High (> 30% )</option>
                                                    </select>
                                                    
                                                    @error('ehs_quality_management')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                    @error('ehs_quality_management')
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
                                                    <select name="" id="" class="form-control" wire:model="hq_office">
                                                        <option value=""></option>
                                                        <option value="">Low</option>
                                                        <option value="">Medium</option>
                                                        <option value="">High</option>
                                                    </select>
                                                    
                                                    @error('ehs_quality_management')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                    @error('ehs_quality_management')
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
                                                    <select name="" id="" class="form-control" wire:model="hq_office">
                                                        <option value=""></option>
                                                        <option value="">Low</option>
                                                        <option value="">Medium</option>
                                                        <option value="">High</option>
                                                    </select>
                                                    
                                                    @error('ehs_quality_management')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                    @error('ehs_quality_management')
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
                                                    <select name="" id="" class="form-control" wire:model="hq_office">
                                                        <option value=""></option>
                                                        <option value="">Low</option>
                                                        <option value="">Medium</option>
                                                        <option value="">High</option>
                                                    </select>
                                                    
                                                    @error('ehs_quality_management')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                    @error('ehs_quality_management')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            

                            
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
                                            <a href="#" wire:click="delsupplier2()" title="Update" class="btn btn-primary"><i class="fa fa-edit"></i> Update</a>
                                        </div>
                                    </div>
                                    
                                    <hr>
                                    <h1 style="font-size: 65px">
                                        90
                                    </h1>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 180px;">
                                    <h5>Price Compliance</h5>
                                    <hr>
                                    <h1 style="font-size: 80px">
                                        
                                    </h1>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 180px;">
                                    <h5>Lead Time Compliance</h5>
                                    <hr>
                                    <h1 style="font-size: 80px">
                                        
                                    </h1>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 180px;">
                                    <h5>Payment Term Compliance</h5>
                                    <hr>
                                    <h1 style="font-size: 80px">
                                        
                                    </h1>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 180px;">
                                    <h5>Special Requirement</h5>
                                    <hr>
                                    <h1 style="font-size: 80px">
                                        
                                    </h1>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

