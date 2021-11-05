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
                                    <?php
                                        $get_data = \App\Models\VendorManagementtf::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '1')->first();
                                        $count = $get_data['value'];       
                                    ?>
                                    <input type="text" class="form-control" placeholder="{{$count}}" wire:model="value1"/>
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
                                            <?php
                                                $get_data = \App\Models\VendorManagementtf::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '2')->first();
                                                $count = $get_data['value'];       
                                            ?>
                                            <input type="text" class="form-control" placeholder="{{$count}}" wire:model="value2"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $get_data = \App\Models\VendorManagementtf::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '3')->first();
                                                $count = $get_data['value'];       
                                            ?>
                                            <input type="text" class="form-control" placeholder="{{$count}}" wire:model="value3"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $get_data = \App\Models\VendorManagementtf::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '4')->first();
                                                $count = $get_data['value'];       
                                            ?>
                                            <input type="text" class="form-control" placeholder="{{$count}}" wire:model="value4"/>
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
                                    <?php
                                        $get_data = \App\Models\VendorManagementtf::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '5')->first();
                                        $count = $get_data['value'];       
                                    ?>
                                    <input type="text" class="form-control" placeholder="{{$count}}" wire:model="value5"/>
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
                                <?php
                                        $get_data = \App\Models\VendorManagementtf::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '6')->first();
                                        $count = $get_data['value'];       
                                    ?>
                                    <input type="text" class="form-control" placeholder="{{$count}}" wire:model="value6"/>
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
                                <?php
                                        $get_data = \App\Models\VendorManagementtf::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '7')->first();
                                        $count = $get_data['value'];       
                                    ?>
                                    <input type="text" class="form-control" placeholder="{{$count}}" wire:model="value7"/>
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
                                <?php
                                        $get_data = \App\Models\VendorManagementtf::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '8')->first();
                                        $count = $get_data['value'];       
                                    ?>
                                    <input type="text" class="form-control" placeholder="{{$count}}" wire:model="value8"/>
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
                                <?php
                                        $get_data = \App\Models\VendorManagementtf::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '9')->first();
                                        $count = $get_data['value'];       
                                    ?>
                                    <input type="text" class="form-control" placeholder="{{$count}}" wire:model="value9"/>
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
                                            <?php
                                                $get_data = \App\Models\VendorManagementtf::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '10')->first();
                                                $count = $get_data['value'];       
                                            ?>
                                            <input type="text" class="form-control" placeholder="{{$count}}" wire:model="value10"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <?php
                                                $get_data = \App\Models\VendorManagementtf::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '11')->first();
                                                $count = $get_data['value'];       
                                            ?>
                                            <input type="text" class="form-control" placeholder="{{$count}}" wire:model="value11"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <?php
                                                $get_data = \App\Models\VendorManagementtf::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '12')->first();
                                                $count = $get_data['value'];       
                                            ?>
                                            <input type="text" class="form-control" placeholder="{{$count}}" wire:model="value12"/>
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
                                    <?php
                                        $get_data = \App\Models\VendorManagementtf::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '13')->first();
                                        $count = $get_data['value'];       
                                    ?>
                                    <input type="text" class="form-control" placeholder="{{$count}}" wire:model="value13"/>
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
                                <?php
                                        $get_data = \App\Models\VendorManagementtf::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '14')->first();
                                        $count = $get_data['value'];       
                                    ?>
                                    <input type="text" class="form-control" placeholder="{{$count}}" wire:model="value14"/>
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
                                <?php
                                        $get_data = \App\Models\VendorManagementtf::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '15')->first();
                                        $count = $get_data['value'];       
                                    ?>
                                    <input type="text" class="form-control" placeholder="{{$count}}" wire:model="value15"/>
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
                                <?php
                                        $get_data = \App\Models\VendorManagementtf::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '16')->first();
                                        $count = $get_data['value'];       
                                    ?>
                                    <input type="text" class="form-control" placeholder="{{$count}}" wire:model="value16"/>
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
                                <?php
                                        $get_data = \App\Models\VendorManagementtf::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '17')->first();
                                        $count = $get_data['value'];       
                                    ?>
                                    <input type="text" class="form-control" placeholder="{{$count}}" wire:model="value17"/>
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
                                <?php
                                        $get_data = \App\Models\VendorManagementtf::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '18')->first();
                                        $count = $get_data['value'];       
                                    ?>
                                    <input type="text" class="form-control" placeholder="{{$count}}" wire:model="value18"/>
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
                                <?php
                                        $get_data = \App\Models\VendorManagementtf::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '19')->first();
                                        $count = $get_data['value'];       
                                    ?>
                                    <input type="text" class="form-control" placeholder="{{$count}}" wire:model="value19"/>
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
                                <?php
                                        $get_data = \App\Models\VendorManagementtf::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '20')->first();
                                        $count = $get_data['value'];       
                                    ?>
                                    <input type="text" class="form-control" placeholder="{{$count}}" wire:model="value20"/>
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
                                <?php
                                        $get_data = \App\Models\VendorManagementtf::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '21')->first();
                                        $count = $get_data['value'];       
                                    ?>
                                    <input type="text" class="form-control"  placeholder="{{$count}}" wire:model="value21"/>
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
                                <?php
                                        $get_data = \App\Models\VendorManagementtf::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '22')->first();
                                        $count = $get_data['value'];       
                                    ?>
                                    <input type="text" class="form-control"  placeholder="{{$count}}" wire:model="value22"/>
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
                                <?php
                                        $get_data = \App\Models\VendorManagementtf::where('id_supplier', $selected_id)->whereDate('created_at', date_format(date_create($date), 'Y-m-d') )->where('id_detail', '23')->first();
                                        $count = $get_data['value'];       
                                    ?>
                                    <textarea rows="6" type="text" class="form-control" placeholder="{{$count}}" wire:model="value23"></textarea>
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

                    </div>
                    
                    <hr>
                    <h1 style="font-size: 65px">
                        
                    </h1>
                </div>
            </div>
            <div class="col-md-12">
                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                    <h5>Laptop</h5>
                    <hr>
                    <h1 style="font-size: 50px">
                        
                    </h1>
                </div>
            </div>

            <div class="col-md-12">
                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                    <h5>Vehicle</h5>
                    <hr>
                    <h1 style="font-size: 50px">

                    </h1>
                </div>
            </div>

            <div class="col-md-12">
                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                    <h5>Generators</h5>
                    <hr>
                    <h1 style="font-size: 50px">
                    
                    </h1>
                </div>
            </div>

            <div class="col-md-12">
                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                    <h5>Special Tools</h5>
                    <hr>
                    <h1 style="font-size: 50px">
                        
                    </h1>
                </div>
            </div>

            <div class="col-md-12">
                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                    <h5>Warehouse</h5>
                    <hr>
                    <h1 style="font-size: 50px">
                    
                    </h1>
                </div>
            </div>

            <div class="col-md-12">
                <div style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px; margin: 5px; height: 120px;">
                    <h5>DOP</h5>
                    <hr>
                    <h1 style="font-size: 50px">
                    
                    </h1>
                </div>
            </div>

        </div>
        
    </div>
    
</div>

