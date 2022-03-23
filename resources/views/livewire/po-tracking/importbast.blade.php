<form wire:submit.prevent="save">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-upload"></i> Upload File BAST {{isset($po->bast_number) ? $po->bast_number : ''}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        @if(isset($po))
            @if(empty($po->bast_number))
                <div class="form-group">
                    <label>BAST Number</label>
                    <input type="text" class="form-control" wire:model="bast_number" />
                </div>
                <!-- <div class="form-group">
                    <label>Date</label>
                    <input type="date" class="form-control" wire:model="bast_approved" />
                </div> -->
            @endif
        @endif
        <div class="form-group">
            <input type="file" class="form-control" name="file" wire:model="file" />
            @error('file')
            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-info close-modal"><i class="fa fa-upload"></i> Upload</button>
    </div>
    <div wire:loading wire:target="save">
        <div class="page-loader-wrapper" style="display:block">
            <div class="loader" style="display:block">
                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                <p>Please wait...</p>
            </div>
        </div>
    </div>
</form>