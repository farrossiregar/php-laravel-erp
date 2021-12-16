<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-close"></i> Reject Duty Roster</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label> Reject Duty Roster ?</label>
        </div>
        <div class="form-group">
            <label>Note</label>
            <textarea class="form-control" wire:model="note"></textarea>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-success  close-modal"  wire:click="save"><i class="fa fa-check"></i> Submit</button>
    </div>
</form>

