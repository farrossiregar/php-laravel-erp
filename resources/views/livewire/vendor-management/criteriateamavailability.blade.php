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
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px;">
                                    
                                    
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                        
                                            <h5>Team Availability</h5> 
                                        </div>
                                        
                                    </div>
                                    <hr>
                                    <div class="row">
                                       
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label>Service type</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">QTY Team</label>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-4"></div>
                                                <div class="col-md-4"><label for="">Composition Per Team</label></div>
                                                <div class="col-md-4"></div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-2 form-group">
                                                    <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                    @error('ehs_quality_management')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>
                                                <div class="col-md-2 form-group">
                                                    <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                    @error('ehs_quality_management')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>
                                                <div class="col-md-2 form-group">
                                                    <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                    @error('ehs_quality_management')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>
                                                <div class="col-md-2 form-group">
                                                    <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                    @error('ehs_quality_management')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>
                                                <div class="col-md-2 form-group">
                                                    <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                    @error('ehs_quality_management')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>
                                                <div class="col-md-2 form-group">
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
                                    <h5>Team Availability</h5>
                                    <hr>
                                    <h1 style="font-size: 80px">
                                        
                                    </h1>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 180px;">
                                    <h5>Company Availability</h5>
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

