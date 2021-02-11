
@section('title', __('Critical Case Data'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">

            <div class="header row">
                <div class="col-md-2">
                    <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
                </div>
                <div class="col-md-2">
                    <select class="form-control" wire:model="pic">
                        <option value=""> --- PIC --- </option>
                        <option value="indra">Indra</option>
                        <option value="budi">Budi</option>
                        <option value="greg">Greg</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-control" wire:model="region_id">
                        <option value=""> --- Region --- </option>
                        @foreach(\App\Models\Region::orderBy('region','ASC')->get() as $region)
                        <option value="{{$region->region_code}}">{{$region->region}}</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- <div class="col-md-1">
                    <a href="#" data-toggle="modal" data-target="#modal-criticalcase-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import Site Tracking')}}</a>
                </div> -->
            </div>
            <div class="body pt-0">

                
                <div class="table-responsive">
                    <table class="table table-striped m-b-0 c_list">
                        <thead>
                            <tr>
                                <th>No</th>    
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
                                <th>Action Point</th>    
                                <th>Customer Handling</th>    
                                <th>Time Closed</th>    
                                <th>Status</th>    
                                <th>Last Update</th>    
                                <th>Action</th>    
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $k => $item)
                            <tr>
                                <td style="width: 50px;">{{$k+1}}</td>
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
                                <td>{{ $item->action_point }}</td>
                                <td>{{ $item->customer_handling }}</td>
                                <td>{{ $item->time_closed }}</td>
                                <td>
                                    <?php
                                        if($item->status == '0'){ 
                                            echo 'Closed'; 
                                        }else{ 
                                            echo 'Open'; 
                                        }
                                    ?>
                                </td>
                                <td>{{ $item->last_update }}</td>
                                <td>
                                <a href="#" data-toggle="modal" data-target="#modal-criticalcase-edit" wire:click="$emit('update-critical',{{$item}})" title="Edit" class="btn btn-success"><i class="fa fa-plus"></i> {{__('Edit Critical Case')}}</a>
                                <!-- <a href="#" data-toggle="modal" wire:click="$emit('update-critical',{{$item}})" title="Edit" class="btn btn-success"><i class="fa fa-plus"></i> {{__('Edit Critical Case')}}</a> -->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br />
                {{$data->links()}}
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modal-criticalcase-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:criticalcase.edit />

        </div>
    </div>
</div>



@section('page-script')
Livewire.on('update-critical',(data)=>{
    alert('ok');
    $("#modal-criticalcase-edit").modal('show');
});



<div class="modal fade" id="modal-criticalcase-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:criticalcase.insert />

        </div>
    </div>
</div>





@section('page-script')
Livewire.on('sitetracking-upload',()=>{
    $("#modal-sitetracking-upload").modal('hide');
});
@endsection


@endsection