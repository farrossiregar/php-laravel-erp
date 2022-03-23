@section('title', __('Tools Facilities'))
@section('parentPageTitle', 'Vendor Management')
<div class="row clearfix">
    <div class="col-lg-1 col-md-6">
        <div class="card overflowhidden">
            <div class="body text-center">
                <div class="p-1">
                    <h3>{{$laptop_score}}</h3>
                    <span>Laptop</span>
                </div>                           
            </div>
            <div class="progress progress-xs progress-transparent custom-color-yellow m-b-0">
                <div class="progress-bar" data-transitiongoal="100" aria-valuenow="100" style="width: 100%;"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-1 col-md-6">
        <div class="card overflowhidden">
            <div class="body text-center">
                <div class="p-1">
                    <h3>{{$vehicle_score}}</h3>
                    <span>Vehicle</span>
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
                    <h3>{{$generator_score}}</h3>
                    <span>Generators</span>
                </div>                            
            </div>
            <div class="progress progress-xs progress-transparent custom-color-blue m-b-0">
                <div class="progress-bar" data-transitiongoal="100" aria-valuenow="100" style="width: 100%;"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-6">
        <div class="card overflowhidden">
            <div class="body text-center">
                <div class="p-1">
                    <h3>{{$special_tools_score}}</h3>
                    <span>Special Tools</span>
                </div>                            
            </div>
            <div class="progress progress-xs progress-transparent custom-color-blue m-b-0">
                <div class="progress-bar" data-transitiongoal="100" aria-valuenow="100" style="width: 100%;"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-6">
        <div class="card overflowhidden">
            <div class="body text-center">
                <div class="p-1">
                    <h3>{{$warehouse_score}}</h3>
                    <span>Warehouse</span>
                </div>                            
            </div>
            <div class="progress progress-xs progress-transparent custom-color-blue m-b-0">
                <div class="progress-bar" data-transitiongoal="100" aria-valuenow="100" style="width: 100%;"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-6">
        <div class="card overflowhidden">
            <div class="body text-center">
                <div class="p-1">
                    <h3>{{$dop_score}}</h3>
                    <span>DOP</span>
                </div>                            
            </div>
            <div class="progress progress-xs progress-transparent custom-color-blue m-b-0">
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
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs">
            @if(count(\App\Models\VendorManagementtfinit::select('created_at')->where('id_supplier', $this->selected_id)->get()) < 1)
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#newevaluation">New Evaluation</a></li>
                @else
                    @foreach(\App\Models\VendorManagementtfinit::select('created_at')->where('id_supplier', $this->selected_id)->groupBy(DB::Raw('date(created_at)'))->orderBy(DB::Raw('date(created_at)'), 'desc')->get() as $key => $item)
                        <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#historitf<?php echo date_format(date_create($item->created_at), 'dMY'); ?>">{{ date_format(date_create($item->created_at), 'd M Y') }}<?php if($key == 0){ echo "<span style='color: red;'>*</span>"; } ?></a></li>
                    @endforeach
                @endif
            </ul>
            <div class="tab-content">
                @if(count(\App\Models\VendorManagementtfinit::select('created_at')->where('id_supplier', $this->selected_id)->get()) < 1)
                <div class="tab-pane active show" id="newevaluation">  
                    <form wire:submit.prevent="save">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <?php 
                                        $check_data = \App\Models\VendorManagementtfinit::where('id_supplier', $this->selected_id)->get();
                                    ?>
                                    <div class="col-md-12">
                                        <h5>Tools & Facilities</h5> 
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Laptop</label>
                                            </div>
                                            <div class="col-md-1">
                                                <p for="">Unit</p>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" wire:model="value1" />
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <label>Vehicle</label>
                                            </div>
                                            <div class="col-md-1">
                                                <p for="">Unit</p>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="number" class="form-control" placeholder="Car" wire:model="value2"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="number" class="form-control"  placeholder="Pick-Up" wire:model="value3"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="number" class="form-control" placeholder="4WD"  wire:model="value4"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>

                                            <div class="col-md-2">
                                                <label>Standard Rigger Tools</label>
                                            </div>
                                            <div class="col-md-1">
                                                <p for="">LS</p>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" wire:model="value5"/>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <label>Safety Tools</label>
                                            </div>
                                            <div class="col-md-1">
                                                <p for="">LS</p>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" wire:model="value6"/>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <label>Compass</label>
                                            </div>
                                            <div class="col-md-1">
                                                <p for="">Unit</p>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" wire:model="value7"/>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <label>GPS</label>
                                            </div>
                                            <div class="col-md-1">
                                                <labpel for="">Unit</labpel>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" wire:model="value8"/>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Angle Meter</label>
                                            </div>
                                            <div class="col-md-1">
                                                <p for="">Unit</p>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" wire:model="value9"/>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Generator</label>
                                            </div>
                                            <div class="col-md-1">
                                                <p for="">Unit</p>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="number" class="form-control" placeholder="5 KVA"  wire:model="value10"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="number" class="form-control"  placeholder="7 KVA" wire:model="value11"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="number" class="form-control"  placeholder=">10 KVA" wire:model="value12"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="">Remarks</label>
                                            </div>
                                            <div class="col-md-1">
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <textarea rows="3" type="text" class="form-control" wire:model="value22"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Special Tools</label>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group"></div>
                                    </div>
                                    <div class="col-md-2">
                                        <p style="margin-left: 20px;">Site Master</p>
                                    </div>
                                    <div class="col-md-1">
                                        <p for="">Unit</p>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="number" class="form-control" wire:model="value13"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <p style="margin-left: 20px;">BER Tester</p>
                                    </div>
                                    <div class="col-md-1">
                                        <p for="">Unit</p>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="number" class="form-control" wire:model="value14"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <p style="margin-left: 20px;">Splicer</p>
                                    </div>
                                    <div class="col-md-1">
                                        <p for="">Unit</p>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="number" class="form-control" wire:model="value15"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <p style="margin-left: 20px;">OTDR</p>
                                    </div>
                                    <div class="col-md-1">
                                        <p for="">Unit</p>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="number" class="form-control" wire:model="value16"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <p style="margin-left: 20px;">TEMS</p>
                                    </div>
                                    <div class="col-md-1">
                                        <p for="">Unit</p>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="number" class="form-control" wire:model="value17"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <p style="margin-left: 20px;">NEMO</p>
                                    </div>
                                    <div class="col-md-1">
                                        <p for="">Unit</p>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="number" class="form-control" wire:model="value18"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <p style="margin-left: 20px;">Spectrum Analyzer</p>
                                    </div>
                                    <div class="col-md-1">
                                        <p for="">Unit</p>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="number" class="form-control" wire:model="value19"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="">Warehouse</label>
                                    </div>
                                    <div class="col-md-1">
                                        <p for="">Unit</p>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="number" class="form-control" wire:model="value20"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="">Drop of Point (DOP)</label>
                                    </div>
                                    <div class="col-md-1">
                                        <p for="">Unit</p>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="number" class="form-control" wire:model="value21"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <a href="{{route('vendor-management.index')}}" class="mr-3"><i class="fa fa-arrow-left"></i> Back</a>
                        <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
                        <span wire:loading>
                            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                            <span class="sr-only">{{ __('Loading...') }}</span>
                        </span>
                    </form>
                </div>
                @else
                    @foreach(\App\Models\VendorManagementtfinit::select('created_at')->where('id_supplier', $this->selected_id)->groupBy(DB::Raw('date(created_at)'))->orderBy(DB::Raw('date(created_at)'), 'desc')->get() as $item)
                    <div class="tab-pane active show" id="historitf<?php echo date_format(date_create($item->created_at), 'dMY'); ?>">
                        @livewire('vendor-management.historiinittoolsfacilities', ['date' => $item->created_at, 'selected_id' => $this->selected_id])
                    </div>
                    @endforeach
                @endif      
            </div>
        </div>
    </div>
</div>

