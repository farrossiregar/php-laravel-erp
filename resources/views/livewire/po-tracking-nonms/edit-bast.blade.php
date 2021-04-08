@section('title', __('PO Tracking Non MS BOQ Detail'))
@section('parentPageTitle', 'Home Detail')


<?php
    $user = \Auth::user();
?>

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-12">
                    <b><h5>PO Tracking Non MS Bast</h5></b> 
                    <!-- <a href="#" data-toggle="modal" data-target="#modal-potrackingesar-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import PO Tracking ESAR')}}</a> -->
                    <br>
                </div>
                
            </div>
            <div class="body pt-0">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped m-b-0 c_list">
                                <tr>
                                    <th>No</th>                               
                                    <th>Bast</th>                               
                                    <th>Approved Bast</th>                               
                                    <th>GR Customer</th>                                  
                                    <th>Extra Budget</th>                                  
                                    <th>Action</th>                                  
                                </tr>
                                @foreach($data as $key => $item)
                                <?php
                                    $key = $key+1;
                                ?>
                                <tr>
                                    <td>{{ $key }}</td>                                          
                                    <td>
                                        @if(check_access('po-tracking-nonms.import-bast'))
                                            @if($item->bast == null || $item->bast == '')
                                                <a href="javascript:;" wire:click="$emit('modalimportbast','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackingnonms-importbast" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import Bast')}}</a>
                                            @else
                                                <a href="javascript:;" wire:click="$emit('modalimportbast','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackingnonms-importbast" title="Upload" class="btn btn-primary"><i class="fa fa-edit"></i> </a>

                                                <a href="<?php echo asset('storage/po_tracking_nonms/Bast/'.$item->bast) ?>" target="_blank"><i class="fa fa-download"></i> Download Bast </a>
                                            @endif
                                        @else
                                            @if($item->bast != null || $item->bast != '')
                                                <a href="<?php echo asset('storage/po_tracking_nonms/Bast/'.$item->bast) ?>" target="_blank"><i class="fa fa-download"></i> Download Bast </a>
                                            @endif
                                        @endif

                                    </td>                                                             
                                    <td>
                                        @if(check_access('po-tracking-nonms.import-approvedbast'))
                                            @if($item->approved_bast == null || $item->approved_bast == '')
                                                @if($item->bast != null || $item->bast != '')
                                                    <!--    Start E2E Revise Bast to Regional   -->
                                                    <a href="javascript:;" wire:click="$emit('modalrevisebast','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackingnonms-revisebast" title="Upload" class="btn btn-danger"><i class="fa fa-edit"></i> {{__('Revise Bast to Regional')}}</a>
                                                    <!--    End E2E Revise Bast to Regional    -->

                                                    <a href="javascript:;" wire:click="$emit('modalimportapprovedbast','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackingnonms-importapprovedbast" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import Approved Bast')}}</a>
                                                @else
                                                    <div class="btn btn-warning">Waiting Uploaded Bast</div>
                                                @endif
                                            @else
                                                <a href="javascript:;" wire:click="$emit('modalimportapprovedbast','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackingnonms-importapprovedbast" title="Upload" class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                                                
                                                <a href="<?php echo asset('storage/po_tracking_nonms/ApprovedBast/'.$item->approved_bast) ?>" target="_blank"><i class="fa fa-download"></i> Download Approved Bast </a>
                                            @endif
                                        @else
                                            @if($item->approved_bast != null || $item->approved_bast != '')
                                                <a href="<?php echo asset('storage/po_tracking_nonms/ApprovedBast/'.$item->approved_bast) ?>" target="_blank"><i class="fa fa-download"></i> Download Approved Bast </a>
                                            @endif
                                        @endif
                                        
                                        
                                    </td>  
                                    <td>
                                        @if(check_access('po-tracking-nonms.import-grcust'))
                                            @if($item->gr_cust == null || $item->gr_cust == '')
                                                @if($item->bast != null || $item->bast != '')
                                                    <a href="javascript:;" wire:click="$emit('modalimportgrcust','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackingnonms-importgrcust" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import GR Customer')}}</a>
                                                @else
                                                    <div class="btn btn-warning">Waiting Uploaded Bast</div>
                                                @endif
                                            @else
                                                <a href="javascript:;" wire:click="$emit('modalimportgrcust','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackingnonms-importgrcust" title="Upload" class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                                                
                                                <a href="<?php echo asset('storage/po_tracking_nonms/GrCust/'.$item->gr_cust) ?>" target="_blank"><i class="fa fa-download"></i> Download GR Customer </a>
                                            @endif
                                        @else
                                            @if($item->gr_cust != null || $item->gr_cust != '')
                                                <a href="<?php echo asset('storage/po_tracking_nonms/GrCust/'.$item->gr_cust) ?>" target="_blank"><i class="fa fa-download"></i> Download GR Customer </a>
                                            @endif
                                        @endif
                                    </td>    
                                    <td>
                                        <b>Rp {{ $extra_budget }}</b> 
                                    </td>

                                    
                                    <td>
                                        @if(check_access('po-tracking-nonms.submit-to-finance'))
                                            @if($item->gr_cust != '' && $item->approved_bast != '')
                                                @if($item->e2e_to_fin == '')
                                                    <a href="javascript:;" wire:click="$emit('modalsubmittofin','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackingnonms-submittofin" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Submit')}}</a>
                                                @else
                                                    <div class="btn btn-success">Submitted to Finance</div>
                                                @endif
                                            @else
                                                <div class="btn btn-warning">Waiting Uploaded Approved Bast and GR Customer</div>
                                            @endif
                                        @endif
                                    </td>
                                       

                                   
                                    <!--    Start E2E Preview Bast   -->
                                    <!-- <a href="{{ route('po-tracking-nonms.edit-bast',['id'=>$item->id]) }}"><button type="button" class="btn btn-success"><i class="fa fa-eye"></i> Preview PO Non MS Bast </button></a> -->
                                    <!--    End E2E Preview Bast    -->
                                                        
                                               
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>

                



                <br><br><br>
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('po-tracking-nonms.index')}}">
                            <div class="btn btn-danger"><i class="fa fa-arrow-left"></i> Return</div>
                        </a>
                    </div>
                </div>
            </div>
       
        </div>
    </div>
</div>



<!--    MODAL PO NON MS IMPORT BAST      -->
<div class="modal fade" id="modal-potrackingnonms-importbast" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <livewire:po-tracking-nonms.importbast />
        </div>
    </div>
</div>
<!--    MODAL PO NON MS IMPORT BAST      -->


<!--    MODAL REVISE BAST TO REGIONAL      -->
<div class="modal fade" id="modal-potrackingnonms-revisebast" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking-nonms.revisebast />
        </div>
    </div>
</div>


<!--    END MODAL REVISE BAST TO REGIONAL        -->


<!--    MODAL PO NON MS IMPORT APPROVED BAST      -->
<div class="modal fade" id="modal-potrackingnonms-importapprovedbast" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <livewire:po-tracking-nonms.importapprovedbast />
        </div>
    </div>
</div>
<!--    MODAL PO NON MS IMPORT APPROVED BAST      -->


<!--    MODAL PO NON MS IMPORT GR CUSTOMER      -->
<div class="modal fade" id="modal-potrackingnonms-importgrcust" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <livewire:po-tracking-nonms.importgrcust />
        </div>
    </div>
</div>
<!--    MODAL PO NON MS IMPORT GR CUSTOMER      -->


<!--    MODAL PO NON MS SUBMIT TO FINANCE      -->
<div class="modal fade" id="modal-potrackingnonms-submittofin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <livewire:po-tracking-nonms.submittofin />
        </div>
    </div>
</div>
<!--    MODAL PO NON MS SUBMIT TO FINANCE      -->


@push('after-scripts')
<script>
    Livewire.on('modalimportbast',(data)=>{
        console.log(data);
        $("#modal-potrackingstp-upload").modal('show');
    });

    Livewire.on('modalrevisebast',(data)=>{
        console.log(data);
        $("#modal-potrackingnonms-revisebast").modal('show');
    });

    Livewire.on('modalimportapprovedbast',(data)=>{
        console.log(data);
        $("#modal-potrackingnonms-importapprovedbast").modal('show');
    });

    Livewire.on('modalimportgrcust',(data)=>{
        console.log(data);
        $("#modal-potrackingnonms-importgrcust").modal('show');
    });

    Livewire.on('modalsubmittofin',(data)=>{
        console.log(data);
        $("#modal-potrackingnonms-submittofin").modal('show');
    });
</script>
@endpush






