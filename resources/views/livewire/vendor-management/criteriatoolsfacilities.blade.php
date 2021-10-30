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
                    
                    $tabdata = \App\Models\VendorManagementtf::select('created_at')->where('id_supplier', $this->selected_id)->groupBy(DB::Raw('date(created_at)'))->orderBy(DB::Raw('date(created_at)'), 'desc')->get();
                    foreach($tabdata as $item){

                ?>
                <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#historigi<?php echo date_format(date_create($item->created_at), 'dMY'); ?>">{{ date_format(date_create($item->created_at), 'd M Y') }}</a></li>
                <?php
                    }
                ?>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active show" id="newevaluation">  
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <form wire:submit.prevent="save">
                                    @csrf
                                    <?php
                                        $check_data = \App\Models\VendorManagementtf::where('id_supplier', $this->selected_id)->get();
                                    ?>
                                    <div class="col-md-12">
                                        <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px;">
                                            
                                            
                                            <div class="row">
                                                <div class="col-md-4 form-group">
                                                
                                                    <h5>Tools & Facilities</h5> 
                                                </div>
                                                
                                            </div>
                                            <hr>
                                        
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>Laptop</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label for="">Unit</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" wire:model="value1"/>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <label>Vehicle</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label for="">Unit</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" wire:model="value2"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" wire:model="value3"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" wire:model="value4"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>

                                                <div class="col-md-2">
                                                    <label>Standard Rigger Tools</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label for="">LS</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" wire:model="value5"/>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <label>Safety Tools</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label for="">LS</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" wire:model="value6"/>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <label>Compass</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label for="">Unit</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" wire:model="value7"/>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <label>GPS</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label for="">Unit</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" wire:model="value8"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Angle Meter</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label for="">Unit</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" wire:model="value9"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Generator</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label for="">Unit</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" wire:model="value10"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" wire:model="value11"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" wire:model="value12"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>

                                                <div class="col-md-2">
                                                    <label>Special Tools</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label for="">Unit</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" wire:model="value13"/>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <p style="margin-left: 20px;">Site Master</p>
                                                </div>
                                                <div class="col-md-1">
                                                    <label for="">Unit</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" wire:model="value14"/>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <p style="margin-left: 20px;">BER Tester</p>
                                                </div>
                                                <div class="col-md-1">
                                                    <label for="">Unit</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" wire:model="value15"/>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <p style="margin-left: 20px;">Splicer</p>
                                                </div>
                                                <div class="col-md-1">
                                                    <label for="">Unit</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" wire:model="value16"/>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <p style="margin-left: 20px;">OTDR</p>
                                                </div>
                                                <div class="col-md-1">
                                                    <label for="">Unit</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" wire:model="value17"/>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <p style="margin-left: 20px;">TEMS</p>
                                                </div>
                                                <div class="col-md-1">
                                                    <label for="">Unit</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" wire:model="value18"/>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <p style="margin-left: 20px;">NEMO</p>
                                                </div>
                                                <div class="col-md-1">
                                                    <label for="">Unit</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" wire:model="value19"/>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <p style="margin-left: 20px;">Spectrum Analyzer</p>
                                                </div>
                                                <div class="col-md-1">
                                                    <label for="">Unit</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" wire:model="value20"/>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <label for="">Warehouse</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label for="">Unit</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" wire:model="value21"/>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <label for="">Drop of Point (DOP)</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label for="">Unit</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" wire:model="value22"/>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <label for="">Remarks</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label for="">Unit</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <textarea rows="6" type="text" class="form-control" wire:model="value23"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    
                                        @if(count($check_data) < 1)
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
                                        </div>
                                        @endif
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
                                            {{ $data['tools_facilities'] }}
                                        </h1>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                                        <h5>Laptop</h5>
                                        <hr>
                                        <h1 style="font-size: 50px">
                                            {{ $data['tf_laptop'] }}
                                        </h1>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                                        <h5>Vehicle</h5>
                                        <hr>
                                        <h1 style="font-size: 50px">
                                            {{ $data['tf_vehicle'] }}
                                        </h1>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                                        <h5>Generators</h5>
                                        <hr>
                                        <h1 style="font-size: 50px">
                                        {{ $data['tf_generator'] }}
                                        </h1>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                                        <h5>Special Tools</h5>
                                        <hr>
                                        <h1 style="font-size: 50px">
                                            {{ $data['tf_special_tools'] }}
                                        </h1>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                                        <h5>Warehouse</h5>
                                        <hr>
                                        <h1 style="font-size: 50px">
                                        {{ $data['tf_warehouse'] }}
                                        </h1>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                                        <h5>DOP</h5>
                                        <hr>
                                        <h1 style="font-size: 50px">
                                        {{ $data['tf_dop'] }}
                                        </h1>
                                    </div>
                                </div>

                            </div>
                            
                        </div>
                    </div>
                    
                </div>
                <?php
                    $tabdata = \App\Models\VendorManagementtf::select('created_at')->where('id_supplier', $this->selected_id)->groupBy(DB::Raw('date(created_at)'))->orderBy(DB::Raw('date(created_at)'), 'desc')->get();
                    foreach($tabdata as $item){
                ?>
                <div class="tab-pane" id="historigi<?php echo date_format(date_create($item->created_at), 'dMY'); ?>">
                    @livewire('vendor-management.historitoolsfacilities', ['date' => $item->created_at, 'selected_id' => $this->selected_id])

                </div>
                <?php
                    }
                ?>       
            </div>
        </div>
    </div>
</div>

