@section('title', __('FLM Engineer - Update Employee'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <br>
                </div>
                <div class="col-md-12">
                    <div class="header row">
                        <!-- <div class="col-md-2">
                            <input type="date" class="form-control" wire:model="date" />
                        </div> -->

                        <div class="col-md-1">
                            <input type="text" class="form-control" wire:model="name" placeholder="Name" />
                        </div>
                        

                        <div class="col-md-2" wire:ignore>
                            <select class="form-control" style="width:100%;" wire:model="position">
                                <option value=""> --- Position --- </option>
                                @foreach(\App\Models\UserAccess::get() as $item)
                                <option value="{{$item->id}}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                   


                    </div>
                </div>
    
                <div class="col-md-12">
                    <div class="body pt-0">
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
                                        // $data = \App\Models\Employee::orderBy('id', 'ASC')->get();
                                    ?>
                                    @foreach($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ @get_position($item->user_access_id) }}</td>
                                        <td>{{ isset($item->resign_date) ? date_format(date_create(@$item->join_date), 'd M Y') : '' }}</td>
                                        <td>{{ isset($item->resign_date) ? date_format(date_create(@$item->resign_date), 'd M Y') : '' }}</td>
                                        
                                        <td>{{ $item->account_mateline }}</td>
                                        <td>{{ $item->no_pass_id }}</td>
                                        <td>
                                            @if($item->training_k3 == 'Done')
                                                <label class="badge badge-success" data-toggle="tooltip" title="Done">{{ get_data_flmengineer($item->id, 'training_k3') }}</label>
                                            @else
                                                <label class="badge badge-danger" data-toggle="tooltip" title="Not Yet">{{ get_data_flmengineer($item->id, 'training_k3') }}</label>
                                            @endif
                                            
                                        </td>
                                        <td>{{ $item->total_site }}</td>
                                        
                                        
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

            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modal-dutyrosterflm-editdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:duty-roster-flmengineer.editdata />
        </div>
    </div>
</div>



@section('page-script')


    Livewire.on('modaleditdutyrosterflm',(data)=>{
        $("#modal-dutyrosterflm-editdata").modal('show');
    });


@endsection