<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Approve Detail Foto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>Revise Detail Foto ?</label>
        </div>
      
        <div class="form-group">
            <label class="form-check-label">Note</label>
            <textarea class="form-control" name="note" wire:model="note"></textarea>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-success" wire:click="approve"><i class="fa fa-check"></i> Submit</button>
        <!-- <button type="button" class="btn btn-success" wire:click="approve"><i class="fa fa-check"></i> Approve</button>
        <button type="button" class="btn btn-danger" wire:click="revisi"><i class="fa fa-times"></i> Revisi</button> -->
    </div>
</form>