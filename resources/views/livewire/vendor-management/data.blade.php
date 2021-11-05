<div class="row">
    <div class="col-md-2">
        <input type="text" class="form-control" placeholder="Supplier Name" wire:model="supplier_name" />
    </div>

    
    <div class="col-md-2">
        <select name="" id="" class="form-control" wire:model="supplier_category">
            <option value=""> -- Select Supplier Category -- </option>
            <option value=""> Material Supplier </option>
            <option value="Service - Individual"> Service Supplier - Individual </option>
            <option value="Service - Company"> Service Supplier - Company </option>
        </select>
    </div>

    <div class="col-md-2">
        <select name="" id="" class="form-control" wire:model="sort">
            <option value="1"> Latest </option>
            <option value="2"> Highest Score </option>
        </select>
    </div>


    @if(check_access('business-opportunities.add'))
    <div class="col-md-1" style="margin-right: 50px;">
        <a href="#" data-toggle="modal" data-target="#modal-vendormanagement-serviceinput" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('New Service Supplier')}}</a>
    </div>

    <div class="col-md-2">
        <a href="#" data-toggle="modal" data-target="#modal-vendormanagement-materialinput" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('New Material Supplier')}}</a>
    </div>
    @endif
    
    
    
    
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Supplier Registration Date</th> 
                        <th>Status</th> 
                        <th>Supplier Name</th> 
                        <th>Supplier PIC</th> 
                        <th>Supplier Category</th> 
                        <th>Legal</th> 
                        <th>Org Chart</th> 
                        <th>Tools & Resource</th> 
                        <th>Certification of Resources</th> 
                        <th>Initial Score</th> 
                        <th>Evaluation Score</th> 
                        <th>Summary Note</th> 
                        <th>Improvement Point</th> 
                        
                        <!-- <th>Action</th>  -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            
                            <label class="badge badge-info" data-toggle="tooltip" title="">{{ date_format(date_create($item->supplier_registered_date), 'd M Y') }}</label>
                        </td>
                        
                        <td>
                        <?php
                                $date_evaluation = date('Y-m-d', strtotime("+90 days", strtotime($item->supplier_registered_date)));
                                // echo $date_evaluation.' - '.$item->supplier_registered_date;
                                
                                $diff = abs(strtotime($date_evaluation) - strtotime(date('Y-m-d')));
                                // $diff = abs(strtotime($date_evaluation) - strtotime($item->supplier_registered_date));
                                // $diff = abs(strtotime('2021-12-01') - strtotime($item->supplier_registered_date));
                                // $diff = abs(strtotime(date('Y-m-d')) - strtotime($item->supplier_registered_date));
                                $years   = floor($diff / (365*60*60*24)); 
                                $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
                                $days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                $hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
                                $minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 
                        
                                $waktu = '';
                                if($months > 0){
                                    $waktu .= $months.' month ';
                                }else{
                                    $waktu .= '';
                                }
                        
                                if($days > 0){
                                    $waktu .= $days.' days ';
                                }else{
                                    $waktu .= '';
                                }

                                $waktu .= 'remains';

                                if($date_evaluation <= date('Y-m-d')){
                                    $badgetype = 'badge-success';
                                    $badgetitle = 'Need Evaluation';
                                }else{
                                    if($months < 1){
                                        if($days < 1){
                                            $badgetype = 'badge-success';
                                            $badgetitle = 'Need Evaluation';
                                        }else{
                                            $badgetype = 'badge-warning';
                                            $badgetitle = $waktu;
                                        }
                                        
                                    }else{
                                        $badgetype = 'badge-warning';
                                        $badgetitle = $waktu;
                                    }
                                }
                                
                            ?>
                            <label class="badge <?php echo $badgetype; ?>" data-toggle="tooltip" title="<?php echo $badgetitle; ?>">{{ $badgetitle }}</label>
                            <!-- @if($item->status == null || $item->status == '')
                                <label class="badge badge-warning" data-toggle="tooltip" title="On Going">On Going</label>
                            @endif

                            @if($item->status == 1)
                                <label class="badge badge-success" data-toggle="tooltip" title="Evaluated">Evaluated</label>
                            @endif -->
                        </td>
                        <td>{{ $item->supplier_name }}</td>
                        <td>{{ $item->supplier_pic }}</td>
                        <td>{{ $item->supplier_category }}</td>
                        <td>
                            @if($item->legal)
                                <!-- <a href="<?php echo asset('storage/Vendor_Management/Legal/'.$item->legal.''); ?>" data-toggle="tooltip" title="Download Legal"><i class="fa fa-download"></i> {{__('Download Legal')}}</a> -->
                                <a href="<?php echo asset('storage/Vendor_Management/Legal/'.$item->legal.''); ?>" target="_blank" data-toggle="tooltip" title="Download Legal"><i style="color: #22af46;"  class="fa fa-check  fa-2x"></i> </a>
                            @else
                                <!-- <a href="javascript:;"  wire:click="$emit('modalimportlegal','{{ $item->id }}')" title="Upload" class="btn btn-primary"><i class="fa fa-upload"></i> </a> -->
                                <a href="javascript:;"  wire:click="$emit('modalimportlegal','{{ $item->id }}')" title="Upload" ><i class="fa fa-upload fa-2x"></i> </a>
                            @endif
                        </td>
                        <td>
                            @if($item->org_chart)
                                <a href="<?php echo asset('storage/Vendor_Management/Org_chart/'.$item->org_chart.''); ?>" target="_blank" data-toggle="tooltip" title="Download Org Chart"><i style="color: #22af46;"  class="fa fa-check  fa-2x"></i></a>
                            @else
                                <a href="javascript:;"  wire:click="$emit('modalimportorgchart','{{ $item->id }}')" title="Upload" ><i class="fa fa-upload fa-2x"></i> </a>
                            @endif
                        </td>
                        <td>
                            @if($item->tools_resource)
                                <a href="<?php echo asset('storage/Vendor_Management/Tools_Resource/'.$item->tools_resource.''); ?>" target="_blank" data-toggle="tooltip" title="Download Tools Resource"><i style="color: #22af46;"  class="fa fa-check  fa-2x"></i> </a>
                            @else
                                <a href="javascript:;"  wire:click="$emit('modalimporttoolsresource','{{ $item->id }}')" title="Upload" ><i class="fa fa-upload fa-2x"></i> </a>
                            @endif
                        </td>
                        <td>
                            @if($item->certification_resource)
                                <a href="<?php echo asset('storage/Vendor_Management/Certification_Resource/'.$item->certification_resource.''); ?>" target="_blank" data-toggle="tooltip" title="Download Certification Resource"><i style="color: #22af46;"  class="fa fa-check  fa-2x"></i> </a>
                            @else
                                <a href="javascript:;"  wire:click="$emit('modalimportcertificationresource','{{ $item->id }}')" title="Upload" ><i class="fa fa-upload fa-2x"></i> </a>
                            @endif
                        </td>
                        <td>
                            @if($item->scoring)
                            <!-- <div class="btn btn-success"><b>{{ $item->scoring }}</b></div> -->
                                <a href="javascript:;"  wire:click="$emit('modalinitialscore','{{ $item->id }}')" title="Upload">
                                    <label class="badge badge-success"  style="cursor: pointer;" data-toggle="tooltip" title="<?php echo $item->scoring; ?>" ><label style="font-size: 18px; padding: 3px 0; cursor: pointer;"><b>{{ $item->scoring }}</b></label></label>
                                </a>
                            @else
                                <label class="badge badge-danger" data-toggle="tooltip" title="0"><label style="font-size: 20px; padding: 3px 0;">0</label></label>
                            @endif
                        </td>
                        <td>
                            @if($item->scoring)
                            <!-- <div class="btn btn-success"><b>{{ $item->scoring }}</b></div> -->
                                <a href="javascript:;"  wire:click="$emit('modaldetailscore','{{ $item->id }}')" title="Upload">
                                    <label class="badge badge-success"  style="cursor: pointer;" data-toggle="tooltip" title="<?php echo $item->scoring; ?>" ><label style="font-size: 18px; padding: 3px 0; cursor: pointer;"><b>{{ $item->scoring }}</b></label></label>
                                </a>
                                <!-- <label class="badge badge-success" data-toggle="tooltip" title="<?php echo $item->scoring; ?>" ><label style="font-size: 18px; padding: 3px 0;"><b>{{ $item->scoring }}</b></label></label>
                                <a href="javascript:;"  wire:click="$emit('modaldetailscore','{{ $item->id }}')" title="Upload" class="btn btn-primary"><i class="fa fa-eye"></i></a> -->
                            @else
                                <label class="badge badge-danger" data-toggle="tooltip" title="0"><label style="font-size: 20px; padding: 3px 0;">0</label></label>
                            @endif
                        </td>
                        <td>
                            <?php if($item->summary_note){ echo substr($item->summary_note, 0, 25).'...'; } ?>
                            <a href="javascript:;"  wire:click="$emit('modalsummarynote','{{ $item->id }}')"  style="cursor: pointer;" title="Edit"><i class="fa fa-edit fa-2x"></i> </a>
                        </td>
                        <td>
                            <?php if($item->improvement_point){ echo substr($item->improvement_point, 0, 25).'...'; } ?>
                            <a href="javascript:;"  wire:click="$emit('modalimprovementpoint','{{ $item->id }}')"  style="cursor: pointer;" title="Edit"><i class="fa fa-edit fa-2x"></i> </a>
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>