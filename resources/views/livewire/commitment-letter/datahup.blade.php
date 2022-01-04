<div class="row">
    <div class="col-md-3">
        <input type="text" class="form-control" placeholder="Search Project, Region, Area, Employee, Leader..." wire:model="keyword" />
    </div>
    <div class="col-md-4">
        <a href="javascript:;" wire:click="$emit('modaladdpmtcommitmentletter')" class="btn btn-info"><i class="fa fa-plus"></i> Add Commitment Letter</a>
    </div>
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>
                    <tr>
                        <th>No</th> 
                        <th>Project</th> 
                        <th>Region</th> 
                        <th>Region / Area</th> 
                        <th>Employee Name</th> 
                        <th>KTP ID</th> 
                        <th>NIK PMT</th> 
                        <th>Leader</th> 
                        <th>Created By</th> 
                        <th>Type</th>
                        <th>Date Create</th> 
                        <th>Status</th> 
                        <th>Action</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>

                        <td>
                           {{ get_project_company($item->project, $item->company_name) }}
                        </td>
                        <td>{{ $item->region }}</td>
                        <td>{{ $item->region_area }}</td>
                        <td>
                            <?php
                                if(Auth::user()->name == $item->employee_name){
                                    echo '<b>'.$item->employee_name.'</b>';
                                }else{
                                    echo $item->employee_name;
                                }
                            
                            ?>
                        </td>
                        <td>{{ $item->ktp_id }}</td>
                        <td>{{ $item->nik_pmt }}</td>
                        <td>{{ $item->leader }}</td>
                        <td>
                            <?php
                                if(Auth::user()->name == $item->createdby){
                                    echo '<b>'.$item->createdby.'</b>';
                                }else{
                                    echo $item->createdby;
                                }
                            
                            ?>
                        </td>
                        
                        <td>
                            <?php

                            if($item->type_letter == '1'){
                                $titledoc = 'BCG';
                                $folderdoc = 'BCG';
                                $filedoc = $item->doc;
                                $modaldoc = 'modalimportbcg';
                            }elseif($item->type_letter == '2'){
                                $titledoc = 'Cyber Security';
                                $folderdoc = 'Cyber_Security';
                                $filedoc = $item->doc;
                                $modaldoc = 'modalimportcybersecurity';
                            }else{
                                $titledoc = 'Other : '.$item->type_letter;
                                $folderdoc = 'Other';
                                $filedoc = $item->doc;
                                $modaldoc = 'modalimportdoc';
                            }

                            ?>

                            @if($item->doc == '' || $item->doc == NULL )
                                @if(check_access('commitment-letter.pic'))
                                    <a href="javascript:;" wire:click="$emit('modalimportdoc','{{ $item->id }}')"><i class="fa fa-upload"></i> Upload <?php echo @$titledoc; ?></a>
                                @endif
                            @else
                                <a href="<?php echo asset('storage/Commitment_Letter/'.$folderdoc.'/'.$filedoc); ?>"><i class="fa fa-download" style="color: #28a745;"></i> Download <?php echo @$titledoc; ?></a>
                            @endif
                        </td>
                        <!-- <td>
                            
                            @if($item->bcg == '' || $item->bcg == NULL )
                                @if(check_access('commitment-letter.pic'))
                                    <a href="javascript:;" wire:click="$emit('modalimportbcg','{{ $item->id }}')"><i class="fa fa-upload fa-2x"></i></a>
                                @endif
                            @else
                                <a href="<?php echo asset('storage/Commitment_Letter/BCG/'.$item->bcg); ?>"><i class="fa fa-download fa-2x" style="color: #28a745;"></i></a>
                            @endif
                            
                        </td>
                        <td>
                            
                            @if($item->cyber_security == '' || $item->cyber_security == NULL )
                                @if(check_access('commitment-letter.pic'))
                                    <a href="javascript:;" wire:click="$emit('modalimportcybersecurity','{{ $item->id }}')"><i class="fa fa-upload fa-2x"></i></a>
                                @endif
                            @else
                                <a href="<?php echo asset('storage/Commitment_Letter/Cyber_Security/'.$item->cyber_security); ?>"><i class="fa fa-download fa-2x" style="color: #28a745;"></i></a>
                            @endif
                        </td> -->
                        <td>{{ date_format(date_create($item->created_at), 'd M Y') }}</td>
                        <td>
                            @if($item->bcg != '' && $item->cyber_security != '')
                                <label class="badge badge-success" data-toggle="tooltip" title="Signed">Signed</label>
                            @else
                                <label class="badge badge-warning" data-toggle="tooltip" title="Unsigned">Unsigned</label>
                            @endif

                            @if($item->status == '1')
                                <label class="badge badge-success" data-toggle="tooltip" title="Done">Done</label>
                            @endif

                            @if($item->status == '0')
                                <label class="badge badge-danger" data-toggle="tooltip" title="{{ $item->note }}">Decline</label>
                            @endif
                        </td>
                        <td>
                            @if(check_access('commitment-letter.admin'))
                                @if($item->doc != '')
                                    @if($item->status == NULL || $item->status == '')
                                    <a href="javascript:;" wire:click="$emit('modalapprovecommitmentletter','{{ $item->id }}')" title="Approve" class="btn btn-success"><i class="fa fa-check"></i> Approve</a>
                                    <a href="javascript:;" wire:click="$emit('modaldeclinecommitmentletter','{{ $item->id }}')" title="Decline" class="btn btn-danger"><i class="fa fa-close"></i> Decline</a>
                                    @endif
                                @endif
                            @endif

                            @if(check_access('commitment-letter.pic'))
                                @if($item->status == '0')
                                    <a href="javascript:;" wire:click="$emit('modaleditcommitmentletter','{{ $item->id }}')" class="btn btn-danger"><i class="fa fa-edit"></i> Revise </a>
                                @endif
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>