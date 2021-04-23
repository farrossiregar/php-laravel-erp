<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-check"></i> Proccess BAST</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <p>Approve PO <strong>{{isset($po->po_reimbursement_id) ? $po->po_reimbursement_id : ''}}</strong> ?</p>
        </div>
        <div class="form-group">
            <textarea class="form-control" wire:model="note" placeholder="Note"></textarea>
            @error('note')
            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
        </div>
        <div class="form-group">
            @if(isset($bast))
            <a href="{{asset("storage/po_tracking/bast/{$bast->bast_filename}")}}" target="_blank"><i class="fa fa-download"></i> File BAST</a>
            @endif
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" wire:click="approve" class="btn btn-success close-modal"><i class="fa fa-check-circle"></i> Approve</button>
        <button type="button" wire:click="reject" class="btn btn-danger close-modal"><i class="fa fa-times"></i> Reject</button>
    </div>
</form>