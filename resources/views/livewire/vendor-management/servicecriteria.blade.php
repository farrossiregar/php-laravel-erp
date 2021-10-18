@section('title', __('Vendor Management - Evaluate'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
               

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px;">
                                    <h5>General Information</h5> 
                                    
                                    <div class="row">
                                        <div class="col-md-8 form-group">
                                            <input type="number" min='0' max="100" class="form-control" readonly wire:model="general_information"/>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="#" wire:click="delsupplier2()" title="Update" class="btn btn-primary"><i class="fa fa-edit"></i> Update</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label>Complete Licence (Company 50% - Personal 20%)</label>
                                            <!-- <input type="number" min='0' max="100" class="form-control" wire:model="complete_licence"/> -->
                                            
                                            <select class="form-control" wire:model="complete_licence" name="" id="">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                            @error('ehs_quality_management')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Have HQ Office (20%)</label>
                                            <!-- <input type="number" min='0' max="100" class="form-control" wire:model="hq_office"/> -->
                                            <select class="form-control" wire:model="hq_office" name="" id="">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                            @error('ehs_quality_management')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="col-md-6">
                                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px;">
                                    <h5>Team Availability</h5> <a href="#" wire:click="delsupplier2()" title="Update" class="btn btn-primary"><i class="fa fa-edit"></i> Update</a>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label>Team Quantity</label>
                                            <!-- <input type="number" min='0' max="100" class="form-control" wire:model="team_qty"/> -->
                                            <select class="form-control" wire:model="team_qty" name="" id="">
                                                <option value="20"> Team QTY < 5 </option>
                                                <option value="30"> Team QTY < 5 X < 10 </option>
                                                <option value="40"> Team QTY > 10 </option>

                                            </select>
                                            @error('team_qty')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Company Capability</label>
                                            <select class="form-control" wire:model="company_capability" name="" id="">
                                                <option value="20"> 1 Capability Category </option>

                                            </select>
                                            @error('company_capability')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label>Total (10% Point from Total Score)</label>
                                            <input type="number" min='0' max="100" class="form-control" wire:model="total_gi" readonly/>
                                            @error('ehs_quality_management')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px;">
                                    <h5>Tools & Facilities</h5> <a href="#" wire:click="delsupplier2()" title="Update" class="btn btn-primary"><i class="fa fa-edit"></i> Update</a>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label>General Information (10%)</label>
                                            <input type="number" min='0' max="100" class="form-control" wire:model="general_information"/>
                                            @error('supplier_name')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                         <div class="col-md-12 form-group">
                                            <label>Team Availability & Capability (25%)</label>
                                            <input type="number" min='0' max="100" class="form-control" wire:model="team_availability_capability"/>
                                            @error('team_availability_capability')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px;">
                                    <h5>EHS</h5> <a href="#" wire:click="delsupplier2()" title="Update" class="btn btn-primary"><i class="fa fa-edit"></i> Update</a>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label>General Information (10%)</label>
                                            <input type="number" min='0' max="100" class="form-control" wire:model="general_information"/>
                                            @error('supplier_name')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                         <div class="col-md-12 form-group">
                                            <label>Team Availability & Capability (25%)</label>
                                            <input type="number" min='0' max="100" class="form-control" wire:model="team_availability_capability"/>
                                            @error('team_availability_capability')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px;">
                                    <h5>Commercial Compliance</h5> <a href="#" wire:click="delsupplier2()" title="Update" class="btn btn-primary"><i class="fa fa-edit"></i> Update</a>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label>General Information (10%)</label>
                                            <input type="number" min='0' max="100" class="form-control" wire:model="general_information"/>
                                            @error('supplier_name')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                         <div class="col-md-12 form-group">
                                            <label>Team Availability & Capability (25%)</label>
                                            <input type="number" min='0' max="100" class="form-control" wire:model="team_availability_capability"/>
                                            @error('team_availability_capability')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 480px;">
                            <h5>Total Score</h5>
                            <hr>
                            <h1>
                                90
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-dutyroster-importdutyroster" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:duty-roster-dophomebase.importdutyroster />
        </div>
    </div>
</div>



@section('page-script')


    Livewire.on('modalimportnoc',(data)=>{
        $("#modal-dutyroster-importdutyroster").modal('show');
    });


@endsection