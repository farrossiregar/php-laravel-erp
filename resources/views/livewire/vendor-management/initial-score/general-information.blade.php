<div class="card">
    <div class="modal-header">
        <h5 class="modal-title">General Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-content">
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6">
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
            <div class="col-lg-3 col-md-6">
                <div class="card overflowhidden">
                    <div class="body text-center">
                        <div class="p-1">
                            <h3>{{$complete_licence_score}}</h3>
                            <span>Complete Licence Score</span>
                        </div>                            
                    </div>
                    <div class="progress progress-xs progress-transparent custom-color-purple m-b-0">
                        <div class="progress-bar" data-transitiongoal="100" aria-valuenow="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card overflowhidden">
                    <div class="body text-center">
                        <div class="p-1">
                            <h3>{{$have_hq_office}}</h3>
                            <span>Have HQ Office</span>
                        </div>                           
                    </div>
                    <div class="progress progress-xs progress-transparent custom-color-yellow m-b-0">
                        <div class="progress-bar" data-transitiongoal="100" aria-valuenow="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card overflowhidden">
                    <div class="body text-center">
                        <div class="p-1">
                            <h3>{{$have_branch_office}}</h3>
                            <span>Have Branch Office</span>
                        </div>                            
                    </div>
                    <div class="progress progress-xs progress-transparent custom-color-green m-b-0">
                        <div class="progress-bar" data-transitiongoal="100" aria-valuenow="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#general-information">General Information</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#bank-information">Bank Information</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#human-resources">Human Resources</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" id="human-resources">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Employees quantity</label>
                            <input type="text" class="form-control" wire:model="value1"/>
                            @error('value1')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>High Level (Manager)</label>
                            <input type="text" class="form-control" wire:model="value1"/>
                            @error('value1')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Supervisor</label>
                            <input type="text" class="form-control" wire:model="value1"/>
                            @error('value1')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Engineer</label>
                            <input type="text" class="form-control" wire:model="value1"/>
                            @error('value1')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Technicians</label>
                            <input type="text" class="form-control" wire:model="value1"/>
                            @error('value1')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Administrative</label>
                            <input type="text" class="form-control" wire:model="value1"/>
                            @error('value1')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Others</label>
                            <input type="text" class="form-control" wire:model="value1"/>
                            @error('value1')
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
                                <input type="text" class="form-control" wire:model="value1"/>
                                @error('value1')
                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Position</label>
                                <input type="text" class="form-control" wire:model="value1"/>
                                @error('value1')
                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" class="form-control" wire:model="value1"/>
                                @error('value1')
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
                                <input type="text" class="form-control" wire:model="owner_licence_ktp"/>
                                @error('owner_licence_ktp')
                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>NPWP</label>
                                <input type="text" class="form-control" wire:model="owner_licence_npwp"/>
                                @error('value1')
                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mt-3 border p-2">
                            <h6 class="text-info">Business Licence</h6>
                            <hr />
                            <div class="form-group">
                                <label> TDP</label>
                                <input type="text" class="form-control" wire:model="owner_licence_tdp">
                                @error('owner_licence_ktp')
                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>SIUP</label>
                                <input type="text" class="form-control" wire:model="owner_licence_siup">
                                @error('owner_licence_siup')
                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>NPWP</label>
                                <input type="text" class="form-control" wire:model="owner_licence_npwp">
                                @error('owner_licence_npwp')
                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Establish year</label>
                            <input type="text" class="form-control" wire:model="est_year">
                            @error('est_year')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>HQ Address</label>
                            <input type="text" class="form-control" wire:model="hq_add">
                            @error('hq_add')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Branch Address</label>
                            <input type="text" class="form-control" wire:model="branch_add">
                            @error('branch_add')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Telephone - office</label>
                            <input type="text" class="form-control" wire:model="telp_office">
                            @error('branch_add')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>