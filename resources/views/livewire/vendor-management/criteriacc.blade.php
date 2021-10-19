@section('title', __('Vendor Management - Evaluate General Information'))
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
            <div><br></div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px;">
                                    
                                    
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <!-- <input type="number" min='0' max="100" class="form-control" readonly wire:model="general_information"/> -->
                                            <h5>General Information</h5> 
                                        </div>
                                        <!-- <div class="col-md-4">
                                            <a href="#" wire:click="delsupplier2()" title="Update" class="btn btn-primary"><i class="fa fa-edit"></i> Update</a>
                                        </div> -->
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <!-- <div class="col-md-12 form-group">
                                            <label>Complete Licence (Company 50% - Personal 20%)</label>
                                            
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
                                            
                                            <select class="form-control" wire:model="hq_office" name="" id="">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                            @error('ehs_quality_management')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div> -->
                                        <div class="col-md-4">
                                            <label>Supplier Owner Name :</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label><b>Supplier Owner Licence :</b> </label>
                                        </div>
                                        <div class="col-md-8">
                                            
                                        </div>
                                        <div class="col-md-4">
                                            <p>KTP :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <p>NPWP :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Establish Year :</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>HQ Address :</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <textarea name="" id="" cols="30" rows="6"  class="form-control" wire:model="hq_office"></textarea>
                                                
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Branch Office Address :</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <textarea name="" id="" cols="30" rows="6"  class="form-control" wire:model="hq_office"></textarea>
                                                
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Telephone - Office :</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label><b>Commercial Contact Name :</b> </label>
                                        </div>
                                        <div class="col-md-8">
                                            
                                        </div>
                                        <div class="col-md-4">
                                            <p>Phone Handphone :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Email :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label><b>Technical Contact Name :</b> </label>
                                        </div>
                                        <div class="col-md-8">
                                            
                                        </div>
                                        <div class="col-md-4">
                                            <p>Phone Handphone :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Email :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label><b>Notas :</b> </label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
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
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Government Clients TOP 3 :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Other Customers :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <p>2017 Total Invoiced Amount (IDR) :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <p>2018 Total Invoiced Amount (IDR) :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <p>2019 Total Invoiced Amount (IDR) :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Balance 2017 (IDR) :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Balance 2018 (IDR) :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Balance 2019 (IDR) :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Notas (Remarks) :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
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
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Position :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Phone Handphone :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label><b>Bank Name :</b> </label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label><b>Bank Address / Branch :</b> </label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label><b>Country :</b> </label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label><b>Currency :</b> </label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label><b>Bank Account Owner :</b> </label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label><b>Bank Account Number :</b> </label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label><b>Swift Code :</b> </label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label><b>Notas :</b> </label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
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
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <p>High Level (Manager) (Person) :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Supervisor (Person) :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Engineer (Person) :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Technicians (Person) :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Administrative (Person) :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Others (Person) :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" min='0' max="100" class="form-control" wire:model="hq_office"/>
                                                @error('ehs_quality_management')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                            </div>

                            <!-- if($supplier_category == 'Service - Company' || $supplier_category == 'Service - Individual') -->
                            <!-- <div class="col-md-6">
                                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px;">
                                    <h5>Team Availability</h5>
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
                                            <label>Team Quantity</label>
                                            
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

                             -->

                            
                            <!-- endif -->

                            
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
                                    <h5>Complete Licence Score (70)</h5>
                                    <hr>
                                    <h1 style="font-size: 80px">
                                        
                                    </h1>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 180px;">
                                    <h5>Have HQ Office (20)</h5>
                                    <hr>
                                    <h1 style="font-size: 80px">
                                        
                                    </h1>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 180px;">
                                    <h5>Have Branch Office (0)</h5>
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