@section('title', __('Vendor Management - Input'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="tab-content">      
                <div class="header row">
                    <div class="col-md-8">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-eye"></i> Evaluation Score</h5>
                    </div>
                    <div class="col-md-4">
                        <form wire:submit.prevent="save">
                            @csrf
                            <!-- <a href="javascript:;"  wire:click="$emit('downloadevaluasi','{{ $selected_id }}')" title="Upload" class="btn btn-primary"><i class="fa fa-download"></i> Download Evaluasi</a> -->
                            <button type="submit" class="btn btn-info close-modal"><i class="fa fa-download"></i> Download Scoring</button>
                            
                        </form>
                    </div>
                    
                </div>

                <hr>
                <div class="body pt-0">
                    <div class="form-group">
                        <!-- <form wire:submit.prevent="save"> -->
                            
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    @if($supplier_category != 'Material Supplier')
                                    <div class="row">
                                        <div class="col-md-4  form-group"><label>General Information (10%)</label></div>
                                        <div class="col-md-4 form-group">
                                            <input type="number" min='0' max="100" class="form-control" wire:model="general_information" readonly/>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <?php
                                                $urlgi = route('vendor-management.general-information',['id'=>'ids']);
                                                $urlgi = str_replace('ids', $selected_id, $urlgi);

                                            ?>
                                            <a href="<?php echo $urlgi; ?>" title="Evaluate" class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                                        </div>
                                    </div>
                                    <br>
                                    
                                    <div class="row">
                                        <div class="col-md-4  form-group"><label>Team Availability (25%)</label></div>
                                        <div class="col-md-4 form-group">
                                            <input type="number" min='0' max="100" class="form-control" wire:model="team_availability_capability" readonly/>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <?php
                                                $urlta = route('vendor-management.team-availability',['id'=>'ids']);
                                                $urlta = str_replace('ids', $selected_id, $urlta);

                                            ?>
                                            <a href="<?php echo $urlta; ?>" title="Evaluate" class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-md-4 form-group"><label>Tools Facilities (20%)</label></div>
                                        <div class="col-md-4 form-group">
                                            <input type="number" min='0' max="100" class="form-control" wire:model="tools_facilities" readonly/>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <?php
                                                $urltf = route('vendor-management.tools-facilities',['id'=>'ids']);
                                                $urltf = str_replace('ids', $selected_id, $urltf);

                                            ?>
                                            <a href="<?php echo $urltf; ?>" title="Evaluate" class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-md-4 form-group"><label>EHS & Quality Management (20%)</label></div>
                                        <div class="col-md-4 form-group">
                                            <input type="number" min='0' max="100" class="form-control" wire:model="ehs_quality_management" readonly/>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <?php
                                                $urlehs = route('vendor-management.ehs',['id'=>'ids']);
                                                $urlehs = str_replace('ids', $selected_id, $urlehs);

                                            ?>
                                            <a href="<?php echo $urlehs; ?>" title="Evaluate" class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                                        </div>
                                    </div>
                                    <br>
                                    

                                    <div class="row">
                                        <div class="col-md-4 form-group"><label>Commercial Compliance (25%)</label></div>
                                        <div class="col-md-4 form-group">
                                            <input type="number" min='0' max="100" class="form-control" wire:model="commercial_compliance" readonly/>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <?php
                                                $urlcc = route('vendor-management.commercial-compliance',['id'=>'ids']);
                                                $urlcc = str_replace('ids', $selected_id, $urlcc);

                                            ?>
                                            <a href="<?php echo $urlcc; ?>" title="Evaluate" class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                                        </div>
                                    </div>
                                    <br>

                                    @else
                                    <div class="row">
                                        <div class="col-md-4  form-group"><label>General Information (40%)</label></div>
                                        <div class="col-md-4 form-group">
                                            <input type="number" min='0' max="100" class="form-control" wire:model="general_information" readonly/>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <?php
                                                $urlgi = route('vendor-management.general-information',['id'=>'ids']);
                                                $urlgi = str_replace('ids', $selected_id, $urlgi);

                                            ?>
                                            <a href="<?php echo $urlgi; ?>" title="Evaluate" class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-md-4 form-group"><label>Commercial Compliance (60%)</label></div>
                                        <div class="col-md-4 form-group">
                                            <input type="number" min='0' max="100" class="form-control" wire:model="commercial_compliance" readonly/>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <?php
                                                $urlcc = route('vendor-management.commercial-compliance',['id'=>'ids']);
                                                $urlcc = str_replace('ids', $selected_id, $urlcc);

                                            ?>
                                            <a href="<?php echo $urlcc; ?>" title="Evaluate" class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                                        </div>
                                    </div>
                                    <br>
                                    @endif
                                    
                                        
                                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                                        <script>

                                            // Jquery Dependency

                                            
                                            $("input[data-type='currency']").on({
                                                keyup: function() {
                                                formatCurrency($(this));
                                                },
                                                blur: function() { 
                                                formatCurrency($(this), "blur");
                                                }
                                            });


                                            function formatNumber(n) {
                                                // format number 1000000 to 1,234,567
                                                return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                                            }


                                            function formatCurrency(input, blur) {
                                                var input_val = input.val();
                                                if (input_val === "") { return; }
                                                var original_len = input_val.length;
                                                var caret_pos = input.prop("selectionStart");
                                                if (input_val.indexOf(".") >= 0) {
                                                    var decimal_pos = input_val.indexOf(".");

                                                    // split number by decimal point
                                                    var left_side = input_val.substring(0, decimal_pos);
                                                    var right_side = input_val.substring(decimal_pos);

                                                    // add commas to left side of number
                                                    left_side = formatNumber(left_side);

                                                    // validate right side
                                                    right_side = formatNumber(right_side);
                                                 
                                                    input_val = "Rp" + left_side;

                                                } else {
                                                    
                                                    input_val = formatNumber(input_val);
                                                    input_val = "Rp" + input_val;
                                                   
                                                }
                                                
                                                // send updated string to input
                                                input.val(input_val);

                                                // put caret back in the right position
                                                var updated_len = input_val.length;
                                                caret_pos = updated_len - original_len + caret_pos;
                                                input[0].setSelectionRange(caret_pos, caret_pos);
                                            }



                                        </script>
                             
                                    </div>
                                </div>
<!--                                 
                                <div class="col-md-12 form-group">
                                    <hr />
                                    
                                    <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
                                </div> -->
                            </div>
                        <!-- </form> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>