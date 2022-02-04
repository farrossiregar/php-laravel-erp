<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
    
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-upload"></i> Upload Settlement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
       
        <div class="form-group">
            <label for="">Settlement</label>
            <input type="file" class="form-control" name="file" wire:model="file" />
            @error('file')
            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Unused Amount</label>
            <input type="number" class="form-control" name="file" wire:model="unused_amount" />
            @error('unused_amount')
            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
        </div>

        <br>
        <div class="modal-footer">
            <button type="submit" class="btn btn-info close-modal"><i class="fa fa-upload"></i> Upload</button>
        </div>

        <br>
     
        </div>
        
        
        <div class="row">
            <div class="col-md-12">
                <a href="<?php echo asset('storage/Consumable_Item_Database/'.$settlement) ?>" target="_blank"><i class="fa fa-download"></i> Download Settlement</a>
            </div>
        </div>
        
        <br>
        <br>
       
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
