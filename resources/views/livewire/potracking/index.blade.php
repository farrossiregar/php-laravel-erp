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
                        
                        <div class="col-md-1">
                            <a href="#" data-toggle="modal" data-target="#modal-potracking-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import PO Tracking')}}</a>
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
                                        <th>Last Update</th>    
                                        <th>Action</th>    
                                    </tr>
                                </thead>
                                <tbody>
                                   
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
            <!-- <form wire:submit.prevent="save">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Upload Data PO Tracking</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>File</label>
                        <input type="file" class="form-control" name="file" wire:model="file" />
                        @error('file')
                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info close-modal"><i class="fa fa-upload"></i> Upload</button>
                </div>
                <div wire:loading>
                    <div class="page-loader-wrapper" style="display:block">
                        <div class="loader" style="display:block">
                            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                            <p>Please wait...</p>
                        </div>
                    </div>
                </div>
            </form> -->
        </div>
    </div>
</div>





@section('page-script')
Livewire.on('sitetracking-upload',()=>{
    $("#modal-sitetracking-upload").modal('hide');
});
@endsection










