
<div>
    <div class="header row">
        <div class="col-md-2">
            <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
        </div>
        <div class="col-md-2">
            <select class="form-control" wire:model="type">
                <option value=""> --- Action Point --- </option>
                <option value="1">[R] Repetitive</option>
                <option value="2">[N] Non Repetitive</option>
            </select>
        </div>
        <div class="col-md-6">
            <a href="#" data-toggle="modal" data-target="#modal-criticalcase-upload" title="Upload" class="btn btn-primary"><i class="fa fa-upload"></i> {{__('Import')}}</a>
            <span wire:loading>
                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                <span class="sr-only">{{ __('Loading...') }}</span>
            </span>
        </div>
    </div>
    <div class="body pt-0">                
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>
                    <tr>
                        <th>No</th>    
                        <th>Action Point</th>    
                        <th>PIC</th>    
                        <th>Shift Number</th>    
                        <th>Date</th>    
                        <th>Activity Handling</th>    
                        <th>Time Occur</th>    
                        <th>Severity</th>    
                        <th>Project</th>    
                        <th>Region</th>    
                        <th>Category</th>    
                        <th>Impact</th>    
                        <th>Action</th>    
                        <th>Customer Handling</th>    
                        <th>Time Closed</th>    
                        <th>Status</th>    
                        <th>Last Update</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $k => $item)
                    <tr>
                        <td style="width: 50px;">{{$k+1}}</td>
                        <td>
                            @if($item->status_submit==0 and check_access('critical-case.action-point'))
                            <a href="javascript:;" wire:click="$emit('update-critical',{{$item}})" title="Action Point"><i class="fa fa-plus"></i> {{__('Action Point')}}</a>
                            @else
                                @if($item->type==1)
                                    <span class="badge badge-danger">R</span>
                                @endif
                                @if($item->type==2)
                                    <span class="badge badge-info">N</span>
                                @endif
                                {{$item->action_point}}
                            @endif
                        </td>
                        <td>{{ $item->pic }}</td>
                        <td>{{ $item->shift_number }}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->activity_handling }}</td>
                        <td>{{ $item->time_occur }}</td>
                        <td>{{ $item->severity }}</td>
                        <td>{{ $item->project }}</td>
                        <td>{{ $item->region }}</td>
                        <td>{{ $item->category }}</td>
                        <td>{{ $item->impact }}</td>
                        <td>{{ $item->action }}</td>
                        <td>{{ $item->customer_handling }}</td>
                        <td>{{ $item->time_closed }}</td>
                        <td> {{$item->status==0?'Closed':'Open'}}</td>
                        <td>{{ $item->last_update }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br />
        {{$data->links()}}
    </div>
</div>
<div class="modal fade" id="modal-criticalcase-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:criticalcase.edit />
        </div>
    </div>
</div>
<div class="modal fade" id="modal-criticalcase-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:criticalcase.insert />
        </div>
    </div>
</div>
@push('after-scripts') 
<script>
    Livewire.on('update-critical',(data)=>{
        $("#modal-criticalcase-edit").modal('show');
    });
    Livewire.on('sitetracking-upload',()=>{
        $("#modal-sitetracking-upload").modal('hide');
    });
    // untuk menangkap Event emit "refresh-page" yang dibuat di Component Edit.php
    // jika ada event refresh-page maka modal kita hide
    Livewire.on('refresh-page',()=>{
        $(".modal").modal("hide");
    });
</script>
@endpush