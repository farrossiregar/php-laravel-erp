<div class="modal-content">
    <div class="row clearfix">
        <div class="col-lg-2 col-md-6">
            <div class="card overflowhidden">
                <div class="body text-center">
                    <div class="p-1">
                        <h3>{{$company_availability_score}}</h3>
                        <span>Company Availability</span>
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
                        <h3>{{$team_availability_score}}</h3>
                        <span>Team Availability</span>
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
        <div class="col-lg-2">
            <span wire:loading>
                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                <span class="sr-only">{{ __('Loading...') }}</span>
            </span>
        </div>
    </div>

    <div class="card">
        <div class="tab-content">
            @if(count(\App\Models\VendorManagementtainit::select('created_at')->where('id_supplier', $this->selected_id)->get()) < 1)
            <div class="tab-pane active show" id="newevaluation">  
                <form wire:submit.prevent="save">
                    <div class="row">
                        <div class="col-md-7">
                                @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div>                                                    
                                        <h5>Team Availability</h5>     
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <div class="col-md-4"></div>
                                                            <div class="col-md-4">
                                                            <label for="">Composition Per Team</label>
                                                            </div>
                                                            <div class="col-md-4"></div>
                                                        </div>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label>Service type</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" style="margin-bottom: 16px;">
                                                        <label for="">QTY</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <div class="col-md-12 form-group">
                                                                <p>Telecom Equipment Service</p>
                                                                <input type="hidden" class="form-control" value="Telecom Equipment Service" wire:model="service_type1">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 form-group">
                                                                <p>Infrastructure Construction</p>
                                                                <input type="hidden" class="form-control" value="Infrastructure Construction" wire:model="service_type2">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 form-group">
                                                            <p style="font-size: 13px;">Network Planning / Optimization</p>
                                                                <input type="hidden" class="form-control" value="Network Planning / Optimization" wire:model="service_type3">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 form-group">
                                                                <p>Maintenance Service </p>
                                                                <input type="hidden" class="form-control" value="Maintenance Service " wire:model="service_type4">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 form-group">
                                                                <p>Generator Maintenance Service</p>
                                                                <input type="hidden" class="form-control" value="Generator Maintenance Service" wire:model="service_type5">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 form-group">
                                                                <p>Fiber Optic (Project)</p>
                                                                <input type="hidden" class="form-control" value="Fiber Optic (Project)" wire:model="service_type2">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 form-group">
                                                                <p>Local Transportation</p>
                                                                <input type="hidden" class="form-control" value="Local Transportation" wire:model="service_type2">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 form-group">
                                                                <p>Civil, Mechanical & Electrical </p>
                                                                <input type="hidden" class="form-control" value="Civil, Mechanical & Electrical " wire:model="service_type2">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 form-group">
                                                                <p>Generator Maintenance Service</p>
                                                                <input type="hidden" class="form-control" value="Generator Maintenance Service" wire:model="service_type2">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 form-group">
                                                                <p>IT System Service</p>
                                                                <input type="hidden" class="form-control" value="IT System Service" wire:model="service_type2">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 form-group">
                                                                <p>Training & Certification</p>
                                                                <input type="hidden" class="form-control" value="Training & Certification" wire:model="service_type2">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 form-group">
                                                                <p>Car Rental </p>
                                                                <input type="hidden" class="form-control" value="Car Rental" wire:model="service_type2">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 form-group">
                                                                <p>Materials</p>
                                                                <input type="hidden" class="form-control" value="Materials" wire:model="service_type2">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 form-group">
                                                                <!-- <p>Other Service:  Outsourcing FO team </p> -->
                                                                <input type="text" class="form-control" placeholder="Other Service" wire:model="service_type14">
                                                                <input type="hidden" class="form-control" value="Other Service:  Outsourcing FO team" wire:model="service_type2">
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="col-md-4">
                                                        
                                                        <?php
                                                            for($i = 1; $i < 15; $i++){
                                                        ?>
                                                        <div class="row" style="margin-bottom: 16px;">
                                                            <div class="col-md-12 -form-group">
                                                                <input type="number" class="form-control" placeholder="Team" wire:model="team{{$i}}">
                                                            </div>
                                                        </div>
                                                        
                                                        <?php
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-2 form-group"><label for="">Engineer</label></div>
                                                    <div class="col-md-2 form-group"><label for="">Tech</label></div>
                                                    <div class="col-md-2 form-group"><label for="">Rigger</label></div>
                                                    <div class="col-md-2 form-group"><label for="">Helper</label></div>
                                                    <div class="col-md-2 form-group"><label for="">Other</label></div>
                                                    <div class="col-md-2 form-group"><label for="">UOM</label></div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <?php
                                                            for($i = 1; $i < 15; $i++){
                                                        ?>
                                                        <div class="row">
                                                            <div class="col-md-2 form-group">
                                                                <input type="number" class="form-control" placeholder="Engineer" wire:model="eng{{$i}}">
                                                                
                                                                @error('eng'.$i)
                                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-2 form-group">
                                                                <input type="number" class="form-control" placeholder="Technician" wire:model="tech{{$i}}">
                                                                @error('tech'.$i)
                                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-2 form-group">
                                                                <input type="number" class="form-control" placeholder="Rigger" wire:model="rigger{{$i}}">
                                                                @error('rigger'.$i)
                                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-2 form-group">
                                                                <input type="number" class="form-control" placeholder="Helper" wire:model="helper{{$i}}">
                                                                @error('helper'.$i)
                                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-2 form-group">
                                                                <input type="number" class="form-control" placeholder="Other" wire:model="other{{$i}}">
                                                                @error('other'.$i)
                                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-2 form-group">Person</div>
                                                        </div>
                                                        <?php
                                                            }
                                                        ?>
                                                    </div>
                                                    
                                                    
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 border-left">
                            <div>
                                <h5>Company Compatibility - <small>Category Experience</small></h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <p>Telecom Equipment Service</p>
                                                <input type="hidden" class="form-control" value="Telecom Equipment Service" wire:model="service_type1">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <p>Infrastructure Construction</p>
                                                <input type="hidden" class="form-control" value="Infrastructure Construction" wire:model="service_type2">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <p>Network Planning / Optimization</p>
                                                <input type="hidden" class="form-control" value="Network Planning / Optimization" wire:model="service_type3">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <p>Maintenance Service </p>
                                                <input type="hidden" class="form-control" value="Maintenance Service " wire:model="service_type4">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <p>Generator Maintenance Service</p>
                                                <input type="hidden" class="form-control" value="Generator Maintenance Service" wire:model="service_type5">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <p>Fiber Optic (Project)</p>
                                                <input type="hidden" class="form-control" value="Fiber Optic (Project)" wire:model="service_type2">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <p>Local Transportation</p>
                                                <input type="hidden" class="form-control" value="Local Transportation" wire:model="service_type2">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <p>Civil, Mechanical & Electrical </p>
                                                <input type="hidden" class="form-control" value="Civil, Mechanical & Electrical " wire:model="service_type2">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <p>Generator Maintenance Service</p>
                                                <input type="hidden" class="form-control" value="Generator Maintenance Service" wire:model="service_type2">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <p>IT System Service</p>
                                                <input type="hidden" class="form-control" value="IT System Service" wire:model="service_type2">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <p>Training & Certification</p>
                                                <input type="hidden" class="form-control" value="Training & Certification" wire:model="service_type2">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <p>Car Rental </p>
                                                <input type="hidden" class="form-control" value="Car Rental" wire:model="service_type2">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <p>Materials</p>
                                                <input type="hidden" class="form-control" value="Materials" wire:model="service_type2">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                
                                                <p>Others...</p>
                                                
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-4">
                                        <label>Experience</label>
                                        <br>
                                        <?php
                                            for($i = 1; $i < 15; $i++){
                                        ?>
                                        <div class="row" >
                                            <div class="col-md-8 form-group">
                                                <input type="number" class="form-control" placeholder="Year" wire:model="year{{$i}}">
                                                @error('year'.$i)
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Invoice Total 2019</label>
                                        <br>
                                        <?php
                                            for($i = 1; $i < 15; $i++){
                                        ?>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <input type="number" class="form-control" placeholder="invoice" wire:model="invoice{{$i}}">
                                                @error('invoice'.$i)
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">IDR</label>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <a href="javascript:void(0)" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Close</a>
                    <button type="submit" class="ml-3 btn btn-info close-modal"><i class="fa fa-save"></i> Submit</button>
                </form>
            </div>
            @else
            @foreach(\App\Models\VendorManagementtainit::select('created_at')->where('id_supplier', $this->selected_id)->groupBy(DB::Raw('date(created_at)'))->orderBy(DB::Raw('date(created_at)'), 'desc')->get() as $item)
                <div class="tab-pane active show" id="historita<?php echo date_format(date_create($item->created_at), 'dMY'); ?>">
                    @livewire('vendor-management.historiinitteamavailability', ['date' => $item->created_at, 'selected_id' => $this->selected_id])
                </div>
            @endforeach
        @endif   
        </div>
    </div>
</div>

