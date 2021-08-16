<div class="row">
    <!-- <div class="col-md-2">
        <input type="date" class="form-control" wire:model="date" />
    </div> -->

    <!-- <div class="col-md-2">
        <input type="text" class="form-control" wire:model="name" />
    </div>

    <div class="col-md-2">
        <select class="form-control" name="" id="" wire:model="position">
            <option value="">-- Position --</option>
            <option value="Rainy Session">Rainy Session</option>
            <option value="Team Rectification">Team Rectification</option>
            <option value="TE Engineer">TE Engineer</option>
            <option value="CME Engineer">CME Engineer</option>
        </select>
    </div> -->
<!--     
    <div class="col-md-1">                
        <select class="form-control" wire:model="year">
            <option value=""> --- Year --- </option>
            @foreach(\App\Models\EmployeeNoc::select('year')->groupBy('year')->get() as $item) 
            <option>{{$item->year}}</option>
            @endforeach 
        </select>
    </div> -->


    @if(!check_access('duty-roster.import'))
    <div class="col-md-2">
        <a href="#" data-toggle="modal" data-target="#modal-dutyroster-importdutyroster" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Input Duty roster')}}</a>
    </div>
    
    @endif
    
    
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th> 
                        <th>Position</th> 
                        <th>Date Join</th> 
                        <th>Date Resign</th> 
                        <th>Account Mateline</th> 
                        <th>No Pass ID</th> 
                        <th>Training K3</th> 
                        <th>Total Site</th> 
                        <th>Status Synergy</th> 
                        <!-- <th>Status Employee</th>  -->
                        <th>Action</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $data = check_access_data('duty-roster-flmengineer.flmengineer-list', '');
                    ?>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ get_position($item->user_access_id) }}</td>
                        <td>{{ isset($item->resign_date) ? date_format(date_create(@$item->join_date), 'd M Y') : '' }}</td>
                        <td>{{ isset($item->resign_date) ? date_format(date_create(@$item->resign_date), 'd M Y') : '' }}</td>
                        
                        <td>{{ get_data_flmengineer($item->id, 'account_mateline') }}</td>
                        <td>{{ get_data_flmengineer($item->id, 'no_pass_id') }}</td>
                        <td>
                            @if(get_data_flmengineer($item->id, 'training_k3') == 'Done')
                                <label class="badge badge-success" data-toggle="tooltip" title="Done">{{ get_data_flmengineer($item->id, 'training_k3') }}</label>
                            @else
                                <label class="badge badge-danger" data-toggle="tooltip" title="Not Yet">{{ get_data_flmengineer($item->id, 'training_k3') }}</label>
                            @endif
                            
                        </td>
                        <td>{{ get_data_flmengineer($item->id, 'total_site') }}</td>
                        
                        
                        <td>
                            <!-- if($item->resign_date == '') -->
                            @if($item->status_synergy == 'Synergy')
                                <label class="badge badge-success" data-toggle="tooltip" title="Approved">Synergy</label>
                            @endif

                            <!-- if($item->resign_date != '') -->
                            @if($item->status_synergy == 'Tidak')
                                <label class="badge badge-danger" data-toggle="tooltip" title="Decline">Tidak</label>
                            @endif

                        </td> 
                        <td>
                            <!-- <a href="{{route('duty-roster.preview',['id'=>$item->id]) }}" title="Add" class="btn btn-primary"><i class="fa fa-eye"></i> {{__('Preview')}}</a>
                            <a href="javascript:;" wire:click="$emit('modalapprovedutyroster','{{ $item->id }}')" class="btn btn-success"><i class="fa fa-check"></i> Approve</a> -->
                            
                            <a href="javascript:;" wire:click="$emit('modaleditdutyrosterflm','{{ $item->name }}')" class="btn btn-primary"><i class="fa fa-edit"></i> Update</a>
                        </td> 
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>