<form>
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-info"></i> Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <p>Process HQ Administration ? </p>
        <div class="form-group">
            <textarea class="form-control" wire:model="note" placeholder="Note"></textarea>
            @error('note')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="modal-footer">
        <div wire:loading.remove wire:target="approve,reject">
            <button type="button" class="btn btn-danger" wire:click="reject"><i class="fa fa-close"></i> Reject</button>
            <button type="button" class="btn btn-info" wire:click="approve"><i class="fa fa-check"></i> Approve</button>
        </div>
        <span wire:loading wire:target="approve,reject">
            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
            <span class="sr-only">{{ __('Loading...') }}</span>
        </span>
    </div>
</form>