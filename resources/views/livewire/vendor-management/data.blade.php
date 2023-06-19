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
    <div class="col-md-6">
        <a href="#" data-toggle="modal" data-target="#modal-vendormanagement-serviceinput" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('New Service Supplier')}}</a>
        <a href="#" data-toggle="modal" data-target="#modal-vendormanagement-materialinput" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('New Material Supplier')}}</a>
    </div>
    <div class="col-md-12">
        <div class="table-responsive mt-4">
            <table class="table table-striped m-b-0 c_list">
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Registration Date</th> 
                        <th rowspan="2">Aging</th> 
                        <th rowspan="2">Supplier Name</th> 
                        <th rowspan="2">Supplier PIC</th> 
                        <th rowspan="2">Supplier Category</th> 
                        <th rowspan="2">Legal</th> 
                        <th rowspan="2">Org Chart</th> 
                        <th rowspan="2">Tools & Resource</th> 
                        <th rowspan="2">Certification of Resources</th> 
                        <th colspan="5" class="text-center" style="background:#22af46">Initial Score</th> 
                        <th colspan="6" class="text-center"style="background:#BDBA20">Evaluation Score</th> 
                        <th rowspan="2">Summary Note</th> 
                        <th rowspan="2">Improvement Point</th> 
                    </tr>
                    <tr>
                        <th style="background:#d1ecd5b5;">General Information(10%)</th>
                        <th style="background:#d1ecd5b5;">Team Availability (25%)</th>
                        <th style="background:#d1ecd5b5;">Tools Facilities (20%)</th>
                        <th style="background:#d1ecd5b5;">EHS & Quality Management (20%)</th>
                        <th style="background:#d1ecd5b5;">Total</th>
                        <th style="background:#f7f6d7">General Information (10%)</th>
                        <th style="background:#f7f6d7">Team Availability (25%)</th>
                        <th style="background:#f7f6d7">Tools Facilities (20%)</th>
                        <th style="background:#f7f6d7">EHS & Quality Management (20%)</th>
                        <th style="background:#f7f6d7">Commercial Compliance (25%)</th>
                        <th style="background:#f7f6d7">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><label class="badge badge-info" data-toggle="tooltip" title="">{{ date_format(date_create($item->created_at), 'd M Y') }}</label></td>
                        <td>{{calculate_aging($item->created_at)}}</td>
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
                        </td> 
                        <td>{{ $item->supplier_name }}</td>
                        <td>{{ $item->supplier_pic }}</td>
                        <td>{{ $item->supplier_category }}</td>
                        <td>
                            @if($item->legal)
                                <a href="<?php echo asset('storage/Vendor_Management/Legal/'.$item->legal.''); ?>" target="_blank" data-toggle="tooltip" title="Download Legal"><i style="color: #22af46;"  class="fa fa-check"></i> </a>
                            @else
                                <a href="javascript:;"  wire:click="$emit('modalimportlegal','{{ $item->id }}')" title="Upload" ><i class="fa fa-upload"></i> </a>
                            @endif
                        </td>
                        <td>
                            @if($item->org_chart)
                                <a href="<?php echo asset('storage/Vendor_Management/Org_chart/'.$item->org_chart.''); ?>" target="_blank" data-toggle="tooltip" title="Download Org Chart"><i style="color: #22af46;"  class="fa fa-check"></i></a>
                            @else
                                <a href="javascript:;"  wire:click="$emit('modalimportorgchart','{{ $item->id }}')" title="Upload" ><i class="fa fa-upload"></i> </a>
                            @endif
                        </td>
                        <td>
                            @if($item->tools_resource)
                                <a href="<?php echo asset('storage/Vendor_Management/Tools_Resource/'.$item->tools_resource.''); ?>" target="_blank" data-toggle="tooltip" title="Download Tools Resource"><i style="color: #22af46;"  class="fa fa-check"></i> </a>
                            @else
                                <a href="javascript:;"  wire:click="$emit('modalimporttoolsresource','{{ $item->id }}')" title="Upload" ><i class="fa fa-upload"></i> </a>
                            @endif
                        </td>
                        <td>
                            @if($item->certification_resource)
                                <a href="<?php echo asset('storage/Vendor_Management/Certification_Resource/'.$item->certification_resource.''); ?>" target="_blank" data-toggle="tooltip" title="Download Certification Resource"><i style="color: #22af46;"  class="fa fa-check"></i> </a>
                            @else
                                <a href="javascript:;"  wire:click="$emit('modalimportcertificationresource','{{ $item->id }}')" title="Upload" ><i class="fa fa-upload"></i> </a>
                            @endif
                        </td>
                        <td class="text-center"><a href="javascript:void(0)" wire:click="$emit('setid',{{$item->id}})" data-toggle="modal" data-target="#modal_intial_general_information">{{$item->initial_general_information?$item->initial_general_information : 0}}</a></td>
                        <td class="text-center"><a href="javascript:void(0)" wire:click="$emit('setid',{{$item->id}})" data-toggle="modal" data-target="#modal_intial_team_availability">{{$item->initial_team_availability_capability?$item->initial_team_availability_capability : 0}}</a></td>
                        <td class="text-center"><a href="{{route('vendor-management.initial-tools-facilities',$item->id)}}">{{$item->initial_tools_facilities ? $item->initial_tools_facilities : 0}}</a></td>
                        <td class="text-center"><a href="{{route('vendor-management.initial-ehs',$item->id)}}">{{$item->initial_ehs_quality_management ? $item->initial_ehs_quality_management : 0}}</a></td>
                        <td class="text-center">{{$item->initial ? $item->initial : 0}}</td>
                        <td class="text-center"><a href="{{route('vendor-management.general-information',$item->id)}}">{{$item->general_information ? $item->general_information : 0}}</a></td>
                        <td class="text-center"><a href="{{route('vendor-management.team-availability',$item->id)}}">{{$item->team_availability_capability ? $item->team_availability_capability : 0}}</a></td>
                        <td class="text-center"><a href="{{route('vendor-management.tools-facilities',$item->id)}}">{{$item->tools_facilities ? $item->tools_facilities : 0}}</a></td>
                        <td class="text-center"><a href="{{route('vendor-management.ehs',$item->id)}}">{{$item->ehs_quality_management ? $item->ehs_quality_management : 0}}</a></td>
                        <td class="text-center"><a href="{{route('vendor-management.commercial-compliance',$item->id)}}">{{$item->commercial_compliance ? $item->commercial_compliance : 0}}</a></td>
                        <td class="text-center">{{$item->scoring ? $item->scoring : 0}}</td>
                        {{-- <td class="text-center"><a href="javascript:;"  wire:click="$emit('modalinitialscore','{{ $item->id }}')">{{ $item->initial?$item->initial : 0 }}</a></td> --}}
                        {{-- <td><a href="javascript:;"  wire:click="$emit('modaldetailscore','{{ $item->id }}')" data-toggle="tooltip" title="{{ $item->scoring }}" title="Upload"></a></td> --}}
                        <td>
                            <?php if($item->summary_note){ echo substr($item->summary_note, 0, 25).'...'; } ?>
                            <a href="javascript:;"  wire:click="$emit('modalsummarynote','{{ $item->id }}')"  style="cursor: pointer;" title="Edit"><i class="fa fa-edit"></i> </a>
                        </td>
                        <td>
                            <?php if($item->improvement_point){ echo substr($item->improvement_point, 0, 25).'...'; } ?>
                            <a href="javascript:;"  wire:click="$emit('modalimprovementpoint','{{ $item->id }}')"  style="cursor: pointer;" title="Edit"><i class="fa fa-edit"></i> </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" wire:ignore.self id="modal_intial_general_information" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="max-width:90%;" role="document">
            @livewire('vendor-management.initial-score.general-information')
        </div>
    </div>
    <div class="modal fade" wire:ignore.self id="modal_intial_team_availability" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="max-width:99%;" role="document">
            @livewire('vendor-management.initial-score.team-availability')
        </div>
    </div>
</div>