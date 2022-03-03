<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-check"></i> Update Treasury</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        
        <div class="form-group">
            <label>Paid Amount in Bank</label>
            <input type="text" name="" id="" class="form-control" wire:model="paid_amount_bank" readonly>
            
        </div>

        <div class="form-group">
            <label>Bank & Account No</label>
            <input type="text" name="" id="" class="form-control" wire:model="bank">
            
        </div>

        <div class="form-group">
            <label>PIC</label>
            <input type="text" name="" id="" class="form-control" wire:model="pic">
            
        </div>
      
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-success  close-modal"  wire:click="save"><i class="fa fa-check"></i> Submit</button>
    </div>
     <!-- <div wire:loading>
        <div class="page-loader-wrapper" style="display:block">
            <div class="loader" style="display:block">
                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                <p>Please wait...</p>
            </div>
        </div>
    </div> -->
    
</form>

