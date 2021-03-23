@section('title', __('PO Tracking Index'))
@section('parentPageTitle', 'Home')


<?php
    $user = \Auth::user();
?>

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
                            <input type="date" class="form-control" wire:model="date" />
                        </div>
                        
                        {{-- @if($user->user_access_id != '20s') --}}
                        @if(check_access('po-tracking.import'))
                        <div class="col-md-1">
                            <a href="#" data-toggle="modal" data-target="#modal-potracking-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import PO Tracking Reimbursement')}}</a>
                        </div>
                        @endif
                        
                    </div>
                    
                    <div class="body pt-0">

                        
                        <div class="table-responsive">
                            <table class="table table-striped m-b-0 c_list">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>PO Tracking Uploaded</th>    
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $k => $item)
                                    <tr>
                                        <td style="width: 50px;">{{$k+1}}</td>
                                        <td><?php echo date_format($item->created_at, 'd M Y H:i:s'); ?></td>
                                        
                                        <td>
                                            <!-- <a href="{{route('po-tracking.generate-esar',$item)}}">Generate ESAR</a> -->
                                            <a href="{{route('po-tracking.edit-reimbursement',['id'=>$item->id])}}"><button type="button" class="btn btn-success"><i class="fa fa-eye"></i> Preview Reimbursement</button></a>
                                            
                                            
                                            <!--    Regional     -->
                                            
                                            {{-- @if($user->user_access_id == '20' || $user->user_access_id == '22') --}}
                                            @if(check_access('po-tracking.edit-bast'))
                                            <a href="{{route('po-tracking.edit-bast',['id'=>$item->id])}}"><button type="button" class="btn btn-success"><i class="fa fa-eye"></i> Preview Bast</button></a>
                                            <!-- @if($item->approved_bast_erp_date_upload == null)
                                                <a href="#" wire:click="$emit('modal-bast',{{$item->id}})" data-toggle="modal" data-target="#modal-potrackingbast-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import BAST')}}</a>
                                            @else
                                                <a href="#" wire:click="$emit('modal-bast',{{$item->id}})" data-toggle="modal" data-target="#modal-potrackingbast-upload" title="Upload" class="btn btn-success"><i class="fa fa-eye"></i> {{__('Preview BAST')}}</a>
                                            @endif -->
                                            @endif
                                            <!--    End Regional     -->

                                            <!--    E2E     -->
                                            {{-- @if($user->user_access_id == '20') --}}
                                            @if(check_access('po-tracking.edit-esar'))
                                                <a href="{{route('po-tracking.edit-esar',['id'=>$item->id])}}"><button type="button" class="btn btn-success"><i class="fa fa-eye"></i> Preview Esar</button></a>
                                            @endif
                                            <!--    End E2E     -->

                                            <!--    Finance     -->
                                            
                                            {{-- @if($user->user_access_id == '2') --}}
                                            @if(check_access('po-tracking.edit-accdoc'))
                                                <a href="{{route('po-tracking.edit-accdoc',['id'=>$item->id])}}"><button type="button" class="btn btn-success"><i class="fa fa-eye"></i> Preview Acceptance Docs</button></a>
                                                <!-- @if($item->approved_esar_date_upload == null)
                                                    <div type="button" class="btn btn-warning">Waiting Approved ESAR</div>
                                                @else -->
                                                    <!-- @if($item->approved_acceptance_docs_date_upload == null)
                                                        <a href="#" wire:click="$emit('modal-acceptancedocs',{{$item->id}})" data-toggle="modal" data-target="#modal-potrackingacceptance-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import Acceptance Docs & Invoice')}}</a>
                                                    @else
                                                        <a href="#" wire:click="$emit('modal-acceptancedocs',{{$item->id}})" data-toggle="modal" data-target="#modal-potrackingacceptance-upload" title="Upload" class="btn btn-success"><i class="fa fa-eye"></i> {{__('Preview Acceptance Docs & Invoice')}}</a>
                                                    @endif -->
                                                <!-- @endif -->

                                            @endif
                                            <!--    End Finance     -->

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

<!--    MODAL REIMBURSEMENT      -->
<div class="modal fade" id="modal-potracking-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <livewire:po-tracking.insert />
        </div>
    </div>
</div>
<!--    MODAL REIMBURSEMENT      -->







@section('page-script')
Livewire.on('sitetracking-upload',()=>{
    $("#modal-sitetracking-upload").modal('hide');
});

<script>
    // Livewire.on('modal-esar',(data)=>{
    //     console.log(data);
    //     $("#modal-potrackingaesar-upload").modal('show');
    // });

    Livewire.on('modal-bast',(data)=>{
        console.log(data);
        $("#modal-potrackingbast-upload").modal('show');
    });

    Livewire.on('modal-acceptancedocs',(data)=>{
        console.log(data);
        $("#modal-potrackingacceptance-upload").modal('show');
    });
</script>





@endsection










