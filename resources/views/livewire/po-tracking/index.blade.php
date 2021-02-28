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
                        
                        @if($user->user_access_id == 20)
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
                                            <a href="{{route('po-tracking.edit-reimbursement',['id'=>$item->id])}}"><button type="button" class="btn btn-success"><i class="fa fa-eye"></i> Preview Reimbursement</button></a>
                                            
                                            <!--    Regional     -->
                                            @if($item->approved_bast_erp_date == null)
                                                <!-- <a href="#" data-toggle="modal" data-target="#modal-potrackingbast-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import BAST')}}</a> -->
                                                <a href="#" wire:click="$emit('modal-bast',{{$item->id}})" data-toggle="modal" data-target="#modal-potrackingbast-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import BAST')}}</a>
                                            @else
                                                <a href="#" wire:click="$emit('modal-bast',{{$item->id}})" data-toggle="modal" data-target="#modal-potrackingbast-preview" title="Upload" class="btn btn-primary"><i class="fa fa-eye"></i> {{__('Preview BAST')}}</a>
                                                <!-- <a href="{{route('po-tracking.edit-esar',['id'=>$item->id])}}"><button type="button" class="btn btn-success"><i class="fa fa-eye"></i>Preview BAST</button></a> -->
                                            @endif
                                            <!--    End Regional     -->

                                            <!--    E2E     -->
                                            @if($user->user_access_id == 20)
                                                @if($item->approved_bast_erp_date_upload == null)
                                                    <div type="button" class="btn btn-warning">Waiting BAST</div>
                                                @else
                                                    @if($item->approved_esar_date_upload == null)
                                                        <a href="#" wire:click="$emit('modal-esar',{{$item->id}})" data-toggle="modal" data-target="#modal-potrackingesar-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import Approved ESAR')}}</a>
                                                        <!-- <a href="#" wire:click="$emit('modal-esar',{{$item->approved_esar_date_upload}})" title="Modal Esar"><i class="fa fa-plus"></i> {{__('Import Approved Esar')}}</a> -->
                                                    @else
                                                        <a href="#" wire:click="$emit('modal-esar',{{$item->id}})" data-toggle="modal" data-target="#modal-potrackingesar-upload" title="Upload" class="btn btn-success"><i class="fa fa-eye"></i> {{__('Preview Approved ESAR')}}</a>
                                                    @endif
                                                    <!-- <a href="{{route('po-tracking.edit-esar',['id'=>$item->id])}}"><button type="button" class="btn btn-success">Preview ESAR</button></a> -->
                                                @endif
                                            @endif
                                            <!--    End E2E     -->

                                            <!--    Finance     -->
                                            @if($user->user_access_id == 2)
                                                @if($item->approved_esar_date_upload == null)
                                                    <div type="button" class="btn btn-warning">Waiting Approved ESAR</div>
                                                @else
                                                    @if($item->approved_acceptance_docs_date_upload == null)
                                                        <!-- <a href="{{route('po-tracking.edit-esar',['id'=>$item->id])}}"><button type="button" class="btn btn-success">Import Acceptance Docs & Invoice</button></a> -->
                                                        <a href="#" wire:click="$emit('modal-acceptancedocs',{{$item->id}})" data-toggle="modal" data-target="#modal-potrackingacceptance-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import Acceptance Docs & Invoice')}}</a>
                                                    @else
                                                        <a href="#" wire:click="$emit('modal-acceptancedocs',{{$item->id}})" data-toggle="modal" data-target="#modal-potrackingacceptance-preview" title="Upload" class="btn btn-success"><i class="fa fa-eye"></i> {{__('Preview Acceptance Docs & Invoice')}}</a>
                                                    @endif
                                                @endif
                                            @endif
                                            <!--    End Finance     -->



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

<!--    MODAL REIMBURSEMENT      -->
<div class="modal fade" id="modal-potracking-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <livewire:po-tracking.insert />
        </div>
    </div>
</div>
<!--    MODAL REIMBURSEMENT      -->


<!--    MODAL BAST      -->
<div class="modal fade" id="modal-potrackingbast-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <livewire:po-tracking.importbast />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-potrackingbast-preview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <livewire:po-tracking.importbast />
        </div>
    </div>
</div>
<!--    END MODAL BAST      -->


<!--    MODAL ESAR      -->
<div class="modal fade" id="modal-potrackingesar-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <livewire:po-tracking.importesar />
        </div>
    </div>
</div>


<!--    END MODAL ESAR      -->


<!--    MODAL ESAR      -->
<div class="modal fade" id="modal-potrackingacceptance-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <livewire:po-tracking.importacceptancedocs />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-potrackingacceptance-preview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <livewire:po-tracking.importacceptancedocs />
        </div>
    </div>
</div>
<!--    END MODAL ESAR      -->




@section('page-script')
Livewire.on('sitetracking-upload',()=>{
    $("#modal-sitetracking-upload").modal('hide');
});

<script>
    Livewire.on('modal-esar',(data)=>{
        console.log(data);
        $("#modal-potrackingaesar-upload").modal('show');
    });

    Livewire.on('modal-bast',(data)=>{
        $("#modal-potrackingbast-upload").modal('show');
    });

    Livewire.on('modal-acceptancedocs',(data)=>{
        $("#modal-potrackingacceptance-upload").modal('show');
    });
</script>


@endsection










