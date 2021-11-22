<div>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">General Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="row clearfix">
            <div class="col-lg-2 col-md-6">
                <div class="card overflowhidden">
                    <div class="body text-center">
                        <div class="p-1">
                            <h3>{{$company_complete_score}}</h3>
                            <span>Company Licence Score</span>
                        </div>                            
                    </div>
                    <div class="progress progress-xs progress-transparent custom-color-blue m-b-0">
                        <div class="progress-bar" data-transitiongoal="100" aria-valuenow="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="card overflowhidden">
                    <div class="body text-center">
                        <div class="p-1">
                            <h3>{{$personal_licence_score}}</h3>
                            <span>Personal Licence Score</span>
                        </div>                            
                    </div>
                    <div class="progress progress-xs progress-transparent custom-color-purple m-b-0">
                        <div class="progress-bar" data-transitiongoal="100" aria-valuenow="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="card overflowhidden">
                    <div class="body text-center">
                        <div class="p-1">
                            <h3>{{$have_hq_office_score}}</h3>
                            <span>Have HQ Office Score</span>
                        </div>                           
                    </div>
                    <div class="progress progress-xs progress-transparent custom-color-yellow m-b-0">
                        <div class="progress-bar" data-transitiongoal="100" aria-valuenow="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="card overflowhidden">
                    <div class="body text-center">
                        <div class="p-1">
                            <h3>{{$have_branch_office_score}}</h3>
                            <span>Have Branch Office Score</span>
                        </div>                            
                    </div>
                    <div class="progress progress-xs progress-transparent custom-color-green m-b-0">
                        <div class="progress-bar" data-transitiongoal="100" aria-valuenow="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="card overflowhidden">
                    <div class="body text-center">
                        <div class="p-1">
                            <h3>{{$total_score}}</h3>
                            <span>Total Score</span>
                        </div>                            
                    </div>
                    <div class="progress progress-xs progress-transparent custom-color-blue m-b-0">
                        <div class="progress-bar" data-transitiongoal="100" aria-valuenow="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <form 
            <ul class="nav nav-tabs" wire:ignore>
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#general-information">General Information</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#bank-information">Bank Information</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#human-resources">Human Resources</a></li>
            </ul>
            <div class="tab-content" wire:ignore>
                <div class="tab-pane" id="human-resources">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Employees Quantity</label>
                                <input type="text" class="form-control" wire:model="employee_quantity"/>
                                @error('employee_quantity')
                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>High Level (Manager)</label>
                                <input type="text" class="form-control" wire:model="high_level_manager"/>
                                @error('high_level_manager')
                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Supervisor</label>
                                <input type="text" class="form-control" wire:model="supervisor"/>
                                @error('supervisor')
                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Engineer</label>
                                <input type="text" class="form-control" wire:model="engineer"/>
                                @error('engineer')
                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Technicians</label>
                                <input type="text" class="form-control" wire:model="technicians"/>
                                @error('technicians')
                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Administrative</label>
                                <input type="text" class="form-control" wire:model="administrative"/>
                                @error('administrative')
                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Others</label>
                                <input type="text" class="form-control" wire:model="others"/>
                                @error('others')
                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="bank-information"> 
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mt-3 mb-3 border p-2">
                                <h6 class="text-info">Finance Contact</h6>
                                <hr >
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" wire:model="finance_name"/>
                                    @error('finance_name')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Position</label>
                                    <input type="text" class="form-control" wire:model="finance_position"/>
                                    @error('finance_position')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control" wire:model="finance_phone"/>
                                    @error('finance_phone')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane active show" id="general-information">  
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mt-3 mb-3 border p-2">
                                <h6 class="text-info">Supplier Owner</h6>
                                <hr >
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" wire:model="owner_name"/>
                                    @error('owner_name')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>KTP</label>
                                    <input type="text" class="form-control" wire:model="owner_ktp"/>
                                    @error('owner_ktp')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>NPWP</label>
                                    <input type="text" class="form-control" wire:model="owner_npwp"/>
                                    @error('owner_npwp')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-3 border p-2">
                                <h6 class="text-info">Business Licence</h6>
                                <hr />
                                <div class="form-group">
                                    <label> TDP</label>
                                    <input type="text" class="form-control" wire:model="business_tdp">
                                    @error('business_tdp')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>SIUP</label>
                                    <input type="text" class="form-control" wire:model="business_siup">
                                    @error('business_siup')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>NPWP</label>
                                    <input type="text" class="form-control" wire:model="business_npwp">
                                    @error('business_npwp')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                    @enderror
                                </div>
                            </div>  
                        </div>
                        <div class="col-md-3">
                            <div class="mt-3 border p-2">
                                <h6 class="text-info">Commercial Contact</h6>
                                <hr />
                                <div class="form-group">
                                    <label> Name</label>
                                    <input type="text" class="form-control" wire:model="commercial_name">
                                    @error('business_tdp')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Phone / Handphone</label>
                                    <input type="text" class="form-control" wire:model="commercial_phone">
                                    @error('commercial_phone')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" wire:model="commercial_email">
                                    @error('commercial_email')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-3 border p-2">
                                <h6 class="text-info">Technical Contacts</h6>
                                <hr />
                                <div class="form-group">
                                    <label> Name</label>
                                    <input type="text" class="form-control" wire:model="technical_name">
                                    @error('technical_name')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Phone / Handphone</label>
                                    <input type="text" class="form-control" wire:model="technical_phone">
                                    @error('technical_phone')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" wire:model="technical_email">
                                    @error('technical_email')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Establish year</label>
                                <input type="text" class="form-control" wire:model="establish_year">
                                @error('establish_year')
                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>HQ Address</label>
                                <input type="text" class="form-control" wire:model="hq_address">
                                @error('hq_address')
                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Branch Address</label>
                                <input type="text" class="form-control" wire:model="branch_address">
                                @error('branch_address')
                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Telephone - office</label>
                                <input type="text" class="form-control" wire:model="telephone_office">
                                @error('telephone_office')
                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
            <div class="modal-footer">
                <span wire:loading>
                    <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                    <span class="sr-only">{{ __('Loading...') }}</span>
                </span>
                <button type="submit" href="javascript:void(0)" class="btn btn-info"><i class="fa fa-save"></i> Update</button>
            </div>
        </form>
    </div>
</div>