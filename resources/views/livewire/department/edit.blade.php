<div class="modal-content">
    <form wire:submit.prevent="save">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> {{$name}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true close-btn">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <input type="text" class="form-control" wire:model="name" />
            </div>
            <div class="form-group">
                <label>Icon</label>
                <input type="file" wire:model="icon" />
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm close-btn" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-info btn-sm close-modal"><i class="fa fa-save"></i> Save</button>
        </div>
    </form>
</div>