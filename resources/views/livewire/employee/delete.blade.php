<div class="modal-content">
    <form wire:submit.prevent="delete">
        <div class="modal-header">
            <h5 class="modal-title text-danger" id="exampleModalLabel"><i class="fa fa-trash"></i> Delete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true close-btn">×</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Are you want delete this data ? </p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm close-btn" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger btn-sm close-modal"><i class="fa fa-trash"></i> Delete</button>
        </div>
    </form>
</div>