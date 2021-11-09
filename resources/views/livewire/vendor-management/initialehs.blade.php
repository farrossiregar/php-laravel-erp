@section('title', __('Vendor Management - Initial EHS'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div><br></div>
            <div><br></div>
            <div><br></div>
            <ul class="nav nav-tabs">
                @if(count(\App\Models\VendorManagementehsinit::select('created_at')->where('id_supplier', $this->selected_id)->get()) < 1)
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#newevaluation">New Evaluation</a></li>
                @else
                    @foreach(\App\Models\VendorManagementehsinit::select('created_at')->where('id_supplier', $this->selected_id)->groupBy(DB::Raw('date(created_at)'))->orderBy(DB::Raw('date(created_at)'), 'desc')->get() as $key => $item)
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#historiehs<?php echo date_format(date_create($item->created_at), 'dMY'); ?>">{{ date_format(date_create($item->created_at), 'd M Y') }}<?php if($key == 0){ echo "<span style='color: red;'>*</span>"; } ?></a></li>
                    @endforeach
                @endif
            </ul>
            <div class="tab-content">
                @if(count(\App\Models\VendorManagementehsinit::select('created_at')->where('id_supplier', $this->selected_id)->get()) < 1)
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
                                                            <!-- <label>Others</label> -->
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" placeholder="Others" wire:model="service_type7">
                                                            </div>
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
                                                    {{ $data['initial_ehs_quality_management'] }}
                                                </h1>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                                                <h5>Company Structure</h5>
                                                <hr>
                                                <h1 style="font-size: 50px">
                                                {{ $data['initial_ehs_company_structure'] }}
                                                </h1>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                                                <h5>Project Management</h5>
                                                <hr>
                                                <h1 style="font-size: 50px">
                                                {{ $data['initial_ehs_project_management'] }}
                                                </h1>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                                            <h5>Quality Management</h5>
                                                <hr>
                                                <h1 style="font-size: 50px">
                                                {{ $data['initial_ehs_qualitymanagement'] }}
                                                </h1>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                                                <h5>Training Management</h5>
                                                <hr>
                                                <h1 style="font-size: 50px">
                                                    {{ $data['initial_ehs_training_management'] }}
                                                </h1>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                                                <h5>Project Reporting</h5>
                                                <hr>
                                                <h1 style="font-size: 50px">
                                                    {{ $data['initial_ehs_project_management'] }}
                                                </h1>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                                                <h5>Documentation Management</h5>
                                                <hr>
                                                <h1 style="font-size: 50px">
                                                {{ $data['initial_ehs_documentation'] }}
                                                </h1>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                                                <h5>Cerificate Category</h5>
                                                <hr>
                                                <h1 style="font-size: 50px">
                                                {{ $data['initial_ehs_certificate'] }}
                                                </h1>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    
                </div>
                @else
                    @foreach(\App\Models\VendorManagementehsinit::select('created_at')->where('id_supplier', $this->selected_id)->groupBy(DB::Raw('date(created_at)'))->orderBy(DB::Raw('date(created_at)'), 'desc')->get() as $item)
                        <div class="tab-pane active show" id="historiehs<?php echo date_format(date_create($item->created_at), 'dMY'); ?>">
                            @livewire('vendor-management.historiinitehs', ['date' => $item->created_at, 'selected_id' => $this->selected_id])
                        </div>
                    @endforeach
                @endif 

            </div>
        </div>
    </div>
</div>

