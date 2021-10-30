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
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#newevaluation">New Evaluation</a></li>
                <?php
                    
                    $tabdata = \App\Models\VendorManagementcc::select('created_at')->where('id_supplier', $this->selected_id)->groupBy(DB::Raw('date(created_at)'))->orderBy(DB::Raw('date(created_at)'), 'desc')->get();
                    foreach($tabdata as $item){

                ?>
                <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#historicc<?php echo date_format(date_create($item->created_at), 'dMY'); ?>">{{ date_format(date_create($item->created_at), 'd M Y') }}</a></li>
                <?php
                    }
                ?>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active show" id="newevaluation">  
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <form wire:submit.prevent="save">
                                            @csrf
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
                                                                    <select name="" id="" class="form-control" wire:model="value1">
                                                                        <option value=""></option>
                                                                        <option value="50">Low (< 10% )</option>
                                                                        <option value="20">Medium ( 10% s/d 30% )</option>
                                                                        <option value="0">High (> 30% )</option>
                                                                    </select>
                                                                    
                                                                    @error('value1')
                                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <input type="text" min='0' max="100" class="form-control" wire:model="note1"/>
                                                                    @error('note1')
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
                                                                    <select name="" id="" class="form-control" wire:model="value2">
                                                                        <option value=""></option>
                                                                        <option value="0">Low</option>
                                                                        <option value="10">Medium</option>
                                                                        <option value="30">High</option>
                                                                    </select>
                                                                    
                                                                    @error('value2')
                                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <input type="text" min='0' max="100" class="form-control" wire:model="note2"/>
                                                                    @error('note2')
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
                                                                    <select name="" id="" class="form-control" wire:model="value3">
                                                                        <option value=""></option>
                                                                        <option value="0">Low ( >=45 days )</option>
                                                                        <option value="10">Medium ( 30 days )</option>
                                                                        <option value="20">High ( < 15 days )</option>
                                                                    </select>
                                                                    
                                                                    @error('value3')
                                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <input type="text" min='0' max="100" class="form-control" wire:model="note3"/>
                                                                    @error('note3')
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
                                                                    

                                                                    <input type="number" min='0' max="50" class="form-control" wire:model="value4"/>
                                                                    
                                                                    @error('value4')
                                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <input type="text" min='0' max="100" class="form-control" wire:model="note4"/>
                                                                    @error('note4')
                                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
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
                                                    <!-- <div class="col-md-3">
                                                        
                                                    </div> -->
                                                </div>
                                                
                                                <hr>
                                                <h1 style="font-size: 65px">
                                                    {{ @$value1 + @$value2 + @$value3 + @$value4 }}
                                                </h1>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 180px;">
                                                <h5>Price Compliance</h5>
                                                <hr>
                                                <h1 style="font-size: 50px">
                                                    {{ @$value1 }}
                                                </h1>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 180px;">
                                                <h5>Lead Time Compliance</h5>
                                                <hr>
                                                <h1 style="font-size: 50px">
                                                    {{ @$value2 }}
                                                </h1>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 180px;">
                                                <h5>Payment Term Compliance</h5>
                                                <hr>
                                                <h1 style="font-size: 50px">
                                                    {{ @$value3 }}
                                                </h1>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 180px;">
                                                <h5>Special Requirement</h5>
                                                <hr>
                                                <h1 style="font-size: 50px">
                                                    {{ @$value4 }}
                                                </h1>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                    
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    $tabdata = \App\Models\VendorManagementcc::select('created_at')->where('id_supplier', $this->selected_id)->groupBy(DB::Raw('date(created_at)'))->orderBy(DB::Raw('date(created_at)'), 'desc')->get();
                    foreach($tabdata as $item){
                ?>
                <div class="tab-pane" id="historigi<?php echo date_format(date_create($item->created_at), 'dMY'); ?>">
                
                    <!-- livewire('vendor-management.historigeneralinformation', ['date' => $item->created_at, 'selected_id' => $this->selected_id]) -->
                </div>
                <?php
                    }
                ?>  

            </div>
        </div>
    </div>
</div>

