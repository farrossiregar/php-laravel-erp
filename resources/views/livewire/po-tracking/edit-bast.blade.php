@section('title', __('PO Tracking Bast Detail'))
@section('parentPageTitle', 'Home Detail')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-12">
                    <b><h5>Bast</h5></b> 
                    <!-- <a href="#" data-toggle="modal" data-target="#modal-potrackingesar-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import PO Tracking ESAR')}}</a> -->
                    <br>
                </div>
                <table class="table table-striped m-b-0 c_list">
                    <div class="col-md-2">
                        <select class="form-control" name="status" wire:model="status">
                            <option value=""> --- Status --- </option>
                            <option value="1">Completed</option>
                            <option value="0">Waiting Approval</option>
                        </select>
                    </div>

                </table>
            </div>
            <div class="body pt-0">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped m-b-0 c_list">
                                <tr>
                                    <th>No</th>                               
                                    <th>No PO</th>                               
                                    <th>Region</th>                               
                                    <th class="text-center">Bast</th>           
                                    <th>Bast Uploaded By</th>           
                                    <th>Bast Status</th>           
                                </tr>
                                @foreach($data as $key => $item)
                                <tr>
                                    <th>{{ ($key+1) }}</th>                               
                                    <th>{{ $item->po_no }}</th> 
                                    <th>{{ $item->bidding_area }}</th>                                                       
                                    <th>
                                        @if($item->bast_filename == null || $item->bast_filename == '' )
                                            {{-- @if($user->user_access_id == '22') --}}
                                            @if(check_access('po-tracking.upload-bast'))
                                                <a href="javascript:;" wire:click="$emit('modal-bast','{{$item->po_no}}')" data-toggle="modal" data-target="#modal-potrackingbast-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import BAST')}}</a>
                                            @else
                                                <div class="btn btn-warning"> Waiting Uploaded Bast </div>
                                            @endif
                                            
                                        @else
                                            <a href="<?php echo asset('storage/po_tracking/bast/'.$item->bast_filename) ?>" target="_blank"><i class="fa fa-download"></i> Download Bast </a>
                                            {{-- @if($user->user_access_id == '22') --}}
                                            @if(check_access('po-tracking.upload-bast'))
                                                <a href="javascript:;" wire:click="$emit('modal-bast','{{$item->po_no}}')" data-toggle="modal" data-target="#modal-potrackingbast-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Edit BAST')}}</a>
                                            @endif
                                        @endif

                                        
                                        
                                    </th>
                                    <th>{{ $item->bast_uploader_userid }}</th>         
                                    <th>
                                        
                                        {{-- @if($user->user_access_id == '22') --}}
                                        @if(check_access('po-tracking.upload-bast'))
                                            @if($item->status == null)
                                                <div class="btn btn-warning"> Waiting Approval </div>
                                            @endif

                                            @if($item->status == '0')
                                                <div class="btn btn-danger"> Rejected </div>
                                            @endif

                                            @if($item->status == '1')
                                                <div class="btn btn-success"> Completed </div>
                                            @endif
                                                
                                        @endif

                                        {{-- @if($user->user_access_id == '20') --}}
                                        @if(check_access('po-tracking.approved-bast'))
                                            @if($item->status == null)
                                                @if($item->bast_filename != null || $item->bast_filename != '')
                                                    <a href="javascript:;" wire:click="$emit('modal-approvebast','{{$item->po_no}}')" data-toggle="modal" data-target="#modal-potrackingapprovebast-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Approve BAST')}}</a>
                                                @endif
                                            @else
                                                @if($item->status == '1')
                                                    <div class="btn btn-success"> Approved </div>
                                                @else
                                                    <div class="btn btn-danger"> Reject </div>
                                                @endif
                                            @endif
                                        @endif
                                    </th>    
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
       
        </div>
    </div>
</div>



<!--    MODAL BAST      -->
<div class="modal fade" id="modal-potrackingbast-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <livewire:po-tracking.importbast />
        </div>
    </div>
</div>

<!--    END MODAL BAST      -->


<!--    MODAL APPROVE BAST      -->
<div class="modal fade" id="modal-potrackingapprovebast-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <livewire:po-tracking.approvebast />
        </div>
    </div>
</div>

<!--    END MODAL APPROVE BAST      -->

@section('page-script')
Livewire.on('sitetracking-upload',()=>{
    $("#modal-sitetracking-upload").modal('hide');
});

Livewire.on('modal-bast',(data)=>{
    $("#modal-potrackingbast-upload").modal('show');
});

Livewire.on('modal-approvebast',(data)=>{
    $("#modal-potrackingapprovebast-upload").modal('show');
});



@endsection







