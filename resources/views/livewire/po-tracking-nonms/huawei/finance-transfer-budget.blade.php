<form wire:submit.prevent="save">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Transfer Budget ke Finance Regional</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>Amount</label> : Rp. {{format_idr($amount)}}
        </div>
        <div class="form-group">
            <label>File Transfer (jpeg,png,jpg,gif,svg)</label>
            <input type="file" class="form-control" wire:model="file" />
            @error('file')
                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
        </div>
    </div>
    <div class="modal-footer">
        <span wire:loading>
            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
            <span class="sr-only">{{ __('Loading...') }}</span>
        </span>
        <button type="submit" wire:loading.remove class="btn btn-info close-modal"><i class="fa fa-upload"></i> Submit</button>
    </div>
</form>