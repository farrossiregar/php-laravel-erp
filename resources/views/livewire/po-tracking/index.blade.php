@section('title', __('PO Tracking Index'))
@section('parentPageTitle', 'Home')

<div class="row clearfix">
    <div class="col-lg-12">
        <br><br><br>
        <div class="card">
            <ul class="nav nav-tabs">
                <!-- <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#dashboard-critical-case" wire:click="$emit('chart')">{{ __('Dashboard') }}</a></li> -->
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#data-po-tracking">{{ __('Data PO Tracking') }}</a></li>
            </ul>
            <div class="tab-content">
                <!-- <div class="tab-pane show active" id="dashboard-critical-case">
                    <livewire:criticalcase.dashboard />
                </div> -->
                <div class="tab-pane show active" id="data-po-tracking">
                    <div class="header row">
                        <div class="col-md-2">
                            <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" wire:model="month">
                                <option value=""> --- Month --- </option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="03">April</option>
                                <option value="03">May</option>
                                <option value="03">June</option>
                                <option value="03">July</option>
                                <option value="03">August</option>
                                <option value="03">September</option>
                                <option value="03">October</option>
                                <option value="03">November</option>
                                <option value="03">December</option>
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
                        <div class="col-md-2">
                            <select class="form-control" wire:model="project">
                                <option value=""> --- Project --- </option>
                                <option value="">Project Name</option>
                            </select>
                        </div>
                        
                        <div class="col-md-1">
                            <a href="#" data-toggle="modal" data-target="#modal-potracking-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import PO Tracking Reimbursement')}}</a>
                        </div>
                        
                    </div>
                    <div class="body pt-0">

                        
                        <div class="table-responsive">
                            <table class="table table-striped m-b-0 c_list">
                                <thead>
                                    <tr>
                                        <th>No</th>    
                                        <th>Project Name</th>    
                                        <th>No Subcontract</th>    
                                        <th>No Contract</th>    
                                        <th>Action</th>    
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $k => $item)
                                    <tr>
                                        <td style="width: 50px;">{{$k+1}}</td>
                                        <td>{{$item->project_name}}</td>
                                        <td>{{$item->subcontract_no}}</td>
                                        <td>{{$item->contract_no}}</td>
                                        <td>
                                            <a href="{{route('po-tracking.edit-reimbursement',['id'=>$item->id])}}"><button type="button" class="btn btn-success">Preview Reimbursement</button></a>
                                            <a href="{{route('po-tracking.edit-esar',['id'=>$item->id])}}"><button type="button" class="btn btn-success">Preview ESAR</button></a>
                                            <!-- <a href="#" data-toggle="modal" data-target="#modal-potrackingesar-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import PO Tracking ESAR')}}</a> -->
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br />
                        
                    </div>
                </div>
            </div>
        </div>
    
    </div>
</div>


<div class="modal fade" id="modal-potracking-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <livewire:po-tracking.insert />
        </div>
    </div>
</div>


<div class="modal fade" id="modal-potrackingesar-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <livewire:po-tracking.importesar />
        </div>
    </div>
</div>




@section('page-script')
Livewire.on('sitetracking-upload',()=>{
    $("#modal-sitetracking-upload").modal('hide');
});



@endsection










