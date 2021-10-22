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
                        <form wire:submit.prevent="save">
                        @csrf
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
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label>Service type</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
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
                                                            <p>Other Service:  Outsourcing FO team </p>
                                                            <input type="hidden" class="form-control" value="Other Service:  Outsourcing FO team" wire:model="service_type2">
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-md-4">
                                                    
                                                    <?php
                                                        for($i = 1; $i < 15; $i++){
                                                            // print_r($idteam[$i]);
                                                            // echo $team[$i];
                                                            
                                                    ?>
                                                    <div class="row" style="margin-bottom: 16px;">
                                                        <div class="col-md-12 -form-group">
                                                            <?php //print_r($team1); ?>
                                                            <!-- <?php
                                                                // $teamcount = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', $i)->first()->team;
                                                                // if($teamcount){
                                                                //     $countteam = $teamcount;
                                                                ?>
                                                                    <input type="number" class="form-control" placeholder="<?php //echo $countteam; ?>" value="<?php //echo $countteam; ?>" wire:model="team{{$i}}">
                                                                <?php
                                                                // }else{
                                                                    
                                                                ?>
                                                                    <input type="number" class="form-control" placeholder="Team" wire:model="team{{$i}}">
                                                                <?php
                                                                // }
                                                            ?> -->
                                                            <?php
                                                                if(\App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', $i)->get()){
                                                                    $teamcount = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', $i)->first();
                                                                    if($teamcount){
                                                                        $countteam = $teamcount->team;
                                                                    }else{
                                                                        $countteam = 0;
                                                                    }
                                                            ?>
                                                            <!-- <input type="text" class="form-control" placeholder="<?php echo $countteam; ?>" value="<?php echo $countteam; ?>" wire:model="team{{ $i }}"> -->
                                                            <input type="number" wire:change="addteam({{ $i }})" class="form-control" placeholder="Team" wire:model="team{{$i}}">
                                                            <?php
                                                                }else{
                                                            ?>
                                                                <input type="number" class="form-control" placeholder="Team" wire:model="team{{$i}}">
                                                                
                                                            <?php
                                                                }
                                                            ?>
                                                            
                                                          

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
                                                <div class="col-md-4"></div>
                                                <div class="col-md-4"><label for="">Composition Per Team</label></div>
                                                <div class="col-md-4"></div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <?php
                                                        for($i = 1; $i < 15; $i++){
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-md-2 form-group">
                                                            <input type="number" min='0' max="100" placeholder="Engineer" class="form-control" wire:model="<?php echo 'eng'.$i ?>"/>
                                                            @error('eng'.$i)
                                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-2 form-group">
                                                            <input type="number" min='0' max="100" placeholder="Technician" class="form-control" wire:model="<?php echo 'tech'.$i ?>"/>
                                                            @error('tech'.$i)
                                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-2 form-group">
                                                            <input type="number" min='0' max="100" placeholder="Rigger" class="form-control" wire:model="<?php echo 'rigger'.$i ?>"/>
                                                            @error('rigger'.$i)
                                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-2 form-group">
                                                            <input type="number" min='0' max="100" placeholder="Helper" class="form-control" wire:model="<?php echo 'helper'.$i ?>"/>
                                                            @error('helper'.$i)
                                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-2 form-group">
                                                            <input type="number" min='0' max="100" placeholder="Other" class="form-control" wire:model="<?php echo 'other'.$i ?>"/>
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
                                                            <p>Other Service:  Outsourcing FO team </p>
                                                            <input type="hidden" class="form-control" value="Other Service:  Outsourcing FO team" wire:model="service_type2">
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
                                                            
                                                            <select class="form-control" wire:model="<?php echo 'year'.$i ?>">
                                                                <option value="">-- Select Year --</option>
                                                                <?php
                                                                    for($y = (date('Y') - 5); $y <= date('Y'); $y++){
                                                                ?>
                                                                <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </select>
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
                                                            <input type="number" min='0' max="100" placeholder="Invoice" class="form-control" wire:model="<?php echo 'invoice'.$i ?>"/>
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
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
                                </div>
                            </div>                            
                        </div>
                        </form>
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

