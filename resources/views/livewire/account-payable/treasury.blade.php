<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-check"></i> Treasury Account Payable</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>Bank Account Name</label>
            <input type="text" class="form-control" wire:model="bank_account_name">
            
        </div>
        <div class="form-group">
            <label>Bank Account Number</label>
            <input type="text" class="form-control" wire:model="bank_account_number">
            
        </div>

        <div class="form-group">
            <label>Bank Name</label>
            <input type="text" class="form-control" wire:model="bank_name">
            
        </div>
      
    </div>
    <?php
        $check = \App\Models\AccountPayable::where('id', $selected_id)->first();
    ?>
    @if(@$check->bank_account_name == '' && @$check->bank_account_number == '' && @$check->bank_name == '')
    <div class="modal-footer">
        <button type="button" class="btn btn-success  close-modal"  wire:click="save"><i class="fa fa-check"></i> Submit</button>
    </div>
    @endif
     <!-- <div wire:loading>
        <div class="page-loader-wrapper" style="display:block">
            <div class="loader" style="display:block">
                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                <p>Please wait...</p>
            </div>
        </div>
    </div> -->
    
</form>

