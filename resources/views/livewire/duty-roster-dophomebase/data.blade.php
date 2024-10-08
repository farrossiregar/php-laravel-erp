<div class="row">
    <div class="col-md-2">
        <input type="date" class="form-control" wire:model="date" />
    </div>
    <div class="col-md-5">
        @if(check_access('duty-roster-dophomebase.importhrd'))
            <a href="#" data-toggle="modal" data-target="#modal-dutyroster-importdutyroster" title="Add" class="btn btn-primary"><i class="fa fa-upload"></i> {{__('Import DOP Homebase')}}</a>
        @endif
        @if(check_access('duty-roster-dophomebase.importsm'))
            <a href="#" data-toggle="modal" data-target="#modal-dutyroster-importdutyrostersm" title="Add" class="btn btn-primary"><i class="fa fa-upload"></i> {{__('Import DOP Homebase')}}</a>
        @endif
        <a href="#" data-toggle="modal" data-target="#modal-dutyroster-inputdutyroster" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Input DOP Homebase')}}</a>
    </div>
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Project</th>
                        <th>Status</th> 
                        <th>Upload By</th> 
                        <th>Date Upload</th> 
                        <th>Action</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{isset($item->project->name) ? $item->project->name : ''}}</td>
                        <td>
                            @if($item->status == '1')
                                <label class="badge badge-success" data-toggle="tooltip" title="Approved">Approved</label>
                            @endif

                            @if($item->status == '0')
                                <label class="badge badge-danger" data-toggle="tooltip" title="Decline">Decline</label>
                            @endif

                            @if($item->status == '' || $item->status == 'null')
                                <label class="badge badge-warning" data-toggle="tooltip" title="Waiting to Approve">Waiting to Approve</label>
                            @endif
                        </td> 
                        <td>
                            <?php
                                // $dataproblem = \App\Models\DutyrosterDophomebaseDetail::where('id_master_dutyroster', $item->id)->where('remarks', '1')->get();
                                // echo count($dataproblem); 
                            ?>
                            {{ $item->upload_by }}
                        </td>
                        <td>{{ date_format(date_create($item->created_at), 'd M Y') }}</td>
                        <td>
                            <a href="{{route('duty-roster-dophomebase.preview',['id'=>$item->id]) }}" title="Preview" class="badge badge-primary badge-active"><i class="fa fa-eye"></i> {{__('Preview')}}</a>
                            @if(check_access('duty-roster-dophomebase.approval'))
                                @if($item->status == '' || $item->status == null)
                                    <a href="javascript:;" wire:click="$emit('modalapprovedutyroster','{{ $item->id }}')" class="badge badge-success badge-active"><i class="fa fa-check"></i> Approve</a>
                                    <a href="javascript:;" wire:click="$emit('modaldeclinedutyroster','{{ $item->id }}')" class="badge badge-danger badge-active"><i class="fa fa-close"></i> Decline</a>
                                @endif

                            @endif


                            @if(check_access('duty-roster-dophomebase.importhrd'))
                                @if($item->status == '0')
                                    <a href="#" wire:click="$emit('modalrevisidutyroster','{{ $item->id }}')" data-toggle="modal" data-target="#modal-dutyroster-revisidutyroster" title="Add" class="btn btn-warning"><i class="fa fa-plus"></i> {{__('Revisi Duty roster')}}</a>
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