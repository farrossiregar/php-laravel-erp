@section('title', __('PO Tracking Acceptance Docs Detail Finance'))
@section('parentPageTitle', 'Home Detail')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-12">
                    <b><h5>Acceptance Docs</h5></b> 
                    <!-- <a href="#" data-toggle="modal" data-target="#modal-potrackingesar-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import PO Tracking ESAR')}}</a> -->
                    <br>
                </div>
                <table class="table table-striped m-b-0 c_list">
                    <div class="col-md-2">
                        <select class="form-control" name="status" wire:model="status">
                            <option value=""> --- Status --- </option>
                            <option value="1">Completed</option>
                            <option value="">Waiting Approval</option>
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
                                    <th>Approved Esar</th>                                      
                                    <th>Acceptance Docs Date Upload</th>                                  
                                    <th>Acceptance Docs User Upload</th>                                  
                                    <th colspan=2 class="text-center">Acceptance Docs</th>          
                                </tr>
                                
                                <?php   
                                    foreach($data as $key => $item){
                                        $key = $key+1;
                                    ?>
                                <tr>
                                    <th><?php echo $key; ?></th>                               
                                    <th><?php echo $item->po_no; ?></th>                               
                                    <th>
                                        <?php
                                            if($item->approved_esar_filename != null || $item->approved_esar_filename != '' ){
                                        ?>
                                        <a href="<?php echo asset('storage/po_tracking/ApprovedEsar/'.$item->approved_esar_filename) ?>" target="_blank"><i class="fa fa-download"></i> Download Approved ESAR </a>
                                        <?php
                                            }else{
                                        ?>
                                            <div class="btn btn-warning"> Waiting Approved Esar </div>
                                        <?php
                                            }
                                        ?>
                                    </th>                               
                                    <th><?php echo $item->accdoc_date; ?></th>
                                    <th><?php echo $item->accdoc_uploader_userid; ?></th>     
                                    <th>
                                        <?php
                                            if($item->accdoc_filename == null || $item->accdoc_filename == '' ){
                                        ?>
                                        <a href="javascript:;" wire:click="$emit('modal-acceptancedocs','{{$item->po_no}}')" data-toggle="modal" data-target="#modal-potrackingacceptance-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> Import Acceptance Docs</a>
                                        <?php
                                            }else{
                                        ?>
                                            <a href="<?php echo asset('storage/po_tracking/bast/'.$item->accdoc_filename) ?>" target="_blank"><i class="fa fa-download"></i> Download Acceptance Docs </a>
                                            <a href="javascript:;" wire:click="$emit('modal-acceptancedocs','{{$item->po_no}}')" data-toggle="modal" data-target="#modal-potrackingacceptance-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> Edit Acceptance Docs</a>
                                        <?php
                                            }
                                        ?>
                                    </th>     
                                </tr>
                                <?php                                        
                                    }
                                ?>

                               

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!--    MODAL ACCEPTANCE DOCS      -->
<div class="modal fade" id="modal-potrackingacceptance-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <!-- <livewire:po-tracking.importacceptancedocs /> -->
            <!-- <form wire:submit.prevent="save">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Upload Data PO Tracking Acceptance Docs</h5>
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

<!--    END MODAL ACCEPTANCE DOCS      -->

<script>

    // Livewire.on('modal-acceptancedocs',(data)=>{
    //     $("#modal-potrackingacceptance-upload").modal('show');
    // });
</script>


@section('page-script')
Livewire.on('modal-acceptancedocs',(data)=>{
    $("#modal-potrackingacceptance-upload").modal('show');
});

@endsection











