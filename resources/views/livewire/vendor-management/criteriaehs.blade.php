@section('title', __('Vendor Management - Evaluate Commercial Compliance'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div><br></div>
            <div><br></div>
            <div><br></div>
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#newevaluation">New Evaluation</a></li>
                <?php
                    
                    $tabdata = \App\Models\VendorManagementehs::select('created_at')->where('id_supplier', $this->selected_id)->groupBy(DB::Raw('date(created_at)'))->orderBy(DB::Raw('date(created_at)'), 'desc')->get();
                    foreach($tabdata as $key => $item){

                ?>
                <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#historiehs<?php echo date_format(date_create($item->created_at), 'dMY'); ?>">{{ date_format(date_create($item->created_at), 'd M Y') }}<?php if($key == 0){ echo "<span style='color: red;'>*</span>"; } ?></a></li>
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
                                                        <div class="col-md-10 form-group">
                                                        
                                                            <h5>Quality Management</h5> 
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="row">
                                                                <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                    </div>
                                                    <hr>
                                                
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Company Structure - Organization, Diagram</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <select name="" id="" class="form-control" wire:model="value1">
                                                                    <option value=""></option>
                                                                    <option value="1">Have</option>
                                                                    <option value="0">Not Have</option>
                                                                </select>
                                                                
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label>Project Management - Organization, Diagram or Process</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <select name="" id="" class="form-control" wire:model="value2">
                                                                    <option value=""></option>
                                                                    <option value="1">Have</option>
                                                                    <option value="0">Not Have</option>
                                                                </select>
                                                                
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label>Quality Management - Diagram or Process</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <select name="" id="" class="form-control" wire:model="value3">
                                                                    <option value=""></option>
                                                                    <option value="1">Have</option>
                                                                    <option value="0">Not Have</option>
                                                                </select>
                                                                
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label>Training Management - Diagram or Process</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <select name="" id="" class="form-control" wire:model="value4">
                                                                    <option value=""></option>
                                                                    <option value="1">Have</option>
                                                                    <option value="0">Not Have</option>
                                                                </select>
                                                                
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label>Project Reporting - Diagram or Process</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <select name="" id="" class="form-control" wire:model="value5">
                                                                    <option value=""></option>
                                                                    <option value="1">Have</option>
                                                                    <option value="0">Not Have</option>
                                                                </select>
                                                                
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label>Documentation management - Diagram or Process</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <select name="" id="" class="form-control" wire:model="value6">
                                                                    <option value=""></option>
                                                                    <option value="1">Have</option>
                                                                    <option value="0">Not Have</option>
                                                                </select>
                                                                
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label>Others</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <select name="" id="" class="form-control" wire:model="value7">
                                                                    <option value=""></option>
                                                                    <option value="1">Have</option>
                                                                    <option value="0">Not Have</option>
                                                                </select>
                                                                
                                                            </div>
                                                        </div>

                                                    </div>

                                                
                                                    
                                                </div>

                                                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px;">
                                                    
                                                    
                                                    <div class="row">
                                                        <div class="col-md-4 form-group">
                                                        
                                                            <h5>EHS</h5> 
                                                        </div>
                                                        
                                                    </div>
                                                    <hr>
                                                
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Working at High (TKPK TK1)</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <input type="number" class="form-control"  wire:model="value8">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label>Working at High (TKBT TK2)</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <input type="number" class="form-control" wire:model="value9">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label>Basic Electrical</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <input type="number" class="form-control" wire:model="value10">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label>First Aid </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <input type="number" class="form-control" wire:model="value11">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label>K3</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <input type="number" class="form-control" wire:model="value12">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label>Huawei Pass ID - L0 </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <input type="number" class="form-control" wire:model="value13">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label>Huawei Pass ID - L1</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <input type="number" class="form-control" wire:model="value14">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label>Others … </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <input type="number" class="form-control" wire:model="value15">
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
                                                    <!-- <div class="col-md-3">
                                                        
                                                    </div> -->
                                                </div>
                                                
                                                <hr>
                                                <h1 style="font-size: 65px">
                                                    {{ $data['ehs_quality_management'] }}
                                                </h1>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                                                <h5>Company Structure</h5>
                                                <hr>
                                                <h1 style="font-size: 50px">
                                                {{ $data['ehs_company_structure'] }}
                                                </h1>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                                                <h5>Quality Management</h5>
                                                <hr>
                                                <h1 style="font-size: 50px">
                                                {{ $data['ehs_qualitymanagement'] }}
                                                </h1>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                                                <h5>Training Management</h5>
                                                <hr>
                                                <h1 style="font-size: 50px">
                                                    {{ $data['ehs_training_management'] }}
                                                </h1>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                                                <h5>Project Reporting</h5>
                                                <hr>
                                                <h1 style="font-size: 50px">
                                                    {{ $data['ehs_project_management'] }}
                                                </h1>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                                                <h5>Documentation Management</h5>
                                                <hr>
                                                <h1 style="font-size: 50px">
                                                {{ $data['ehs_documentation'] }}
                                                </h1>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                                                <h5>Cerificate Category</h5>
                                                <hr>
                                                <h1 style="font-size: 50px">
                                                {{ $data['ehs_certificate'] }}
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
                    $tabdata = \App\Models\VendorManagementehs::select('created_at')->where('id_supplier', $this->selected_id)->groupBy(DB::Raw('date(created_at)'))->orderBy(DB::Raw('date(created_at)'), 'desc')->get();
                    foreach($tabdata as $item){
                ?>
                <div class="tab-pane" id="historiehs<?php echo date_format(date_create($item->created_at), 'dMY'); ?>">
                    @livewire('vendor-management.historiehs', ['date' => $item->created_at, 'selected_id' => $this->selected_id])
                </div>
                <?php
                    }
                ?>  

            </div>
        </div>
    </div>
</div>

