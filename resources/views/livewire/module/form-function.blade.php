<form wire:submit.prevent="save">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Function</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
        <input type="hidden" wire:model="parent_id" />
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" wire:model="name" />
            @error('name')
            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
        </div>
        <div class="form-group">
            <label>Link</label>
            <input type="text" class="form-control" wire:model="link" />
            @error('link')
            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
        </div>
        <div class="form-group">
            <label>Icon <span>icon-start, icon-settings, etc<span></label>
            <input type="text" class="form-control" wire:model="icon" />
            @error('icon')
            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger close-btn btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-info close-modal btn-sm"><i class="fa fa-save"></i> Save</button>
    </div>
</form>