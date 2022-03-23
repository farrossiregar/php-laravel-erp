<form wire:submit.prevent="save">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-sign-in"></i> Upload</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <input type="file" class="form-control" wire:model="file" />
        @error('name')
            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
        @enderror
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-danger">Yes</button>
    </div>
    <div wire:loading>
        <div class="page-loader-wrapper" style="display:block">
            <div class="loader" style="display:block">
                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                <p>{{ __('Please wait...') }}</p>
            </div>
        </div>
    </div>
</form>