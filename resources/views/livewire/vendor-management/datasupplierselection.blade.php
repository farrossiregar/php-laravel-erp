<div class="row">
    <div class="col-md-2">
        <input type="date" class="form-control" placeholder="Project Name" wire:model="date" />
    </div>

    <div class="col-md-2">
        <input type="text" class="form-control" placeholder="Project Name" wire:model="supplier_name" />
    </div>

<!--     
    <div class="col-md-1">                
        <select class="form-control" wire:model="year">
            <option value=""> --- Year --- </option>
            @foreach(\App\Models\EmployeeNoc::select('year')->groupBy('year')->get() as $item) 
            <option>{{$item->year}}</option>
            @endforeach 
        </select>
    </div> -->


    <!-- if(check_access('business-opportunities.add')) -->
    <div class="col-md-1" style="margin-right: 50px;">
        <a href="#" data-toggle="modal" data-target="#modal-vendormanagement-newproject" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Create New Project')}}</a>
    </div>

    <!-- endif -->
    
    
    
    
    <div class="col-md-12">
        <br><br>
        
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Project Name</th> 
                        <th>Project PIC</th> 
                        <th>Project Category</th> 
                        <th>Supplier 1</th> 
                        <th>Supplier 2</th> 
                        <th>Supplier 3</th> 
                        <th>Created Date</th> 
                        <!-- <th>Status</th>  -->
                        <th>Action</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->project_name }}</td>
                        <td>{{ $item->project_pic }}</td>
                        <td>{{ $item->project_category }}</td>
                        <td>
                            @if($item->supplier1_id)
                            <b>{{ get_detail_supplier($item->supplier1_id)->supplier_name }}</b> 
                            
                            <a href="#" wire:click="delsupplier1({{ $item->id }})" title="Delete" ><i style="color: #dc3545;" class="fa fa-trash"></i> </a>
                           
                            @else
                            <!-- <a href="#" data-toggle="modal" data-target="#modal-vendormanagement-newproject" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Add Supplier')}}</a> -->
                            <a href="javascript:;"  wire:click="$emit('modaladdsupplier',['{{ $item->project_category }}', '1', '{{$item->id}}'])" title="Detail Comparation"><i style="color: #007bff;" class="fa fa-plus"></i> </a>
                            <!-- <select wire:change="addsupplier1({{ $item->id }})" wire:model="supplier1_id.{{ $item->id }}"  class="form-control" name="" id="">
                                <option value=""> -- Select Supplier --</option>
                                <?php
                                    foreach(\App\Models\Vendormanagement::where('supplier_category', $item->project_category)->get() as $key => $items ){
                                ?>
                                <option <?php if($items->id == $item->supplier1_id){ echo "selected"; } ?>value="{{ $items->id }}">{{ $items->supplier_name }}</option>
                                <?php
                                    }
                                ?>
                            </select> -->
                            @endif
                        </td>
                        <td>
                            @if($item->supplier2_id)
                            <b>{{ get_detail_supplier($item->supplier2_id)->supplier_name }}</b> 
                            <!-- <a href="#" data-toggle="modal" data-target="#modal-vendormanagement-newproject" title="Add" class="btn btn-primary"><i class="fa fa-eye"></i> </a> -->
                            <a href="#" wire:click="delsupplier2({{ $item->id }})" title="Delete" ><i style="color: #dc3545;" class="fa fa-trash"></i> </a>
  
                            @else
                            <a href="javascript:;"  wire:click="$emit('modaladdsupplier',['{{ $item->project_category }}', '2', '{{$item->id}}'])" title="Detail Comparation"><i style="color: #007bff;" class="fa fa-plus"></i> </a>
                            <!-- <select wire:change="addsupplier2({{ $item->id }})" wire:model="supplier2_id.{{ $item->id }}"  class="form-control" name="" id="">
                                <option value=""> -- Select Supplier --</option>
                                <?php
                                    foreach(\App\Models\Vendormanagement::where('supplier_category', $item->project_category)->get() as $key => $items ){
                                ?>
                                <option <?php if($items->id == $item->supplier2_id){ echo "selected"; } ?>value="{{ $items->id }}">{{ $items->supplier_name }}</option>
                                <?php
                                    }
                                ?>
                            </select> -->
                            @endif
                        </td>
                        <td>
                            @if($item->supplier3_id)
                            <b>{{ get_detail_supplier($item->supplier3_id)->supplier_name }} </b>
                            <!-- <a href="#" data-toggle="modal" data-target="#modal-vendormanagement-newproject" title="Add" class="btn btn-primary"><i class="fa fa-eye"></i> </a> -->
                            <a href="#" wire:click="delsupplier3({{ $item->id }})" title="Delete" ><i style="color: #dc3545;" class="fa fa-trash"></i> </a>
                           
                            @else
                            <a href="javascript:;"  wire:click="$emit('modaladdsupplier',['{{ $item->project_category }}', '3', '{{$item->id}}'])" title="Detail Comparation"><i style="color: #007bff;" class="fa fa-plus"></i> </a>
                            <!-- <select wire:change="addsupplier3({{ $item->id }})" wire:model="supplier3_id.{{ $item->id }}"  class="form-control" name="" id="">
                                <option value=""> -- Select Supplier --</option>
                                <?php
                                    foreach(\App\Models\Vendormanagement::where('supplier_category', $item->project_category)->get() as $key => $items ){
                                ?>
                                <option <?php if($items->id == $item->supplier3_id){ echo "selected"; } ?>value="{{ $items->id }}">{{ $items->supplier_name }}</option>
                                <?php
                                    }
                                ?>
                            </select> -->
                            @endif
                        </td>
                        <td>{{ date_format(date_create($item->created_at), 'd M Y') }}</td>
                        <!-- <td>{{ $item->status }}</td> -->
                        <td>
                            <a href="javascript:;"  wire:click="$emit('modalviewcomparation','{{ $item->id }}')" title="Detail Comparation"><i style="color: #007bff;" class="fa fa-eye"></i> </a>
                        </td>
                    </tr>
                    <!-- <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->supplier_name }}</td>
                        <td>{{ $item->supplier_pic }}</td>
                        <td>{{ $item->supplier_category }}</td>
                        <td>
                            @if($item->legal)
                                <a href="<?php echo asset('storage/Vendor_Management/Legal/'.$item->legal.''); ?>" data-toggle="tooltip" title="Download Legal"><i class="fa fa-download"></i> {{__('Download Legal')}}</a>
                            @else
                                <a href="javascript:;"  wire:click="$emit('modalimportlegal','{{ $item->id }}')" title="Upload" class="btn btn-primary"><i class="fa fa-upload"></i> </a>
                            @endif
                        </td>
                        <td>
                            @if($item->org_chart)
                                <a href="<?php echo asset('storage/Vendor_Management/Org_chart/'.$item->org_chart.''); ?>" data-toggle="tooltip" title="Download Org Chart"><i class="fa fa-download"></i> {{__('Download Org Chart')}}</a>
                            @else
                                <a href="javascript:;"  wire:click="$emit('modalimportorgchart','{{ $item->id }}')" title="Upload" class="btn btn-primary"><i class="fa fa-upload"></i> </a>
                            @endif
                        </td>
                        <td>
                            @if($item->tools_resource)
                                <a href="<?php echo asset('storage/Vendor_Management/Tools_Resource/'.$item->tools_resource.''); ?>" data-toggle="tooltip" title="Download Tools Resource"><i class="fa fa-download"></i> {{__('Download Tools Resource')}}</a>
                            @else
                                <a href="javascript:;"  wire:click="$emit('modalimporttoolsresource','{{ $item->id }}')" title="Upload" class="btn btn-primary"><i class="fa fa-upload"></i> </a>
                            @endif
                        </td>
                        <td>
                            @if($item->certification_resource)
                                <a href="<?php echo asset('storage/Vendor_Management/Certification_Resource/'.$item->certification_resource.''); ?>" data-toggle="tooltip" title="Download Certification Resource"><i class="fa fa-download"></i> {{__('Download Certification Resource')}}</a>
                            @else
                                <a href="javascript:;"  wire:click="$emit('modalimportcertificationresource','{{ $item->id }}')" title="Upload" class="btn btn-primary"><i class="fa fa-upload"></i> </a>
                            @endif
                        </td>
                        <td>{{ $item->scoring }}</td>
                        <td>
                            <?php
                                $date_evaluation = date('Y-m-d', strtotime("+90 days", strtotime($item->supplier_registered_date)));
                                // echo $date_evaluation;
                                
                                $diff = abs(strtotime($date_evaluation) - strtotime($item->supplier_registered_date));
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

                                if($months < 1 && $days < 1){
                                    $badgetype = 'badge-success';
                                    $badgetitle = 'Need to Evaluation';
                                }else{
                                    $badgetype = 'badge-warning';
                                    $badgetitle = $waktu;
                                }
                            ?>
                            
                            <label class="badge <?php echo $badgetype; ?>" data-toggle="tooltip" title="<?php echo $badgetitle; ?>">{{ date_format(date_create($item->supplier_registered_date), 'd M Y') }}</label>
                        </td>
                        <td>
                            @if($item->status == null || $item->status == '')
                                <label class="badge badge-warning" data-toggle="tooltip" title="On Going">On Going</label>
                            @endif

                            @if($item->status == 1)
                                <label class="badge badge-success" data-toggle="tooltip" title="Evaluated">Evaluated</label>
                            @endif
                        </td>
                        <td>

                            @if($months < 11 && $days < 1)
                                @if($item->supplier_category == 'Material Supplier')
                                    <a href="javascript:;"  wire:click="$emit('modalmaterialcriteria','{{ $item->id }}')" title="Upload" class="btn btn-primary"><i class="fa fa-edit"></i> Evaluate</a>
                                @endif

                                @if($item->supplier_category == 'Service Supplier')
                                    <a href="javascript:;"  wire:click="$emit('modalservicecriteria','{{ $item->id }}')" title="Upload" class="btn btn-primary"><i class="fa fa-edit"></i> Evaluate</a>
                                @endif
                            @endif
                        </td>
                    </tr> -->
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>