<form wire:submit.prevent="saveItems">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Sub Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" wire:model="item_name" />
            @error('item_name')
            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
        </div>
        <div class="form-group">
            <label>Type</label>
            <select class="form-control" wire:model="type">
                <option value=""> --- Select Type --- </option>
                <option value="1">Menu</option>
                <option value="2">Function</option>
                <option value="3">Access</option>
            </select>
            @error('type')
            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
        </div>
        <div class="form-group">
            <label>Menu / Function Name</label>
            <input type="text" class="form-control" wire:model="item_link" />
            @error('item_link')
            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
            @error('valid_link')
            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
        </div>
        <div class="form-group">
            <label>Prefix Link</label>
            <input type="text" class="form-control" wire:model="prefix_link" />
            @error('prefix_link')
            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
        </div>
        <div class="form-group">
            <label>Icon <span>icon-start, icon-settings, etc<span></label>
            <input type="file" class="form-control" wire:model="icon" />
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