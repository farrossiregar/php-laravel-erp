@section('title', __('Vendor Management - Evaluate Team Availability'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div><br></div>
            <div><br></div>
            <div><br></div>
            <ul class="nav nav-tabs">
                @if(count(\App\Models\VendorManagementta::select('created_at')->where('id_supplier', $this->selected_id)->get()) < 1)
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#newevaluation">New Evaluation</a></li>
                @else
                    @foreach(\App\Models\VendorManagementta::select('created_at')->where('id_supplier', $this->selected_id)->groupBy(DB::Raw('date(created_at)'))->orderBy(DB::Raw('date(created_at)'), 'desc')->get() as $key => $item)
                        <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#historita<?php echo date_format(date_create($item->created_at), 'dMY'); ?>">{{ date_format(date_create($item->created_at), 'd M Y') }} <?php if($key == 0){ echo "<span style='color: red;'>*</span>"; } ?></a></li>
                    @endforeach
                @endif
            </ul>
            <div class="tab-content">
                @if(count(\App\Models\VendorManagementta::select('created_at')->where('id_supplier', $this->selected_id)->get()) < 1)
                <div class="tab-pane active show" id="newevaluation">  
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <form wire:submit.prevent="save">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px;">
                                                
                                                
                                                <div class="row">
                                                    <div class="col-md-10 form-group">
                                                    
                                                        <h5>Team Availability</h5> 
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
                                                        </div>
                                                    </div>  
                                                    
                                                </div>
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
                                                                <label for="">QTY Team</label>
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
                                                                        <!-- <?php
                                                                            if(\App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', $i)->get()){
                                                                                $teamcount = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', $i)->first();
                                                                                if($teamcount){
                                                                                    $countteam = $teamcount->team;
                                                                                }else{
                                                                                    $countteam = 0;
                                                                                }
                                                                        ?>
                                                                        <input type="number" wire:change="updatedata('team', {{ $i }})" class="form-control" placeholder="{{ $countteam }}" wire:model="team{{$i}}">
                                                                        <?php
                                                                            }else{
                                                                        ?>
                                                                            <input type="number" class="form-control" placeholder="Team" wire:model="team{{$i}}">
                                                                            
                                                                        <?php
                                                                            }
                                                                        ?> -->
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
                                                        </div>
                                                        
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <?php
                                                                    for($i = 1; $i < 15; $i++){
                                                                ?>
                                                                <div class="row">
                                                                    <div class="col-md-2 form-group">
                                                                        <!-- <?php
                                                                            if(\App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', $i)->get()){
                                                                                $check_eng = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', $i)->first();
                                                                                if($check_eng){
                                                                                    $count = $check_eng->eng;
                                                                                }else{
                                                                                    $count = 'Engineer';
                                                                                }
                                                                        ?>
                                                                            <input type="number" wire:change="updatedata('eng', {{ $i }})" class="form-control" placeholder="{{ $count }}" wire:model="eng{{$i}}">
                                                                        <?php
                                                                            }else{
                                                                        ?>
                                                                            <input type="number" class="form-control" placeholder="Engineer" wire:model="eng{{$i}}">
                                                                        <?php
                                                                            }
                                                                        ?> -->
                                                                        <input type="number" class="form-control" placeholder="Engineer" wire:model="eng{{$i}}">
                                                                        
                                                                        @error('eng'.$i)
                                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-md-2 form-group">
                                                                        <!-- <?php
                                                                            if(\App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', $i)->get()){
                                                                                $check_tech = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', $i)->first();
                                                                                if($check_tech){
                                                                                    $count = $check_tech->tech;
                                                                                }else{
                                                                                    $count = 'Technician';
                                                                                }
                                                                        ?>
                                                                            <input type="number" wire:change="updatedata('tech', {{ $i }})" class="form-control" placeholder="{{ $count }}" wire:model="tech{{$i}}">
                                                                        <?php
                                                                            }else{
                                                                        ?>
                                                                            <input type="number" class="form-control" placeholder="Technician" wire:model="tech{{$i}}">
                                                                        <?php
                                                                            }
                                                                        ?> -->
                                                                        <input type="number" class="form-control" placeholder="Technician" wire:model="tech{{$i}}">
                                                                        <!-- <div class="input-group mb-3">
                                                                            <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                                            <div class="input-group-append">
                                                                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-edit"></i></span>
                                                                            </div>
                                                                        </div> -->
                                                                        <!-- <input type="number" min='0' max="100" placeholder="Technician" class="form-control" wire:model="<?php echo 'tech'.$i ?>"/> -->
                                                                        @error('tech'.$i)
                                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-md-2 form-group">
                                                                        <!-- <?php
                                                                            if(\App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', $i)->get()){
                                                                                $check_rigger = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', $i)->first();
                                                                                if($check_rigger){
                                                                                    $count = $check_rigger->rigger;
                                                                                }else{
                                                                                    $count = 'Rigger';
                                                                                }
                                                                        ?>
                                                                            <input type="number" wire:change="updatedata('rigger', {{ $i }})" class="form-control" placeholder="{{ $count }}" wire:model="rigger{{$i}}">
                                                                        <?php
                                                                            }else{
                                                                        ?>
                                                                            <input type="number" class="form-control" placeholder="Rigger" wire:model="rigger{{$i}}">
                                                                        <?php
                                                                            }
                                                                        ?> -->
                                                                        <input type="number" class="form-control" placeholder="Rigger" wire:model="rigger{{$i}}">
                                                                        <!-- <input type="number" placeholder="Rigger" class="form-control" wire:model="<?php echo 'rigger'.$i ?>"/> -->
                                                                        @error('rigger'.$i)
                                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-md-2 form-group">
                                                                        <!-- <?php
                                                                            if(\App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', $i)->get()){
                                                                                $check_helper = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', $i)->first();
                                                                                if($check_helper){
                                                                                    $count = $check_helper->helper;
                                                                                }else{
                                                                                    $count = 'Helper';
                                                                                }
                                                                        ?>
                                                                            <input type="number" wire:change="updatedata('helper', {{ $i }})" class="form-control" placeholder="{{ $count }}" wire:model="helper{{$i}}">
                                                                        <?php
                                                                            }else{
                                                                        ?>
                                                                            <input type="number" class="form-control" placeholder="Helper" wire:model="helper{{$i}}">
                                                                        <?php
                                                                            }
                                                                        ?> -->

                                                                        <input type="number" class="form-control" placeholder="Helper" wire:model="helper{{$i}}">
                                                                        @error('helper'.$i)
                                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-md-2 form-group">
                                                                        <!-- <?php
                                                                            if(\App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', $i)->get()){
                                                                                $check_other = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', $i)->first();
                                                                                if($check_other){
                                                                                    $count = $check_other->other;
                                                                                }else{
                                                                                    $count = 'Other';
                                                                                }
                                                                        ?>
                                                                            <input type="number" wire:change="updatedata('other', {{ $i }})" class="form-control" placeholder="{{ $count }}" wire:model="other{{$i}}">
                                                                        <?php
                                                                            }else{
                                                                        ?>
                                                                            <input type="number" class="form-control" placeholder="Other" wire:model="other{{$i}}">
                                                                        <?php
                                                                            }
                                                                        ?> -->

                                                                        <input type="number" class="form-control" placeholder="Other" wire:model="other{{$i}}">
                                                                        @error('other'.$i)
                                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-md-2 form-group">
                                                                        <label for="">Person</label>
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
                                            
                                        </div>


                                        <div class="col-md-12">
                                            <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px;">
                                                <div class="row">
                                                    <div class="col-md-4 form-group">
                                                                
                                                        <h5>Company Compatibility</h5> 
                                                    </div>
                                                    
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <br>
                                                        <label>Category Experience</label>
                                                    </div>  
                                                    <div class="col-md-9">
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
                                                                        
                                                                        <p>{{$id_detail_title}}</p>
                                                                        
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
                                                                        
                                                                        <!-- <select class="form-control" wire:model="<?php echo 'year'.$i ?>">
                                                                            <option value="">-- Select Year --</option>
                                                                            <?php
                                                                                for($y = (date('Y') - 5); $y <= date('Y'); $y++){
                                                                            ?>
                                                                            <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                        </select> -->


                                                                        <!-- <?php
                                                                            if(\App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', $i)->get()){
                                                                                $check_year = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', $i)->first();
                                                                                if($check_year){
                                                                                    $count = $check_year->year;
                                                                                }else{
                                                                                    $count = 'Year';
                                                                                }
                                                                        ?>
                                                                            <input type="number" wire:change="updatedata('year', {{ $i }})" class="form-control" placeholder="{{ $count }}" wire:model="year{{$i}}">
                                                                        <?php
                                                                            }else{
                                                                        ?>
                                                                            <input type="number" class="form-control" placeholder="Year" wire:model="other{{$i}}">
                                                                        <?php
                                                                            }
                                                                        ?> -->
                                                                        <input type="number" class="form-control" placeholder="Year" wire:model="year{{$i}}">
                                                                        @error('year'.$i)
                                                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-md-4 form-group">
                                                                        <label for="">Year</label>
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
                                                                        <!-- <input type="number" min='0' max="100" placeholder="Invoice" class="form-control" wire:model="<?php echo 'invoice'.$i ?>"/> -->
                                                                        <!-- <?php
                                                                            if(\App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', $i)->get()){
                                                                                $check_invoice = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', $i)->first();
                                                                                if($check_invoice){
                                                                                    $count = $check_invoice->invoice;
                                                                                }else{
                                                                                    $count = 'Invoice';
                                                                                }
                                                                        ?>
                                                                            <input type="number" wire:change="updatedata('invoice', {{ $i }})" class="form-control" placeholder="{{ $count }}" wire:model="invoice{{$i}}">
                                                                        <?php
                                                                            }else{
                                                                        ?>
                                                                            <input type="number" class="form-control" placeholder="invoice" wire:model="invoice{{$i}}">
                                                                        <?php
                                                                            }
                                                                        ?> -->
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
                                        </div>
                                                                 
                                    </div>
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
                                        <h5>Team Availability</h5>
                                        <hr>
                                        <h1 style="font-size: 50px">
                                            
                                        </h1>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 180px;">
                                        <h5>Company Availability</h5>
                                        <hr>
                                        <h1 style="font-size: 50px">
                                            
                                        </h1>
                                    </div>
                                </div>

                            </div>
                            
                        </div>
                    </div>
                    
                </div>
                @else
                
                    @foreach(\App\Models\VendorManagementta::select('created_at')->where('id_supplier', $this->selected_id)->groupBy(DB::Raw('date(created_at)'))->orderBy(DB::Raw('date(created_at)'), 'desc')->get() as $item)
                        <div class="tab-pane active show" id="historita<?php echo date_format(date_create($item->created_at), 'dMY'); ?>">
                            @livewire('vendor-management.historiteamavailability', ['date' => $item->created_at, 'selected_id' => $this->selected_id])
                        </div>
                    @endforeach
                @endif   
            </div>
        </div>
    </div>
</div>

