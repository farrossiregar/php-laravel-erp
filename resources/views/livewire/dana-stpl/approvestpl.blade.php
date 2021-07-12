<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-check"></i> Approve Dana STPL</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>Approve Dana STPL ?</label>
            <?php
                 if(check_access('dana-stpl.approve-sm')){
                    $usertype = 'sm';
                 }

                 if(check_access('dana-stpl.approve-ms')){
                    $usertype = 'ms';
                 }

                 if(check_access('dana-stpl.approve-psm')){
                    $usertype = 'psm';
                 }
            ?>
            <input class="form-control" type="hidden" value="<?php echo $usertype; ?>" placeholder="<?php echo $usertype; ?>" wire:model="usertype">
        </div>
      
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-success  close-modal"  wire:click="save"><i class="fa fa-check"></i> Submit</button>
    </div>
     <div wire:loading>
        <div class="page-loader-wrapper" style="display:block">
            <div class="loader" style="display:block">
                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                <p>Please wait...</p>
            </div>
        </div>
    </div>
    
</form>

